<?php

namespace mod\data\type;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class type_enum extends \mod\data\type\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name = "Enum";
	protected $datatype = "enum";
	protected $default = 0;
	protected $type = TYPE_ENUM;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param array $options
	 * @return int
	 */
    public function parse($value, $options = []) {

    	return type_int::make()->parse($value);

    }
    //--------------------------------------------------------------------------------

}
