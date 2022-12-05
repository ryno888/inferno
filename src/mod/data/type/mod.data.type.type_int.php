<?php

namespace mod\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_int extends \mod\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Integer";
	protected $datatype = "integer";
	protected $default = 0;
	protected $type = TYPE_INT;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return int
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
    	$reset = $parts_arr ? implode("", $parts_arr) : "";
    	$end = array_pop($parts_arr);

    	if($reset) $result = intval("$reset.$end");
    	else $result = intval($end);

    	return (int)$result;

    }
    //--------------------------------------------------------------------------------

}
