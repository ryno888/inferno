<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_16 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Unauthorized form submission";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "The system could not complete this action due to an unauthorized form token. Please contact support if the problem persists.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_UNAUTHORIZED_FORM_SUBMISSION";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 16;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}