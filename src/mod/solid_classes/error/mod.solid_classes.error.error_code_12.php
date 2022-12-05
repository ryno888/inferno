<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_12 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "reCAPTCHA Error";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "The reCAPTCHA test failed. Please try again.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_CAPTCHA_ERROR";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 12;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}