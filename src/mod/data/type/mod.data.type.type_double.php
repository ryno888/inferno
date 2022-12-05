<?php

namespace mod\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_double extends \mod\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Double";
	protected $datatype = "double";
	protected $default = 0;
	protected $type = TYPE_DOUBLE;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return double
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

    	if($reset) $result = doubleval("$reset.$end");
    	else $result = doubleval($end);

    	return (double)$result;

    }
    //--------------------------------------------------------------------------------

}
