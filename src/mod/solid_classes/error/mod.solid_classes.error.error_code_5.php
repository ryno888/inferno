<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_5 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Not logged in";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "You are not logged in or your session timed out, please click on the login link below.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_NOT_LOGGED_IN";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 5;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}