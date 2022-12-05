<?php

namespace mod\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_float extends \mod\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Float";
	protected $datatype = "float";
	protected $default = 0;
	protected $type = TYPE_FLOAT;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return float
	 */
    public function parse($value, $options = []) {

    	//break apart
    	$parts_arr = explode(".", $value);

    	//clean parts from characters
    	foreach ($parts_arr as $key => $part){
    		$parts_arr[$key] = \mod\str::replace($part, [
				"/[^0-9]/" => "",
			]);
		}

    	//rebuild
    	$end = array_pop($parts_arr);
    	$reset = $parts_arr ? implode("", $parts_arr) : "";

    	if($reset) $result = floatval("$reset.$end");
    	else $result = floatval($end);

    	return (float) $result;

    }
    //--------------------------------------------------------------------------------

}
