<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class action extends \mod\intf\standard {

	/**
	 * @var array
	 */
	protected $path;

	protected $section;
	protected $layout;
	protected $html;

	/**
	 * @var \CodeIgniter\HTTP\IncomingRequest
	 */
	protected $request;

	//--------------------------------------------------------------------------------
	public function __construct($options = []) {
		$options = array_merge([
		    "section" => "system"
		], $options);

		$this->set_section($options["section"]);
		$this->request = \Config\Services::request();
	}
	//--------------------------------------------------------------------------------
	public function set_data(array $path) {
		$this->path = $path;

		return $this;
	}
	//--------------------------------------------------------------------------------
	private function set_section($section) {

		if($section instanceof \mod\intf\section){
			$this->section = $section;
		} else if(is_string($section)){
			$namespace = "\\app\\acc\\section\\{$section}";
			$this->section = $namespace::make();
		}
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param array $options
	 * @return mixed
	 * @throws \Exception
	 */
	private function init($options = []) {


		//remove get parameters from last index
        $last_index = end($this->path);
        $parts = explode("&", $last_index);
		$this->path[sizeof($this->path)-1] = reset($parts);

		$key = array_search('p', $this->path);

		if($key){
			$control_arr = array_slice($this->path, 0, $key);
			$data_arr = array_filter(array_slice($this->path, $key+1));
		}else{
			$control_arr = $this->path;
			$data_arr = [];
		}

		$data = [];

		//set GET data
		if($data_arr){
			array_filter($data_arr, function($item, $key) use(&$data, $data_arr){
				if(($key%2 == 0)){
					$data[$item] = isset($data_arr[$key+1]) ? $data_arr[$key+1] : false;
				}
			}, ARRAY_FILTER_USE_BOTH);
		}

		$name = "\\action\\".implode("\\", $control_arr);

		try{
			$action = call_user_func([$name, "make"]);
			if($data) $action->set_data($data);

			$buffer = \mod\ui::make()->buffer();
			$this->layout = $action->run($buffer);
			if(!$this->layout) $this->layout = "system";

			$this->set_section($this->layout);

			$this->html = $buffer->get_clean();

		}catch(\Exception $ex){
			error_log($ex);
		}
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $data - action folder parts
	 * @param array $options
	 * @return false|string|null
	 * @throws \Exception
	 */
	public function build($data, $options = []) {

		$this->set_data($data)->init();

		if($this->layout == "stream" || $this->layout == "clean"){
			return $this->html;
		}
        if(\mod\http::is_ajax()){
            $buffer = \mod\ui::make()->buffer();
            $buffer->add($this->html);
            $buffer->script(["*" => "
                $(function(){".\mod\js::get_script(["wrap" => false])."});
            "]);
			\mod\http::json($buffer->build());
			return "";
		}

		return $this->section->get_layout()->build(["content" => $this->html]);
	}
	//--------------------------------------------------------------------------------
}