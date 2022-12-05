<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class person_type extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "person_type";
	public $key = "pty_id";
	public $display = "pty_";

	public $display_name = "Person Type";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"pty_id"			=> array("Id"		, "null", TYPE_INT, ),
"pty_name"			=> array("Name"		, "", TYPE_VARCHAR, ),
"pty_is_individual"			=> array("Is Individual"		, "0", TYPE_TINYINT, ),
"pty_code"			=> array("Code"		, "", TYPE_VARCHAR, ),
"pty_idnr_name"			=> array("Idnr Name"		, "", TYPE_VARCHAR, ),
"pty_need_verification"			=> array("Need Verification"		, "0", TYPE_TINYINT, ),
"pty_is_international"			=> array("Is International"		, "0", TYPE_TINYINT, ),
"pty_idnr_criteria"			=> array("Idnr Criteria"		, "null", TYPE_TEXT, ),
	);
 	//--------------------------------------------------------------------------------
}