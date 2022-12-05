<?php

namespace action\website\index\functions;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class xlogout extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {

		\mod\user::make()->logout();

	}
    //--------------------------------------------------------------------------------

}
