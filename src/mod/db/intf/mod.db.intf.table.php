<?php

namespace mod\db\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class table {

	/**
	 * @var \CodeIgniter\Database\BaseConnection
	 */
	protected $connection;

	public $key;
	public $name;
	public $display;
	public $display_name;
	public $string;

	/**
	 * FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
	 * @var array
	 */
	public $field_arr = [];

	//db row
	protected $obj;

	//--------------------------------------------------------------------------------
	public function __construct() {

		$this->connection = \mod\connection::get_connection();

	}
	//--------------------------------------------------------------------------------
	private function apply_result_arr(&$result_arr, $options = []){

		if($options["multiple"]){
			$return = [];
			foreach ($result_arr as $key => $result_data){
				$obj = $this->init_row($result_data);
				$return[$obj->id] = $obj;
			}
			return $this->obj = $return;
		}else{
			if(!$result_arr) return false;
			return $this->obj = $this->init_row($result_arr);
		}
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $mixed
	 * @param array $options
	 * @return array|\mod\db\row|\mod\db\intf\table|\mod\db\row[]|\mod\db\intf\table[]
	 */
	public function get_fromdb($mixed, $options = []) {

		$options = array_merge([
		    "multiple" => false,
		], $options);

		//sql
		$sql = \mod\db\sql\select::make();
		$sql->select("{$this->name}.*");
		$sql->from($this->name);

		if(is_int($mixed)){
			$sql->and_where("{$this->key} = ".dbvalue($mixed));
		}else if(is_string($mixed)){
			$sql->and_where($mixed);
		}
		//limit
		if(!$options["multiple"]) $sql->limit(1);

		$result_arr = $sql->run();

		return $this->apply_result_arr($result_arr, $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $sql \mod\db\sql\select
	 * @param array $options
	 * @return array|\mod\db\row|\mod\intf\standard
	 */
	public function get_fromsql(&$sql, $options = []) {

		$options = array_merge([
		    "multiple" => false,
		], $options);

		//limit
		if(!$options["multiple"]) $sql->limit(1);

		$result_arr = $sql->run();

		return $this->apply_result_arr($result_arr, $options);

	}

	//--------------------------------------------------------------------------------
	public function get_fromobj($obj) {
		// params
		$new_obj = \mod\db\row::make($this, "object");

		// add relevant fields found in object
		foreach ($this->field_arr as $field_index => $field_item) {
			if (isset($obj->{$field_index})) {
				$new_obj->{$field_index} = $obj->{$field_index};
			}
		}

		// return object
		return $new_obj;
	}

	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return array|\mod\db\row|\mod\intf\standard
	 * @throws \Exception
	 */
	public function find($options = []) {

		$options = array_merge([
		    "create" => false,
		    "multiple" => false,
		], $options);

		if($options["create"] && $options["multiple"]) throw new \Exception("Unsupported: Multiple and Create cant both be true");

		$where_arr = \mod\arr::extract_signature_items(".", $options);

		$sql = \mod\db\sql\select::make();
		$sql->select("{$this->name}.*");
		$sql->from($this->name);

		foreach ($where_arr as $field => $value){
			if(is_null($value)){
				$sql->and_where("{$field} IS NULL");
			}else{
				if(substr($value, 0, 1) == "!"){
					$v = substr($value, 1, strlen($value));
					if($v == "null" || is_null($v)){
						$sql->and_where("{$field} IS NOT NULL");
					}else{
						$sql->and_where("{$field} <> ".dbvalue($v));
					}
				}else{
					$sql->and_where("{$field} = ".dbvalue($value));
				}
			}
		}

		$result = $this->get_fromsql($sql, $options);

		if(!$result && !$options["multiple"] && $options["create"]){
			$result = $this->get_fromdefault();

			foreach ($where_arr as $field => $value){
				if(substr($value, 0, 1) != "!"){
					$result->{$field} = $value;
				}
			}
		}elseif(!$result && $options["multiple"]){
			return [];
		}

		return $result;

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param array $options
	 * @return \mod\db\row|\mod\intf\standard
	 */
	public function get_fromdefault($options = []) {

		//init defaults
		return $this->init_row();

	}

	//--------------------------------------------------------------------------------
	/**
	 * @param array $options
	 * @return \mod\db\row|\mod\intf\standard
	 */
	public function update($obj, $options = []) {

		if(!$obj->id)
			throw new \Exception("Cannot update db entry without a primary id");

		//sql
		$builder = $this->connection->table($this->name);
		$builder->where("{$this->key} = ".dbvalue($obj->id));

		$field_arr = $obj->get_array(["filter_empty" => true]);
		foreach ($field_arr as $field => $value){
			$builder->set($field, $value);
		}
		$builder->update();

	}
	//--------------------------------------------------------------------------------
	public function is_empty($obj, $field, $options = []) {

		$default = $this->field_arr[$field][1];

		if($obj && property_exists($obj, $field)){
			return $obj->{$field} == $default;
		}

		return true;

	}
	//--------------------------------------------------------------------------------
	public function get_array($obj, $options = []) {

		$options = array_merge([
		    "filter_empty" => false
		], $options);

		//init defaults
		$return_arr = [];

		if(!$obj) return $return_arr;

		foreach ($this->field_arr as $field => $field_options){
			if($obj && property_exists($obj, $field)){
				if($options["filter_empty"]){
					if(!$obj->is_empty($field))
						$return_arr[$field] = $obj->{$field};
				}else{
					$return_arr[$field] = $obj->{$field};
				}
			}else if(!$options["filter_empty"]){
				$return_arr[$field] = $field_options[1];
			}
		}

		return $return_arr;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param array $arr
	 * @return \mod\db\row|\mod\intf\standard|\mod\db\row
	 */
	private function init_row($arr = []) {

		$obj = \mod\db\row::make($this, "new");

		//defaults
		foreach ($this->field_arr as $field => $field_options){
			$obj->{$field} = $field_options[1];
		}

		//merge data
		foreach ($arr as $field => $value){
			$obj->{$field} = $value;
		}

		return $obj;

	}
//	//--------------------------------------------------------------------------------
//	public function merge_witharray($arr = []) {
//		foreach ($arr as $field => $value){
//			$this->obj->{$field} = $value;
//		}
//	}
	//--------------------------------------------------------------------------------
}