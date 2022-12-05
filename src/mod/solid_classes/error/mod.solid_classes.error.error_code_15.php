<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_15 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "CSRF Token missing";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "The system could not complete this action due to a missing form token. You may have cleared your browser cookies or logged in on a different tab, which could have resulted in the expiry of your current form token.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_CSRF_TOKEN_MISSING";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 15;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}