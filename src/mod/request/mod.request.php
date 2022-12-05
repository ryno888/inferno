<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class request extends \mod\intf\standard {
	/**
	 * @var \CodeIgniter\HTTP\IncomingRequest
	 */
	protected $request;

	protected $get_data;

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

		$this->request = \Config\Services::request();
		$this->get_data = \mod\http::get_parameters();

	}
	//--------------------------------------------------------------------------------
	public function is_ajax() {
		return $this->request->isAJAX();
	}
	//--------------------------------------------------------------------------------
	public function get_csrf() {
		return csrf_hash();
	}
	//--------------------------------------------------------------------------------
	public function get_trusted($var, $data_type, $options = []) {
		$options["trusted"] = true;
		return $this->get($var, $data_type, $options);
	}
	//--------------------------------------------------------------------------------
	public function get_get($var, $data_type, $options = []) {
		$options["get"] = true;
		return $this->get($var, $data_type, $options);
	}
	//--------------------------------------------------------------------------------
	public function getdb($table, $field = false, $options = []) {

	    $options = array_merge([
		    "default" => false,
		    "get" => false,
		    "trusted" => false,
		], $options);

	    $dbt = \core::dbt($table);

	    if($field === true) $key = $dbt->key;
	    else $key = $field;

	    $id = $this->get($key, TYPE_STRING);
	    console($id);

	    if(!$id) return $options["default"];

	    return $dbt->find([
	        ".{$dbt->key}" => $id
        ]);

	}
	//--------------------------------------------------------------------------------
	public function get($var, $data_type, $options = []) {
		$options = array_merge([
		    "default" => false,
		    "get" => false,
		    "trusted" => false,
		], $options);

		$value = null;

		$fn_get_post = function() use($var) { return $this->request->getPost($var); };
		$fn_get_get = function() use($var) { return isset($this->get_data[$var]) ? $this->get_data[$var] : false; };

		//get from request
		if($options["get"]) $value = $fn_get_get();
		else if($options["trusted"]){
			$value = $fn_get_post();
			if(!$value) $value = $fn_get_get();
		}
		else $value = $fn_get_post();

		if(!$value) {
		    //try and request from slug
            $parameters = \mod\http::get_parameters();
            $value = isset($parameters[$var]) ? $parameters[$var] : false;
        }

		if(!$value) {
		    return $options["default"];
        }

		//parse
		return data::parse($value, $data_type);
	}
	//--------------------------------------------------------------------------------
}