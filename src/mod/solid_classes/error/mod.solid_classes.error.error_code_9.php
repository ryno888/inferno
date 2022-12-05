<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_9 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Maintenance";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "The system is offline for planned maintenance. Thank you for your patience.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_MAINTENANCE";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 9;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}