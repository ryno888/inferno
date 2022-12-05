<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class map extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "map";
	public $key = "map_id";
	public $display = "map_";

	public $display_name = "Map";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"map_id"			=> array("Id"		, "null", TYPE_INT, ),
"map_name"			=> array("Name"		, "", TYPE_VARCHAR, ),
"map_ref_table"			=> array("Ref Table"		, "", TYPE_VARCHAR, "table"),
"map_ref_id"			=> array("Ref Id"		, "0", TYPE_INT, "id"),
"map_ref_source"			=> array("Ref Source"		, "null", TYPE_INT, "source"),
"map_is_approved"			=> array("Is Approved"		, "0", TYPE_TINYINT, ),
"map_date_added"			=> array("Date Added"		, "null", TYPE_DATETIME, ),
"map_ref_person"			=> array("Ref Person"		, "null", TYPE_INT, "person"),
	);
 	//--------------------------------------------------------------------------------
}