<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_18 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Login error";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "The system encountered an error while logging you in. For assistance, please contact support.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_LOGIN_ERROR";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 18;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}