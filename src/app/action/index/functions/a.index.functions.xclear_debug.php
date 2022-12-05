<?php

namespace action\index\functions;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class xclear_debug extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {

		//set POST data
		$close_window = $this->request->get("close_window", TYPE_BOOL);

		if(file_exists(DIR_TEMP."/console.txt")){
			@unlink(DIR_TEMP."/console.txt");
		}

		$options["js"] = "$('.debug-wrapper').remove();";
		if($close_window) $options["js"] = "window.top.close();";

		return \mod\http::ajax_response($options);

	}
    //--------------------------------------------------------------------------------

}
