<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class town extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "town";
	public $key = "tow_id";
	public $display = "tow_";

	public $display_name = "Town";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"tow_id"			=> array("Id"		, "null", TYPE_INT, ),
"tow_name"			=> array("Name"		, "", TYPE_VARCHAR, ),
"tow_name_af"			=> array("Name Af"		, "", TYPE_VARCHAR, ),
"tow_ref_province"			=> array("Ref Province"		, "null", TYPE_INT, "province"),
"tow_ref_country"			=> array("Ref Country"		, "null", TYPE_INT, "country"),
	);
 	//--------------------------------------------------------------------------------
}