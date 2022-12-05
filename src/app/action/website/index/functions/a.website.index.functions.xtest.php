<?php

namespace action\website\index\functions;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class xtest extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {


	    $error_arr= [];
	    $error_arr["test"] = "This is an error";

	    return \mod\http::ajax_response(["errors" => $error_arr]);

	}
    //--------------------------------------------------------------------------------

}
