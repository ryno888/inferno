<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class acl_role extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "acl_role";
	public $key = "acl_id";
	public $display = "acl_";

	public $display_name = "Acl Role";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"acl_id"			=> array("Id"				, "null"	, TYPE_INT, ),
		"acl_name"			=> array("Name"				, ""		, TYPE_VARCHAR, ),
		"acl_code"			=> array("Code"				, ""		, TYPE_VARCHAR, ),
		"acl_is_locked"		=> array("Is Locked"		, "0"		, TYPE_TINYINT, ),
		"acl_level"			=> array("Level"			, "0.00000"	, TYPE_DECIMAL, ),
	);
 	//--------------------------------------------------------------------------------
}