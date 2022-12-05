<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class email_extension extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "email_extension";
	public $key = "eme_id";
	public $display = "eme_";

	public $display_name = "Email Extension";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"eme_id"			=> array("Id"			, "null"	, TYPE_INT, ),
		"eme_ref_email"		=> array("Ref Email"	, "null"	, TYPE_INT, "email"),
		"eme_type"			=> array("Type"			, "0"		, TYPE_TINYINT, ),
		"eme_value"			=> array("Value"		, ""		, TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}