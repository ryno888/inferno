<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_21 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Account Username / Email Changed";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Your account username and email address has been updated.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_ACCOUNT_UPDATED";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 21;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}