<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_2 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Invalid details";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Invalid username, please enter your username to continue.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_LOGIN_INVALID_DETAILS";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 2;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}