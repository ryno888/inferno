<?php

namespace mod\solid_classes\error;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error_code_4 extends \mod\solid_classes\intf {
	//--------------------------------------------------------------------------------
	public function get_display_name(): string {
		return "Database error";
	}
	//--------------------------------------------------------------------------------
	public function get_description(): string {
		return "The database is unavailable at the moment, please try again later.";
	}
	//--------------------------------------------------------------------------------
	public function get_code(): string {
		return "ERROR_CODE_DB_ERROR";
	}
	//--------------------------------------------------------------------------------
	public function get_value(): int {
		return 4;
	}
	//--------------------------------------------------------------------------------
	public function get_data_type() {
		return TYPE_INT;
	}
	//--------------------------------------------------------------------------------
}