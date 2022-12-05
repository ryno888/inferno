<?php


class core {

	/**
	 * @var \Config\App
	 */
	public static $app;

	/**
	 * @var CodeIgniter\Session\Session
	 */
	public static $session;

	public static $panel;

    /**
     * @var \mod\request
     */
	public static $request;
	public static $content_security_policy_arr = [
        "frame-ancestors" => ["none"],
        "frame-src" => [
           "https://*.google.com/",
           "https://*.youtube.com/",
           "https://www.youtube-nocookie.com/",
           "https://www.googletagmanager.com/"
        ],
        "default-src" => [
            "'self'",
            "https://*.google.com/recaptcha/",
            "https://*.googleapis.com/",
            "https://*.gstatic.com",
            "https://maxcdn.bootstrapcdn.com/",
            "https://*.google.com/",
            "https://*.youtube.com/",
            "https://*.google.com/recaptcha/",
            "https://embed-fastly.wistia.com/",
            "https://distillery.wistia.com/",
            "https://code.jquery.com/",
            "https://app.mobicredwidget.co.za/",
            "https://www.googletagmanager.com/",
            "https://www.google-analytics.com",
            "data:",
            "blob:",
            "self:",
        ],
        "script-src" => [
            "'unsafe-inline'",
            "'unsafe-eval'",
            "https://*.gstatic.com",
            "https://*.bootstrapcdn.com",
            "https://*.googleapis.com/",
            "https://*.jquery.com",
            "https://www.google.com/js/th/",
            "https://maxcdn.bootstrapcdn.com/",
            "https://code.jquery.com/",
            "https://*.google.com/recaptcha/",
            "https://fast.wistia.com/",
            "https://code.jquery.com/",
            "https://cdn.rawgit.com/",
            "https://cdn.jsdelivr.net/",
            "https://www.youtube.com/",
            "https://app.mobicredwidget.co.za/",
            "https://www.googletagmanager.com/",
            "https://www.google-analytics.com",
            "https://cdnjs.cloudflare.com",
            "https://cdn.jsdelivr.net",
            "blob:",
            "self:",
        ],
        "style-src" => [
            "'unsafe-inline'",
            "https://*.googleapis.com/",
            "https://*.jquery.com",
            "https://maxcdn.bootstrapcdn.com/",
            "https://fonts.googleapis.com/",
            "https://cdn.jsdelivr.net",
        ],
        "img-src" => [
            "*.zopim.com/",
            "https://cdn.bootstrapstudio.io/",
            "https://*.googleapis.com/",
            "https://*.jquery.com",
            "https://*.gstatic.com",
            "https://fast.wistia.com",
            "https://embed-fastly.wistia.com/",
            "https://app.mobicredwidget.co.za/",
            "data:",
            "blob:",
            "self:",
        ],
    ];
	//--------------------------------------------------------------------------------
	public static function init() {

		self::$app = config('App');

		// shutdown handler
		register_shutdown_function(["core", "close"]);

		// ember autoloader
		spl_autoload_register(["core", "load"]);

		self::$session = session();

		//load constants
		if(file_exists(DIR_MOD."/solid_classes/mod.solid_classes.constants.php")){
			include_once DIR_MOD."/solid_classes/mod.solid_classes.constants.php";
		}

		//autoload helpers
		helper(['text', 'form', 'number', 'security', 'filesystem']);

		//methods
		function console($mixed){ \mod\debug::console($mixed); }
		function display($mixed, $show_detail = false){ \mod\debug::view($mixed, ["show_detail" => $show_detail]); }
		function dbvalue($value, $options = []) { return \mod\db::dbvalue($value, $options); }

        function isnull($value) {
		    if(is_null($value) || $value === "null") return true;
            return false;
        }


		\app\app::make()->install();

		self::$request = \mod\request::make();
		self::$panel = self::$request->get_get("p", TYPE_STRING, ["default" => "mod"]);

		header(\mod\http::get_content_security_policy(self::$content_security_policy_arr));

	}
	//--------------------------------------------------------------------------------
	/**
	 * @return false|string
	 */
	public static function get_environment() {
		return isset($_SERVER['CI_ENVIRONMENT']) ? $_SERVER['CI_ENVIRONMENT'] : null;
	}
	//--------------------------------------------------------------------------------
	public static function load($name) {

		// path
		$path = false;

		// using namespace
		$namespace_arr = explode("\\", $name);

		if (count($namespace_arr) > 1) {
			// include file based on first namespace
			switch ($namespace_arr[0]) {
				case "core" :
				case "mod" :
				case "app" :
					$base_dir_arr = [
						"mod" => DIR_MOD,
						"app" => DIR_APP,
					];
					$part_base = $base_dir_arr[$namespace_arr[0]];
					$part_file = implode(".", $namespace_arr).".php";
					$part_namespace = implode("/", array_slice($namespace_arr, 1, -1));
					if (!$part_namespace) $part_namespace = end($namespace_arr);
					$path = "{$part_base}/{$part_namespace}/{$part_file}";
					break;

				case "db" :
					$base_dir_arr = [
						"db" => DIR_APP."/db",
					];

					$parts = [];
					$parts["part_base"] = $base_dir_arr[$namespace_arr[0]];
					$parts["part_namespace"] = implode("/", array_slice($namespace_arr, 1, -1));
					$parts["part_file"] = "db.".end($namespace_arr).".php";
					$path = implode("/", array_filter($parts));
					break;

				case "action" :

					$parts = [];
					$parts["part_base"] = DIR_APP."/action";
					$parts["part_namespace"] = implode("/", array_slice($namespace_arr, 1, -1));
					$parts["part_file"] = "a.".str_replace("/", ".", $parts["part_namespace"]).".".end($namespace_arr).".php";
					$path = implode("/", array_filter($parts));
					break;

//				case "acc" :
//					$name_arr = static::parse_acc($name);
//					$path = $name_arr["path"];
//					break;
			}

			if (!$path || !file_exists($path)) {
				return;
			}
			include_once($path);
			return;
		}


	}
	//--------------------------------------------------------------------------------
	public static function get_env($name, $options = []) {
	    $options = array_merge([
	        "datatype" => TYPE_STRING
	    ], $options);

		return \mod\data::parse(getenv($name), $options["datatype"]);
	}
	//--------------------------------------------------------------------------------
	public static function close() {

		// display more information on fatal errors
		$error = error_get_last();
		$fatal_error_arr = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR];
		if ($error && isset($error["type"]) && in_array($error["type"], $fatal_error_arr)) {
			// build message
			$message = "Fatal error: {$error["message"]} in {$error["file"]} on line {$error["line"]}";

			// trigger fatal error
			\mod\error::create($message, ["fatal" => true]);
		}
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $table
	 * @param array $options
	 * @return mixed|\mod\db\intf\table
	 */
	public static function dbt($table, $options= []) {

		$class = "\\db\\{$table}";

		return new $class($options);
	}
	//--------------------------------------------------------------------------------
}

core::init();