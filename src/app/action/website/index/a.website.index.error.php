<?php

namespace action\website\index;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class error extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {

		$code = $this->request->get_trusted("code", TYPE_STRING);

		$instance = \mod\solid_classes\helper::make()->get_from_constant($code);
		if(!$instance) $instance = \mod\solid_classes\helper::make()->get_from_constant("ERROR_CODE_500");


		return "website";
	}
    //--------------------------------------------------------------------------------

}
