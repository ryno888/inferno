<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class province extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "province";
	public $key = "prv_id";
	public $display = "prv_";

	public $display_name = "Province";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"prv_id"			=> array("Id"		, "null", TYPE_INT, ),
"prv_name"			=> array("Name"		, "", TYPE_VARCHAR, ),
"prv_ref_country"			=> array("Ref Country"		, "null", TYPE_INT, "country"),
	);
 	//--------------------------------------------------------------------------------
}