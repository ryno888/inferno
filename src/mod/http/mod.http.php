<?php

namespace mod;

/**
 * @package com
 * @author Ryno Van Zyl
 */
class http {
	//--------------------------------------------------------------------------------
	public static $message_arr = [
//		CODE_LOGIN_INVALID => [
//			"title" => "Login error",
//			"message" => "Invalid username and/or password.",
//		],
//		CODE_LOGIN_INVALID_DETAILS => [
//			"title" => "Invalid details",
//			"message" => "Invalid username, please enter your username to continue.",
//		],
//		CODE_FORGOT_PASSWORD => [
//			"title" => "Forgot password",
//			"message" => "Thank you, an email has been sent to your inbox. Please check it for further instructions on resetting your password",
//		],
//		CODE_DB_ERROR => [
//			"title" => "Database error",
//			"message" => "The database is unavailable at the moment, please try again later.",
//		],
//		CODE_NOT_LOGGED_IN => [
//			"title" => "Not logged in",
//			"message" => "You are not logged in or your session timed out, please click on the login link below.",
//		],
//		CODE_ACTIVE_SESSION => [
//			"title" => "You have an active session",
//			"message" => "You are already logged in, please logout first.",
//		],
//		CODE_REQUEST_ERROR => [
//			"title" => "Request error",
//			"message" => "Your request does not exist or it has expired.",
//		],
//		CODE_RECOVERY_PASSWORD => [
//			"title" => "Password recovery",
//			"message" => "Your new access details have been saved.",
//		],
//		CODE_MAINTENANCE => [
//			"title" => "Maintenance",
//			"message" => "The system is offline for planned maintenance. Thank you for your patience.",
//		],
//		CODE_ACCESS_DENIED => [
//			"title" => "Access denied",
//			"message" => "You do not have permission to access the resource you requested. If you think this is incorrect, please contact support.",
//		],
//		CODE_ACCOUNT_LOCKED => [
//			"title" => "Account locked",
//			"message" => "You have had more than 3 failed login attempts. Your account has been locked for 15 minutes. If you continue to have problems, please contact support.",
//		],
//		CODE_CAPTCHA_ERROR => [
//			"title" => "Forgot password",
//			"message" => "The reCAPTCHA test failed. Please try again.",
//		],
//		CODE_SYSTEM_OFFLINE => [
//			"title" => "System offline",
//			"message" => "The system is currently offline, we are attending to the problem.",
//		],
//		CODE_ACCOUNT_INACTIVE => [
//			"title" => "Account inactive",
//			"message" => "Your account is not active. Please contact support.",
//		],
//		CODE_CSRF_TOKEN_MISSING => [
//			"title" => "CSRF Token missing",
//			"message" => "The system could not complete this action due to a missing form token. You may have cleared your browser cookies or logged in on a different tab, which could have resulted in the expiry of your current form token.",
//		],
//		CODE_UNAUTHORIZED_FORM_SUBMISSION => [
//			"title" => "Unauthorized form submission",
//			"message" => "The system could not complete this action due to an unauthorized form token. Please contact support if the problem persists.",
//		],
//		CODE_INTERNAL_ERROR => [
//			"title" => "Internal error",
//			"message" => "The system encountered an error while processing your request. The administrator has been notified and will be attending to the problem. We apologize for any inconvenience. Please try again later.",
//		],
//		CODE_LOGIN_ERROR => [
//			"title" => "Login error",
//			"message" => "The system encountered an error while logging you in. For assistance, please contact support.",
//		],
//        CODE_PENDING_VERIFICATION => [
//			"title" => "Pending Account Verification",
//			"message" => "Your account is pending verification. Should we resend the verification email?",
//		],
//        CODE_SUCCESS_REGISTER => [
//			"title" => "Thank you for registering",
//			"message" => "Thank you for registering and confirming your new profile.",
//		],
//        CODE_ACCOUNT_UPDATED => [
//			"title" => "Account Username / Email Changed",
//			"message" => "Your account username and email address has been updated.",
//		],
//        CODE_404 => [
//			"title" => "Error 404",
//			"message" => "We're sorry, but the page you are looking for doesn't exist. You can search your topic using the box below or return to the homepage.",
//		],
//        CODE_500 => [
//			"title" => "Internal error",
//			"message" => "The system encountered an error while processing your request. The administrator has been notified and will be attending to the problem. We apologize for any inconvenience. Please try again later.",
//		],
	];
	//--------------------------------------------------------------------------------
	public static function stream_file($filepath, $options = []) {
		// options
		$options = array_merge([
			"filename" => basename($filepath),
			"download" => true,
			"cache" => true,
		], $options);

		if($options["cache"] && $options["download"]) $options["cache"] = false;

		// check if our file exists
		if (!file_exists($filepath)) return;

		// stream
		$file = fopen($filepath, "r");
		self::stream($file, $options["filename"], $options);
		fclose($file);
	}
	//--------------------------------------------------------------------------------
	public static function stream($data, $filename, $options = []) {
		// options
		$options = array_merge([
			"download" => true,
			"cache" => true,
		], $options);

		if($options["cache"]) self::add_cache_headers($filename, $options);
		else self::add_stream_headers($filename, $options);

		if (is_resource($data)) {
			while (!feof($data)) {
				echo fread($data, 8192);
				ob_flush();
			}
		}
		else {
			echo $data;
		}

		return "stream";
	}
	//--------------------------------------------------------------------------------
    public static function add_stream_headers($filename, $options = []) {
		// options
		$options = array_merge([
			"download" => true,
		], $options);

    	// clear output buffer
		if (ob_get_level()) ob_end_clean();

		// add stream headers
		header("Pragma: public");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Transfer-Encoding: binary");
		header("HTTP/1.1 200 OK");

		 // content-type
		$content_type = self::get_mime_type(pathinfo($filename, PATHINFO_EXTENSION));
		header("Content-Type: {$content_type}");

		if ($options["download"]) {
			header('Content-Disposition: attachment; filename="'.$filename.'"');
		}
    }
    //--------------------------------------------------------------------------------
    public static function add_cache_headers($filename, $options = []) {

        // options
		$options = array_merge([
			"download" => true,
		], $options);

    	// clear output buffer
		if (ob_get_level()) ob_end_clean();

		// add stream headers
		header("Pragma: public");
		header('Cache-Control: public');
        header("Cache-Control: max-age=".((60*60*24*365)));

        $timestamp = strtotime("now + 1 week");
        $gmt_mtime = gmdate('r', $timestamp);

        header('ETag: "'.md5($timestamp.$filename).'"');
        header('Expires: '.  gmdate('r', strtotime("now") + (60*60*24*365)));

		header("Content-Description: File Transfer");
		header("Content-Transfer-Encoding: binary");
		header("HTTP/1.1 200 OK");

		 // content-type
		$content_type = self::get_mime_type(pathinfo($filename, PATHINFO_EXTENSION));
		header("Content-Type: {$content_type}");

		if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) || isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $gmt_mtime) {
                header('HTTP/1.1 304 Not Modified');
                exit();
            }
            if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == md5($timestamp.$filename)) {
                header('HTTP/1.1 304 Not Modified');
                exit();
            }
        }

        if ($options["download"]) {
			header('Content-Disposition: attachment; filename="'.$filename.'"');
		}

		if ($options["download"]) {
			header('Content-Disposition: attachment; filename="'.$filename.'"');
		}

	}
    //--------------------------------------------------------------------------------
	public static function get_mime_type($extension) {
		static $type_arr = [
			"css" => "text/css",
			"csv" => "text/csv",
			"gif" => "image/gif",
			//"gz" => "application/x-gzip",
			"gz" => "text/html",
			"html" => "text/html",
			"ico" => "image/x-icon",
			"jpg" => "image/jpeg",
			"jpeg" => "image/jpeg",
			"js" => "text/javascript",
			"mp3" => "audio/mpeg",
			"ogg" => "audio/ogg",
			"png" => "image/png",
			"xls" => "application/vnd.ms-excel",
			"xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
			"wav" => "audio/wav",
			"zip" => "application/zip",
			"pdf" => "application/pdf",
		];

		if (isset($type_arr[$extension])) return $type_arr[$extension];
		else return "application/octet-stream";
	}
	//--------------------------------------------------------------------------------
	public static function build_url($data = [], $options = []) {
		$options = array_merge([
		    "secure" => false
		], $options);

		return prep_url(site_url($data), \core::$app->forceGlobalSecureRequests);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $nr
	 * @return string
	 */
	public static function go_error($nr): string {

		$solid_helper = \mod\solid_classes\helper::make()->get("error", "error_code_{$nr}");

		return self::redirect(\mod\http::build_action_url("index/verror", ["code" => strtolower($solid_helper->get_code())]));
	}
	//--------------------------------------------------------------------------------
	/**
	 * @return string
	 */
	public static function go_home() {

		if(http::is_ajax()){
			return \mod\http::ajax_response(["redirect" => \mod\http::build_action_url("website/index/home")]);
		}else{
			\mod\http::redirect(\mod\http::build_action_url("website/index/home"));
		}
	}
	//--------------------------------------------------------------------------------
	public static function is_ajax(): bool {
		return request::make()->is_ajax();
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $url
	 * @return string
	 */
	public static function redirect($url): string {
		header("Location:".$url);
		return "stream";
	}
	//--------------------------------------------------------------------------------
	public static function build_action_url($control, $data = []) {

		$parts = [];
		$parts["route"] = "index/route";
		if(is_array($control)) $parts["control"] = implode("/", $control);
		else $parts["control"] = $control;

		$data = \mod\arr::splat($data);

		if($data){
			$parts["p"] = "p";

			$key = key($data);
			$value = reset($data);
			if(sizeof($data) == 1 && $key === 0){
				$parts[] = "id";
				$parts[] = $value;
			}else{
				array_walk($data, function($value, $key)use(&$parts){
					$parts[] = $key;
					$parts[] = $value;
				});
			}
		}

		return \mod\http::build_url($parts);

	}
	//--------------------------------------------------------------------------------
	public static function get_control($current_url = false, $options = []) {

		$options = array_merge([
		    "separator" => "/"
		], $options);

		if(!$current_url) $current_url = current_url();
		if(strpos($current_url, "index/route") === false) return null;

		$parts = explode("/", $current_url);

		$key = array_search("route", $parts)+1;
		$p = array_search("p", $parts);
		if(!$p) $p = sizeof($parts);

		$control_parts = [];

		for ($i = $key; $i < $p; $i++) {
			$control_parts[] = $parts[$i];
		}

		if(!$options["separator"]) return $control_parts;

		return implode($options["separator"], $control_parts);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param false $current_url
	 * @param array $options
	 * @return array
	 */
	public static function get_parameters($current_url = false, $options = []) {

		$options = array_merge([
		], $options);

		$params = [];

		if(!$current_url) $current_url = current_url();
		if(strpos($current_url, "/p/") === false) return $params;

		$parts = explode("/", $current_url);
		$key = array_search("p", $parts);
		$data_arr = array_filter(array_slice($parts, $key+1));

		foreach ($data_arr as $key => $value) {
			if ($key % 2 === 0) {
				$params[$value] = $data_arr[$key + 1];
			}
		}

		return $params;
	}
	//--------------------------------------------------------------------------------
    public static function get_stream_url($mixed, $options = []){

        $options = array_merge([
            "id" => false,
            "absolute" => false,
        ], $options);

        if(!$options["id"]){
            $options["id"] = \mod\str::encrypt_url_r($mixed);
        }

        return site_url(["stream", "xstream", $options["id"]]);
    }
	//--------------------------------------------------------------------------------
	public static function get_img_stream($name, $options = []) {
		$options = array_merge([
		], $options);

		return \mod\http::build_url(["stream", "xasset", "img", strtolower($name)]);
	}//--------------------------------------------------------------------------------
	public static function json($var) {
		// set correct mime type
		header("Content-Type: application/json");

		// encode and print variable
    	echo json_encode($var);
    	return "stream";
	}
	//--------------------------------------------------------------------------------
    /**
     * @param array $options = [
     *      'redirect' => 'an url to redirect to'
     *      'message' => 'a message to show in an alert popup'
     *      'refresh' => 'boolean - refresh the current page'
     *      'popup' => 'an url to create a popup with'
     *      'js' => 'custom js to trigger'
     * ]
     * @return string
     */
    public static function ajax_response($options = []) {

        $options = array_merge([
        	"code" => isset($options["errors"]) && $options["errors"] ? 1 : 0,
            "errors" => [],
            "redirect" => false,
            "alert" => false,
            "message" => false,
            "title" => false,
            "ok_callback" => false,
            "refresh" => false,
            "popup" => false,
            "notice" => false,
            "notice_color" => "info",
            "js" => false,
        ], $options);


		return \mod\http::json($options);
    }
    //--------------------------------------------------------------------------------
	public static function get_content_security_policy($policy_arr) {
		// init
		$header = "";

		// build securoty policy header
		foreach ($policy_arr as $policy_index => $policy_item) {
			$header .= "{$policy_index} 'self' ";
			foreach ($policy_item as $policy_item_item) {
				$header .= " {$policy_item_item}";
			}
			$header .= ";";
		}

		// done
		return "Content-Security-Policy: {$header}";
	}
	//--------------------------------------------------------------------------------
}