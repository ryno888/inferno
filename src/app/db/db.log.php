<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class log extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "log";
	public $key = "log_id";
	public $display = "log_";

	public $display_name = "Log";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"log_id"			=> array("Id"		, "null", TYPE_INT, ),
"log_date"			=> array("Date"		, "null", TYPE_DATETIME, ),
"log_ref_person"			=> array("Ref Person"		, "null", TYPE_INT, "person"),
"log_ref_person_active"			=> array("Ref Person Active"		, "null", TYPE_INT, "person_active"),
"log_type"			=> array("Type"		, "0", TYPE_TINYINT, ),
"log_table"			=> array("Table"		, "", TYPE_VARCHAR, ),
"log_key"			=> array("Key"		, "null", TYPE_INT, ),
"log_summary"			=> array("Summary"		, "", TYPE_VARCHAR, ),
"log_detail"			=> array("Detail"		, "null", TYPE_TEXT, ),
"log_ip"			=> array("Ip"		, "", TYPE_VARCHAR, ),
"log_url"			=> array("Url"		, "", TYPE_VARCHAR, ),
"log_ref_session"			=> array("Ref Session"		, "null", TYPE_INT, "session"),
	);
 	//--------------------------------------------------------------------------------
}