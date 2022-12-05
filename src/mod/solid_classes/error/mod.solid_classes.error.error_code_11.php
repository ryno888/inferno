<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_11 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Account locked";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "You have had more than 3 failed login attempts. Your account has been locked for 15 minutes. If you continue to have problems, please contact support.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_ACCOUNT_LOCKED";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 11;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}