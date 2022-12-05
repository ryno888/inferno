<?php

namespace action\index;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class vdebug extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {

		if(file_exists(DIR_TEMP."/console.txt")){
			$buffer->xdebug();
			$buffer->pre_(["." => true]);
				$buffer->add(file_get_contents(DIR_TEMP."/console.txt"));
			$buffer->_pre();
		}
		return "clean";
	}
    //--------------------------------------------------------------------------------

}
