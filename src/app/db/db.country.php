<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class country extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "country";
	public $key = "con_id";
	public $display = "con_";

	public $display_name = "Country";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"con_id"			=> array("Id"		, "null"	, TYPE_INT, ),
		"con_name"			=> array("Name"		, ""		, TYPE_VARCHAR, ),
		"con_code"			=> array("Code"		, ""		, TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}