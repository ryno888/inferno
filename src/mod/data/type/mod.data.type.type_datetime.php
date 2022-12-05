<?php

namespace mod\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_datetime extends \mod\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Date";
	protected $datatype = "string";
	protected $default = null;
	protected $type = TYPE_DATETIME;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return bool|string|null
	 */
    public function parse($value, $options = []) {

    	$options = array_merge([
    	    "format" => false
    	], $options);

    	try{
    		return \mod\date::strtodatetime($value, $options["format"], $options);
		}catch(\Exception $ex){
			return $this->default;
		}
    }
    //--------------------------------------------------------------------------------

}
