<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class language extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "language";
	public $key = "lan_id";
	public $display = "lan_";

	public $display_name = "Language";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"lan_id"			=> array("Id"		, "null", TYPE_INT, ),
"lan_name"			=> array("Name"		, "", TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}