<?php
namespace mod\solid_classes;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */

class library extends \mod\intf\standard {

	public $index_arr = [
				"ERROR_CODE_LOGIN_INVALID" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_1",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_1.php",
			"constant" => "ERROR_CODE_LOGIN_INVALID",
			"value" => "1",
			"category" => "ERROR",
		],
		"ERROR_CODE_ACCESS_DENIED" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_10",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_10.php",
			"constant" => "ERROR_CODE_ACCESS_DENIED",
			"value" => "10",
			"category" => "ERROR",
		],
		"ERROR_CODE_ACCOUNT_LOCKED" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_11",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_11.php",
			"constant" => "ERROR_CODE_ACCOUNT_LOCKED",
			"value" => "11",
			"category" => "ERROR",
		],
		"ERROR_CODE_CAPTCHA_ERROR" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_12",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_12.php",
			"constant" => "ERROR_CODE_CAPTCHA_ERROR",
			"value" => "12",
			"category" => "ERROR",
		],
		"ERROR_CODE_SYSTEM_OFFLINE" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_13",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_13.php",
			"constant" => "ERROR_CODE_SYSTEM_OFFLINE",
			"value" => "13",
			"category" => "ERROR",
		],
		"ERROR_CODE_ACCOUNT_INACTIVE" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_14",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_14.php",
			"constant" => "ERROR_CODE_ACCOUNT_INACTIVE",
			"value" => "14",
			"category" => "ERROR",
		],
		"ERROR_CODE_CSRF_TOKEN_MISSING" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_15",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_15.php",
			"constant" => "ERROR_CODE_CSRF_TOKEN_MISSING",
			"value" => "15",
			"category" => "ERROR",
		],
		"ERROR_CODE_UNAUTHORIZED_FORM_SUBMISSION" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_16",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_16.php",
			"constant" => "ERROR_CODE_UNAUTHORIZED_FORM_SUBMISSION",
			"value" => "16",
			"category" => "ERROR",
		],
		"ERROR_CODE_INTERNAL_ERROR" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_17",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_17.php",
			"constant" => "ERROR_CODE_INTERNAL_ERROR",
			"value" => "17",
			"category" => "ERROR",
		],
		"ERROR_CODE_LOGIN_ERROR" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_18",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_18.php",
			"constant" => "ERROR_CODE_LOGIN_ERROR",
			"value" => "18",
			"category" => "ERROR",
		],
		"ERROR_CODE_PENDING_VERIFICATION" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_19",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_19.php",
			"constant" => "ERROR_CODE_PENDING_VERIFICATION",
			"value" => "19",
			"category" => "ERROR",
		],
		"ERROR_CODE_LOGIN_INVALID_DETAILS" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_2",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_2.php",
			"constant" => "ERROR_CODE_LOGIN_INVALID_DETAILS",
			"value" => "2",
			"category" => "ERROR",
		],
		"ERROR_CODE_SUCCESS_REGISTER" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_20",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_20.php",
			"constant" => "ERROR_CODE_SUCCESS_REGISTER",
			"value" => "20",
			"category" => "ERROR",
		],
		"ERROR_CODE_ACCOUNT_UPDATED" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_21",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_21.php",
			"constant" => "ERROR_CODE_ACCOUNT_UPDATED",
			"value" => "21",
			"category" => "ERROR",
		],
		"ERROR_CODE_FORGOT_PASSWORD" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_3",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_3.php",
			"constant" => "ERROR_CODE_FORGOT_PASSWORD",
			"value" => "3",
			"category" => "ERROR",
		],
		"ERROR_CODE_DB_ERROR" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_4",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_4.php",
			"constant" => "ERROR_CODE_DB_ERROR",
			"value" => "4",
			"category" => "ERROR",
		],
		"ERROR_CODE_404" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_404",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_404.php",
			"constant" => "ERROR_CODE_404",
			"value" => "404",
			"category" => "ERROR",
		],
		"ERROR_CODE_NOT_LOGGED_IN" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_5",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_5.php",
			"constant" => "ERROR_CODE_NOT_LOGGED_IN",
			"value" => "5",
			"category" => "ERROR",
		],
		"ERROR_CODE_500" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_500",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_500.php",
			"constant" => "ERROR_CODE_500",
			"value" => "500",
			"category" => "ERROR",
		],
		"ERROR_CODE_ACTIVE_SESSION" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_6",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_6.php",
			"constant" => "ERROR_CODE_ACTIVE_SESSION",
			"value" => "6",
			"category" => "ERROR",
		],
		"ERROR_CODE_REQUEST_ERROR" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_7",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_7.php",
			"constant" => "ERROR_CODE_REQUEST_ERROR",
			"value" => "7",
			"category" => "ERROR",
		],
		"ERROR_CODE_RECOVERY_PASSWORD" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_8",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_8.php",
			"constant" => "ERROR_CODE_RECOVERY_PASSWORD",
			"value" => "8",
			"category" => "ERROR",
		],
		"ERROR_CODE_MAINTENANCE" => [
			"classname" => "\\mod\\solid_classes\\error\\error_code_9",
			"filename" => "C:/inetpub/wwwroot/ember/project-root/ember/mod/solid_classes/mod.solid_classes.error.error_code_9.php",
			"constant" => "ERROR_CODE_MAINTENANCE",
			"value" => "9",
			"category" => "ERROR",
		],
	];

}

