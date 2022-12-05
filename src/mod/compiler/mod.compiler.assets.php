<?php

namespace mod\compiler;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class assets extends \mod\intf\standard {

	protected $css_arr = [];
	protected $js_arr = [];

	protected $dest = false;
	/**
	 * @var false|mixed | \mod\intf\section
	 */
	protected $section;

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

		$options = array_merge([
		    "section" => "system"
		], $options);

		$this->section = call_user_func(["\\app\\acc\\section\\{$options["section"]}", "make"]);

		$this->section->get_ui()->get_css_includes();

		$this->css_arr = $this->section->get_ui()->get_css_includes();
		$this->js_arr = $this->section->get_ui()->get_js_includes();

		$this->dest = DIR_ASSETS."/ui";

	}
	//--------------------------------------------------------------------------------
	private function write_file($asset_arr, $filename){

	    $is_js = strpos($filename, ".js") !== false;

		\mod\os::mkdir(dirname($filename));

		if(!\mod\os::is_newer_than($filename, $asset_arr)){
			if($is_js){
                $minifier = new \MatthiasMullie\Minify\JS();
                foreach ($asset_arr as $asset_file){
                    if(file_exists($asset_file)){
                        $minifier->add($asset_file);
                    }else{
                        throw new \Exception("Asset file not found: $asset_file");
                    }
                }
                $minifier->minify($filename);
            }else{
                $minifier = new \MatthiasMullie\Minify\CSS();
                foreach ($asset_arr as $asset_file){
                    if(file_exists($asset_file)){
                        $minifier->add($asset_file);
                    }else{
                        throw new \Exception("Asset file not found: $asset_file");
                    }
                }
                $minifier->minify($filename);
            }
		}

	}
	//--------------------------------------------------------------------------------
	public function run($options = []) {

		$minified_css = $this->dest."/{$this->section->get_set()}/ui.min.css";
		$this->write_file($this->css_arr, $minified_css);

		$minified_js = $this->dest."/{$this->section->get_set()}/ui.min.js";
		$this->write_file($this->js_arr, $minified_js);

		return $this;
	}
	//--------------------------------------------------------------------------------
	public function get_stream_css($options = []) {

		return \mod\ui::make()->tag()->link([
			"@rel" => "stylesheet",
			"@href" => site_url(["stream", "xasset", "ui", $this->section->get_set(), "ui.min.css"])
		]);

	}
	//--------------------------------------------------------------------------------
	public function get_stream_js($options = []) {

		$buffer = \mod\ui::make()->buffer();
		$buffer->script([
			"@src" => site_url(["stream", "xasset", "ui", $this->section->get_set(), "ui.min.js"])
		]);

		//init
		$buffer->add(\mod\js::get_script());
		$buffer->add(\mod\js::get_domready());

		return $buffer->build();
	}
	//--------------------------------------------------------------------------------
}