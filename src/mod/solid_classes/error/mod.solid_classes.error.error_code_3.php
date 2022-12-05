<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_3 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Forgot password";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Thank you, an email has been sent to your inbox. Please check it for further instructions on resetting your password";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_FORGOT_PASSWORD";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 3;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}