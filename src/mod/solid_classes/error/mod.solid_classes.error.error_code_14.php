<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_14 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Account inactive";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Your account is not active. Please contact support.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_ACCOUNT_INACTIVE";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 14;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}