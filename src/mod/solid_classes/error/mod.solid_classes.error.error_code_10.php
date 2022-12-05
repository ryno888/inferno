<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_10 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Access denied";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "You do not have permission to access the resource you requested. If you think this is incorrect, please contact support.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_ACCESS_DENIED";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 10;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}