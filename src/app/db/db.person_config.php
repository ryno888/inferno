<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class person_config extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "person_config";
	public $key = "peg_id";
	public $display = "peg_";

	public $display_name = "Person Config";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"peg_id"			=> array("Id"		, "null", TYPE_INT, ),
"peg_ref_person"			=> array("Ref Person"		, "null", TYPE_INT, "person"),
	);
 	//--------------------------------------------------------------------------------
}