<?php

namespace mod\solid_classes;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class helper extends \mod\intf\standard {
	//--------------------------------------------------------------------------------
	/**
	 * @param $namespace
	 * @param $name
	 * @return false|mixed|\mod\solid_classes\intf
	 */
	public function get($namespace, $name) {
		try{
			$class = "\\mod\\solid_classes\\{$namespace}\\{$name}";
			return call_user_func([$class, "make"]);
		}catch(\Exception $ex){
			\mod\error::create($ex->getMessage(), ["fatal" => true]);
		}
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $constant
	 * @return false|mixed|intf
	 */
	public function get_from_constant($constant) {

		$arr = library::make()->index_arr;
		if(isset($arr[strtoupper($constant)])){
			$data = $arr[strtoupper($constant)];
			return $this->get_from_classname($data["classname"]);
		}
	}
	//--------------------------------------------------------------------------------
	public function constant_to_str($namespace, $constant) {

		array_filter(library::make()->index_arr, function($item)use($namespace, $constant){

		});

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $classname
	 * @return false|mixed|\mod\solid_classes\intf
	 */
	public function get_from_classname($classname) {
		return call_user_func([$classname, "make"]);
	}
	//--------------------------------------------------------------------------------
}