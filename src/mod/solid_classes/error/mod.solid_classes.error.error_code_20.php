<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_20 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Thank you for registering";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Thank you for registering and confirming your new profile.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_SUCCESS_REGISTER";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 20;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}