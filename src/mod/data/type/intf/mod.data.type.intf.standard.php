<?php

namespace mod\data\type\intf;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

abstract class standard extends \mod\intf\standard {

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected $name;
	protected $default;
	protected $datatype;
	protected $type;
	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
    abstract function parse($value, $options = []);
    //--------------------------------------------------------------------------------

}
