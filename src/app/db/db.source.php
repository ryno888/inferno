<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class source extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "source";
	public $key = "sou_id";
	public $display = "sou_";

	public $display_name = "Source";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"sou_id"			=> array("Id"		, "null", TYPE_INT, ),
"sou_name"			=> array("Name"		, "", TYPE_VARCHAR, ),
"sou_code"			=> array("Code"		, "", TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}