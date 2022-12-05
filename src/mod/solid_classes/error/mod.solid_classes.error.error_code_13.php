<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_13 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "System offline";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "The system is currently offline, we are attending to the problem.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_SYSTEM_OFFLINE";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 13;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}