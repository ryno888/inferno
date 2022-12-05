<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_19 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Pending Account Verification";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "Your account is pending verification. Should we resend the verification email?";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_PENDING_VERIFICATION";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 19;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}