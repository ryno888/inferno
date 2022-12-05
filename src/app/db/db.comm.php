<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class comm extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "comm";
	public $key = "com_id";
	public $display = "com_";

	public $display_name = "Comm";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"com_id"				=> array("Id"				, "null", TYPE_INT, ),
		"com_date"				=> array("Date"				, "null", TYPE_DATETIME, ),
		"com_date_schedule"		=> array("Date Schedule"	, "null", TYPE_DATETIME, ),
		"com_ref_person"		=> array("Ref Person"		, "null", TYPE_INT, "person"),
		"com_importance"		=> array("Importance"		, "0", TYPE_INT, ),
		"com_error"				=> array("Error"			, "", TYPE_VARCHAR, ),
		"com_ip"				=> array("Ip"				, "", TYPE_VARCHAR, ),
		"com_data"				=> array("Data"				, "", TYPE_VARCHAR, ),
		"com_type"				=> array("Type"				, "0", TYPE_TINYINT, ),
		"com_retrycount"		=> array("Retrycount"		, "0", TYPE_INT, ),
		"com_ref_person_from"	=> array("Ref Person From"	, "null", TYPE_INT, "person_from"),
		"com_is_html"			=> array("Is Html"			, "0", TYPE_TINYINT, ),
		"com_ref_email"			=> array("Ref Email"		, "null", TYPE_INT, "email"),
	);
 	//--------------------------------------------------------------------------------
}