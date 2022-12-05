<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_500 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Internal error 500";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "The system encountered an error while processing your request. The administrator has been notified and will be attending to the problem. We apologize for any inconvenience. Please try again later.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_500";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 500;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}