<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class address extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "address";
	public $key = "add_id";
	public $display = "add_";

	public $display_name = "Address";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"add_id"				=> array("Id"				, "null"	, TYPE_INT, ),
		"add_name"				=> array("Name"				, ""		, TYPE_VARCHAR, ),
		"add_type"				=> array("Type"				, "0"		, TYPE_TINYINT, ),
		"add_nomination"		=> array("Nomination"		, "0"		, TYPE_TINYINT, ),
		"add_ref_suburb"		=> array("Ref Suburb"		, "null"	, TYPE_INT, "suburb"),
		"add_ref_town"			=> array("Ref Town"			, "null"	, TYPE_INT, "town"),
		"add_ref_province"		=> array("Ref Province"		, "null"	, TYPE_INT, "province"),
		"add_ref_country"		=> array("Ref Country"		, "null"	, TYPE_INT, "country"),
		"add_unitnr"			=> array("Unitnr"			, ""		, TYPE_VARCHAR, ),
		"add_floor"				=> array("Floor"			, ""		, TYPE_VARCHAR, ),
		"add_building"			=> array("Building"			, ""		, TYPE_VARCHAR, ),
		"add_farm"				=> array("Farm"				, ""		, TYPE_VARCHAR, ),
		"add_streetnr"			=> array("Streetnr"			, ""		, TYPE_VARCHAR, ),
		"add_street"			=> array("Street"			, ""		, TYPE_VARCHAR, ),
		"add_development"		=> array("Development"		, ""		, TYPE_VARCHAR, ),
		"add_attention"			=> array("Attention"		, ""		, TYPE_VARCHAR, ),
		"add_pobox"				=> array("Pobox"			, ""		, TYPE_VARCHAR, ),
		"add_postnet"			=> array("Postnet"			, ""		, TYPE_VARCHAR, ),
		"add_privatebag"		=> array("Privatebag"		, ""		, TYPE_VARCHAR, ),
		"add_clusterbox"		=> array("Clusterbox"		, ""		, TYPE_VARCHAR, ),
		"add_line1"				=> array("Line1"			, ""		, TYPE_VARCHAR, ),
		"add_line2"				=> array("Line2"			, ""		, TYPE_VARCHAR, ),
		"add_line3"				=> array("Line3"			, ""		, TYPE_VARCHAR, ),
		"add_line4"				=> array("Line4"			, ""		, TYPE_VARCHAR, ),
		"add_code"				=> array("Code"				, ""		, TYPE_VARCHAR, ),
		"add_raw"				=> array("Raw"				, "null"	, TYPE_TEXT, ),
		"add_ref_person"		=> array("Ref Person"		, "null"	, TYPE_INT, "person"),
		"add_ref_address"		=> array("Ref Address"		, "null"	, TYPE_INT, "address"),
	);
 	//--------------------------------------------------------------------------------
}