<?php

namespace mod\db;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class row {

	/**
	 * @var \mod\db\intf\table
	 */
	protected $instance;
	protected $source;

	protected $id;
	protected $name;

	//--------------------------------------------------------------------------------
	public function __construct($instance, $source) {
		$this->instance = $instance;
		$this->source = $source;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $name
	 * @return intf\table|row
	 * @throws \Exception
	 */
	public function __get($name) {

		if($name == "db") return $this->instance;
		if($name == "id") return $this->{$this->instance->key};

		if(property_exists($this, $name)){
			return $this->{$name};
		}else{
			throw new \Exception("Field [$name] not found.");
		}
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $name
	 * @param $arguments
	 * @return false|mixed|\mod\db\intf\table
	 */
  	public function __call($name, $arguments) {
  		if (method_exists($this->db, $name)) {
  			$arguments = [-1 => $this] + \mod\arr::splat($arguments);
			return call_user_func_array([$this->db, $name], $arguments);
  		}
  		else throw new \Exception("Call to undefined function: $name");
  	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $instance \mod\db\intf\table
	 * @param $source
	 * @return row|\mod\intf\standard|static
	 */
	public static function make($instance, $source) {
		return new static($instance, $source);
	}
	//--------------------------------------------------------------------------------
}