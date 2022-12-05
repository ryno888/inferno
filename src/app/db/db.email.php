<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class email extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "email";
	public $key = "ema_id";
	public $display = "ema_";

	public $display_name = "Email";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"ema_id"				=> array("Id"				, "null"	, TYPE_INT, ),
		"ema_subject"			=> array("Subject"			, ""		, TYPE_VARCHAR, ),
		"ema_body"				=> array("Body"				, "null"	, TYPE_TEXT, ),
		"ema_status"			=> array("Status"			, "0"		, TYPE_TINYINT, ),
		"ema_ref_person"		=> array("Ref Person"		, "null"	, TYPE_INT, "person"),
		"ema_priority"			=> array("Priority"			, "0"		, TYPE_INT, ),
		"ema_error_message"		=> array("Error Message"	, ""		, TYPE_VARCHAR, ),
		"ema_retry_count"		=> array("Retry Count"		, "0"		, TYPE_INT, ),
		"ema_date_added"		=> array("Date Added"		, "null"	, TYPE_DATETIME, ),
		"ema_date_sent"			=> array("Date Sent"		, "null"	, TYPE_DATETIME, ),
		"ema_date_schedule"		=> array("Date Schedule"	, "null"	, TYPE_DATETIME, ),
		"ema_connection"		=> array("Connection"		, ""		, TYPE_VARCHAR, ),
		"ema_message_id"		=> array("Message Id"		, ""		, TYPE_VARCHAR, ),
		"ema_ref_email"			=> array("Ref Email"		, "null"	, TYPE_INT, "email"),
		"ema_ref_email_start"	=> array("Ref Email Start"	, "null"	, TYPE_INT, "email_start"),
	);
 	//--------------------------------------------------------------------------------
}