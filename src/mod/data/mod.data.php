<?php

namespace mod;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class data{

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------


	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
    public static function parse($value, $type, $options = []) {

    	switch ($type){
			case TYPE_KEY:
			case TYPE_ENUM:
			case TYPE_REFERENCE:
			case TYPE_INT: return \mod\data\type\type_int::make()->parse($value);
			case TYPE_BOOL: return \mod\data\type\type_bool::make()->parse($value);
		}

		return $value;
    }
    //--------------------------------------------------------------------------------

}
