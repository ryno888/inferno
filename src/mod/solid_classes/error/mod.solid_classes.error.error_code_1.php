<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_1 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Login error";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Invalid username and/or password.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_LOGIN_INVALID";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 1;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}