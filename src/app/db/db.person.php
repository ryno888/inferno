<?php

namespace db;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class person extends \mod\db\intf\table {

	public $name = "person";
	public $key = "per_id";
	public $display = "per_name";

	public $display_name = "person";
	public $string = "per_email";

	public $field_arr = array(
	 	// identification
		"per_id" 						=> array("database id"				, "null", TYPE_KEY),
		"per_name" 						=> array("name"						, ""	, TYPE_STRING),
		"per_title" 					=> array("title"					, 0		, TYPE_ENUM),
		"per_initial" 					=> array("initials"					, "" 	, TYPE_STRING),
		"per_firstname" 				=> array("first names"				, ""	, TYPE_STRING),
		"per_lastname" 					=> array("surname"					, ""	, TYPE_STRING),
		"per_preferredname" 			=> array("preferred name"			, ""	, TYPE_STRING),
		"per_idnr" 						=> array("identity number"			, ""	, TYPE_STRING),
		"per_idnr_clean" 				=> array("clean identity number"	, ""	, TYPE_STRING),
		"per_passportnr" 				=> array("passport number"			, ""	, TYPE_STRING),
		"per_taxnr" 					=> array("tax number"				, ""	, TYPE_STRING),
		"per_vatnr" 					=> array("vat number"				, ""	, TYPE_STRING),
		"per_findstring" 				=> array("find string"				, ""	, TYPE_STRING),
		"per_tradingname" 				=> array("trading name"				, ""	, TYPE_STRING),
		"per_maidenname" 				=> array("maiden name"				, "" 	, TYPE_STRING),
		"per_birthday" 					=> array("birthday"					, "null", TYPE_DATE),
		"per_gender" 					=> array("gender"					, 0 	, TYPE_ENUM),
		"per_jobtitle" 					=> array("job title"				, ""	, TYPE_STRING),
		"per_is_deceased" 				=> array("is deceased"				, 0		, TYPE_BOOL),
		// contact
		"per_telnr_home" 				=> array("home number"				, "  "	, TYPE_TELNR),
		"per_telnr_work"				=> array("work number"				, "  "	, TYPE_TELNR),
		"per_cellnr"					=> array("cell number"				, "  "	, TYPE_TELNR),
		"per_faxnr"						=> array("fax number"				, "  "	, TYPE_TELNR),
		"per_email" 					=> array("email"					, ""	, TYPE_EMAIL),
		"per_email_work" 				=> array("work email"				, ""	, TYPE_EMAIL),
		"per_website"	 				=> array("website"					, ""	, TYPE_STRING),

		// account
		"per_username" 					=> array("username"					, ""	, TYPE_STRING),
		"per_password" 					=> array("password"					, "null", TYPE_STRING),
		"per_is_active" 				=> array("is active"				, 0		, TYPE_BOOL),
		"per_date_login"				=> array("login date"				, "null", TYPE_DATE),
		"per_date_login_previous"		=> array("previous login date"		, "null", TYPE_DATE),
		"per_retry_count"				=> array("login retry count"		, 0		, TYPE_INT),
		"per_retry_date"				=> array("last login try date"		, "null", TYPE_DATE),
		"per_enable_concurrent_login" 	=> array("enable concurrent login"	, 0		, TYPE_BOOL),
	);

	//--------------------------------------------------------------------------------
	public static function test(){
		display("test");
	}
	//--------------------------------------------------------------------------------
}