<?php

namespace mod\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_bool extends \mod\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Boolean";
	protected $datatype = "boolean";
	protected $default = false;
	protected $type = TYPE_BOOL;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return bool
	 */
    public function parse($value, $options = []) {

        if(is_bool($value)) return $value;
        if(is_string($value)){
            if($value === "false") return false;
            if($value === "true") return true;
            if(isnull($value)) return false;
        }

		$intval = type_int::make()->parse($value);

		if($intval == 0 && strlen($value) == 0) $result = false;
		elseif($intval == 0 && strlen($value) == 1) $result = false;
		elseif($intval == 0 && strlen($value) != 0) $result = true;
		elseif($intval > 0) $result = true;
		else $result = false;

    	return (boolean) $result;

    }
    //--------------------------------------------------------------------------------

}
