<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_404 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Error 404";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "The page you are looking for is not available.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_404";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 404;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}