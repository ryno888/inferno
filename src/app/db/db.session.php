<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class session extends \mod\db\intf\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $name = "session";
	public $key = "ses_id";
	public $display = "ses_";

	public $display_name = "Session";

	public $field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		"ses_id"			=> array("Id"		, "null", TYPE_INT, ),
"ses_session_id"			=> array("Session Id"		, "", TYPE_VARCHAR, ),
"ses_status"			=> array("Status"		, "0", TYPE_TINYINT, ),
"ses_namespace"			=> array("Namespace"		, "", TYPE_VARCHAR, ),
"ses_url"			=> array("Url"		, "", TYPE_VARCHAR, ),
"ses_update_count"			=> array("Update Count"		, "0", TYPE_INT, ),
"ses_date_added"			=> array("Date Added"		, "null", TYPE_DATETIME, ),
"ses_date_seen"			=> array("Date Seen"		, "null", TYPE_DATETIME, ),
"ses_date_end"			=> array("Date End"		, "null", TYPE_DATETIME, ),
"ses_date_expire"			=> array("Date Expire"		, "null", TYPE_DATETIME, ),
"ses_ref_person"			=> array("Ref Person"		, "null", TYPE_INT, "person"),
"ses_ref_person_as"			=> array("Ref Person As"		, "null", TYPE_INT, "person_as"),
"ses_ref_person_active"			=> array("Ref Person Active"		, "null", TYPE_INT, "person_active"),
"ses_ref_acl_role"			=> array("Ref Acl Role"		, "null", TYPE_INT, "acl_role"),
"ses_ref_acl_role_active"			=> array("Ref Acl Role Active"		, "null", TYPE_INT, "acl_role_active"),
"ses_ip"			=> array("Ip"		, "", TYPE_VARCHAR, ),
"ses_agent"			=> array("Agent"		, "", TYPE_VARCHAR, ),
"ses_platform"			=> array("Platform"		, "", TYPE_VARCHAR, ),
"ses_platform_version"			=> array("Platform Version"		, "", TYPE_VARCHAR, ),
"ses_browser"			=> array("Browser"		, "", TYPE_VARCHAR, ),
"ses_bit"			=> array("Bit"		, "", TYPE_VARCHAR, ),
"ses_browser_name"			=> array("Browser Name"		, "", TYPE_VARCHAR, ),
"ses_browser_version"			=> array("Browser Version"		, "", TYPE_VARCHAR, ),
"ses_otp"			=> array("Otp"		, "", TYPE_VARCHAR, ),
"ses_otp_date_expire"			=> array("Otp Date Expire"		, "null", TYPE_DATETIME, ),
"ses_otp_retry_count"			=> array("Otp Retry Count"		, "0", TYPE_INT, ),
	);
 	//--------------------------------------------------------------------------------
}