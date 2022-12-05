<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class file_item extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "file_item";
	public $key = "fil_id";
	public $display = "fil_";

	public $display_name = "File Item";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"fil_id"					=> array("Id"				, "null"	, TYPE_INT,),
		"fil_name"					=> array("Name"				, ""		, TYPE_VARCHAR,),
		"fil_note"					=> array("Note"				, ""		, TYPE_VARCHAR,),
		"fil_date_added"			=> array("Date Added"		, "null"	, TYPE_DATETIME,),
		"fil_date_updated"			=> array("Date Updated"		, "null"	, TYPE_DATETIME,),
		"fil_filename"				=> array("Filename"			, ""		, TYPE_VARCHAR,),
		"fil_link_path"				=> array("Link Path"		, ""		, TYPE_VARCHAR,),
		"fil_source_path"			=> array("Source Path"		, ""		, TYPE_VARCHAR,),
		"fil_source_host"			=> array("Source Host"		, ""		, TYPE_VARCHAR,),
		"fil_size"					=> array("Size"				, "0"		, TYPE_INT,),
		"fil_ref_person_added"		=> array("Ref Person Added"	, "null"	, TYPE_INT	, "person_added"),
		"fil_type"					=> array("Type"				, "0"		, TYPE_TINYINT,),
		"fil_version"				=> array("Version"			, ""		, TYPE_VARCHAR,),
		"fil_date_version"			=> array("Date Version"		, "null"	, TYPE_DATETIME,),
		"fil_extension"				=> array("Extension"		, ""		, TYPE_VARCHAR,),
		"fil_ref_file_data"			=> array("Ref File Data"	, "null"	, TYPE_INT	, "file_data"),
		"fil_is_deleted"			=> array("Is Deleted"		, "0"		, TYPE_TINYINT,),
		"fil_ref_file_item"			=> array("Ref File Item"	, "null"	, TYPE_INT	, "file_item"),
	);
 	//--------------------------------------------------------------------------------
}