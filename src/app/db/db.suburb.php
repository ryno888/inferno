<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class suburb extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "suburb";
	public $key = "sub_id";
	public $display = "sub_";

	public $display_name = "Suburb";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"sub_id"			=> array("Id"		, "null", TYPE_INT, ),
"sub_name"			=> array("Name"		, "", TYPE_VARCHAR, ),
"sub_name_af"			=> array("Name Af"		, "", TYPE_VARCHAR, ),
"sub_ref_town"			=> array("Ref Town"		, "null", TYPE_INT, "town"),
"sub_postal_code"			=> array("Postal Code"		, "", TYPE_VARCHAR, ),
"sub_residential_code"			=> array("Residential Code"		, "", TYPE_VARCHAR, ),
	);
 	//--------------------------------------------------------------------------------
}