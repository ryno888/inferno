<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class email_person extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "email_person";
	public $key = "emp_id";
	public $display = "emp_";

	public $display_name = "Email Person";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"emp_id"			=> array("Id"			, "null"	, TYPE_INT, ),
		"emp_ref_email"		=> array("Ref Email"	, "null"	, TYPE_INT, "email"),
		"emp_ref_person"	=> array("Ref Person"	, "null"	, TYPE_INT, "person"),
		"emp_type"			=> array("Type"			, "0"		, TYPE_TINYINT, ),
		"emp_email"			=> array("Email"		, ""		, TYPE_VARCHAR, ),
		"emp_name"			=> array("Name"			, ""		, TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}