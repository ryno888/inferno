<?php

namespace action\website\index\functions;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class xlogin extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {


		$per_username = $this->request->get('per_username', TYPE_STRING);
		$per_password = $this->request->get('per_password', TYPE_STRING);

		if(!$per_username || !$per_password)
			return \mod\http::ajax_response(["redirect" => \mod\http::build_action_url("website/index/error", ["code" => "ERROR_CODE_LOGIN_INVALID_DETAILS"])]);

		$person = \mod\user::make()->login($per_username, $per_password);

		if($person)
			return \mod\http::go_home();
//
//		return \mod\http::ajax_response(["redirect" => \mod\http::build_action_url("website/index/error", ["code" => ERROR_CODE_LOGIN_INVALID])]);
//
//	    return \mod\http::ajax_response(["js" => ""]);

	}
    //--------------------------------------------------------------------------------

}
