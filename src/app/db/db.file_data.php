<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class file_data extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "file_data";
	public $key = "fid_id";
	public $display = "fid_";

	public $display_name = "File Data";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"fid_id"			=> array("Id"		, "null", TYPE_INT, ),
		"fid_data"			=> array("Data"		, "null", TYPE_LONGBLOB, ),
	);
 	//--------------------------------------------------------------------------------
}