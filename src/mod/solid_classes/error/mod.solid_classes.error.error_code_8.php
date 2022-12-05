<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_8 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Password recovery";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Your new access details have been saved.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_RECOVERY_PASSWORD";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 8;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}