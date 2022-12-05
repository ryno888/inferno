<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class email_file_item extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "email_file_item";
	public $key = "emf_id";
	public $display = "emf_";

	public $display_name = "Email File Item";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"emf_id"				=> array("Id"				, "null"	, TYPE_INT, ),
		"emf_ref_email"			=> array("Ref Email"		, "null"	, TYPE_INT, "email"),
		"emf_ref_file_item"		=> array("Ref File Item"	, "null"	, TYPE_INT, "file_item"),
		"emf_cid"				=> array("Cid"				, ""		, TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}