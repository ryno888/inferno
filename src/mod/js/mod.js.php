<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class js {
	//--------------------------------------------------------------------------------
  	// properties
  	//--------------------------------------------------------------------------------
  	protected static $domready_event_arr = [];
  	protected static $script = [];
  	protected static $script_after = [];
  	protected static $script_top = [];
  	protected static $actions = [];
  	protected static $script_top_force = false;
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	public static function set_script_top_force($script_top_force) {
		self::$script_top_force = $script_top_force;
	}
	//--------------------------------------------------------------------------------
	/**
	 * Builds a JSON options string using the index of options as the name and the value
	 * as the value. Includes the encapsulating { and }. Will only add the options if
	 * it's index starts with a *. All other options are ignored.
	 *
	 * These option values are handled as follows:
	 * <p>A value of null ignores the item.</p>
	 * <p>(bool)true is added as true with no single quotes.</p>
	 * <p>(bool)false is added as false with no single quotes.</p>
	 * <p>An array is added as json encoded array.</p>
	 * <p>A value starting with ! is added as is with no single quotes or escaping.</p>
	 * <p>Any other value is added escaped within single quotes.</p>
	 *
	 * @param array $options[*] <p>Options with index starting with * will be built into the string.</p>
	 *
	 * @return string <p>Javascript JSON code.</p>
	 */
	public static function create_options($options = []) {
		// init
		$JS_options = [];

		// use all fields starting with * as option
		foreach ($options as $option_index => $options_item) {
			// skip option if value is null
			if ($options_item === null) continue;

			// init signature and value
			$signature = substr($option_index, 0, 1);
			$index = substr($option_index, 1);

			// create option based on signature
			switch ($signature) {
				case "*" :
					if ($options_item === true) $value = "true";
					elseif ($options_item === false) $value = "false";
					elseif (is_array($options_item)) {
						$value = json_encode($options_item);
					}
					elseif (substr($options_item, 0, 1) == "!") $value = substr($options_item, 1);
					else $value = "'".\mod\str::escape_singlequote($options_item)."'";

					$JS_options[] = "{$index}: {$value}";
					break;
			}
		}

		// done
		$JS_options = implode(", ", $JS_options);
		return "{ {$JS_options} }";
	}
	//--------------------------------------------------------------------------------
	/**
	 * Creates an ajax link string to be used with javascript events. The link will use
	 * the core.ajax.request function to send the query. When using HTTP POST with no form
	 * will automatically send the CSRF token with the request as well.
	 *
	 * @param string $url <p>The URL to send the ajax query to.</p>
	 *
	 * @param string|bool $options[*update] <p>HTML container id to load the resulting content of the ajax query into (Remember the # in front). Giving a (bool)true will default to the current panel wrapper id.</p>
	 * @param string $options[*method] <p>The HTTP method to use, defaults to POST.</p>
	 * @param bool $options[*no_overlay] <p>Set to true for not rendering the white container overlay.</p>
	 * @param string|array|bool $options[*form] <p>The form to include in the post data of the request. Can send multiple forms by providing an array of form ids (Remember the # in front). Setting to (bool)true will use the current active form.</p>
	 * @param string|array $options[*data] <p>Extra post encoded data to send with the request. Accepts an array of index value pairs. When setting a string value, make sure it is properly formatted with http_build_query().</p>
	 * @param array $options[*get] <p>An array of HTML input ids to send with the request (Remember the # in front). The values of these inputs will be sent as key value pairs using the elements id and value. These are added to the URL when the event is triggered.</p>
	 * @param string $options[*success] <p>The javascript function to run when the ajax call successfully completes.</p>
	 * @param string|bool $options[*confirm] <p>The message to display before running the query. This will provide a confirm popup. Choosing OK on this popup will send the query, otherwise call the function [*cancel_confirm]. Giving (bool)true will generate a default message.</p>
	 * @param string $options[*cancel_confirm] <p>The javascript function to call when Cancel is chosen on the confirm popup.</p>
	 *
	 * @return string <p>Javasctipt code to execute an ajax request.</p>
	 */
	public static function ajax($url, $options = []) {
		$options = array_merge([
			"*update" => null,
			"*updateComplete" => null,
			"*method" => null,
			"*no_overlay" => null,
			"*confirm" => null,
			"*form" => null,
			"*data" => null,
			"*get" => null,
			"*beforeSend" => null,
			"*autoscroll" => null,
			"*success" => null,
			"*complete" => null,
			"*enable_reset_html" => null,
			"*cancel_confirm" => null,

			"form_validate_url" => false,
			"cid_validate" => false,
		], $options);

		// url
		$JS_url = $url;

		// method
		if ($options["*method"]) $options["*method"] = strtoupper($options["*method"]);

		// update
//		if ($options["*update"] === true) $options["*update"] = "#panel_".\core::$panel;

		// success
		if ($options["*updateComplete"] && substr($options["*updateComplete"], 0, 9) == "function(") $options["*updateComplete"] = "!{$options["*updateComplete"]}";
		if ($options["*beforeSend"] && substr($options["*beforeSend"], 0, 9) == "function(") $options["*beforeSend"] = "!{$options["*beforeSend"]}";
		if ($options["*success"] && substr($options["*success"], 0, 9) == "function(") $options["*success"] = "!{$options["*success"]}";
		if ($options["*complete"] && substr($options["*complete"], 0, 9) == "function(") $options["*complete"] = "!{$options["*complete"]}";
		if ($options["*cancel_confirm"] && substr($options["*cancel_confirm"], 0, 9) == "function(") $options["*cancel_confirm"] = "!{$options["*cancel_confirm"]}";

		// confirm
		if ($options["*confirm"] === true) $options["*confirm"] = "Are your sure you want to continue?";

		// data
		if ($options["*data"] && is_array($options["*data"])) $options["*data"] = http_build_query($options["*data"]);

		// form
//		if ($options["*form"] === true) {
//			if (\com\ui\helper::$current_form) $options["*form"] = "#".\com\ui\helper::$current_form->id_form;
//			else $options["*form"] = null;
//		}

		// csrf
//		if ($options["*method"] != "GET" && $options["*form"] === null) $options["*csrf"] = \core::$app->get_response()->get_csrf();

		// js options
		$JS_options = self::create_options($options);

		// build javascript
		$cid_validate = "";
		if($options["cid_validate"] && $options["*form"]){
			$cid_validate = "if(eval($('{$options["*form"]}').data('cid')).validate()) ";
		}

		$JS_string = "{$cid_validate}app.ajax.request('{$JS_url}', {$JS_options});";


		if($options["form_validate_url"]){
			$JS_string = "{$cid_validate}core.ajax.request_function('{$options["form_validate_url"]}', function(response){
				if(response.code == 1){ core.browser.alert(response.message); }
				else if(response.code == 0){ $JS_string }
			}, { form:'{$options["*form"]}' });";
		}

		// done
		return $JS_string;
	}
	//--------------------------------------------------------------------------------
	public static function add_domready_script($event_script) {
  		self::$domready_event_arr[] = $event_script;
  	}
  	//--------------------------------------------------------------------------------
  	public static function add_domready_event($id, $event, $script) {
		self::add_domready_script("$('$id').{$event}(function(event, ui) { $script });");
  	}
  	//--------------------------------------------------------------------------------
  	public static function add_domready_keypress($id, $key, $script) {
  		self::add_domready_event($id, "keypress", "if (event.key == $key) { $script }");
  	}
  	//--------------------------------------------------------------------------------
  	public static function get_domready() {
  		// init data
  		$domready_script = false;

  		// check if events available
  		if (!self::$domready_event_arr) return $domready_script;

  		// view script
		$domready_script = '<script type="text/javascript">jQuery(function () { '.implode(" ", self::$domready_event_arr).' });</script>';

  		// result
  		return $domready_script;
  	}
  	//--------------------------------------------------------------------------------
  	public static function add_script($event_script, $options = []) {
		// options
		$options = array_merge([
			"key" => \mod\str::generate_id(),
			"after" => false,
			"top" => false,
		], $options);

		if (self::$script_top_force) {
			$options["top"] = true;
		}

		if ($options["after"]) self::$script_after[$options["key"]] = $event_script;
		elseif ($options["top"]) self::$script_top[$options["key"]] = $event_script;
		else self::$script[] = $event_script;
  	}
  	//--------------------------------------------------------------------------------
  	public static function add_event($id, $event, $script) {
  		self::add_script("$('$id').{$event}(function(event, ui) { {$script} });");
  	}
  	//--------------------------------------------------------------------------------
	public static function add_keypress($id, $key, $script) {
  		self::add_event($id, "keypress", "if (event.which == {$key}) { {$script} }");
  	}
  	//--------------------------------------------------------------------------------
	public static function script($js) {
		return "<script type=\"text/javascript\">{$js}</script>";
	}
  	//--------------------------------------------------------------------------------
  	public static function get_script($options = []) {

		$options = array_merge([
		    "wrap" => true
		], $options);
  		// init data
  		$script = false;

  		// check if events available
  		if (!self::$script) return $script;

  		// view events
		foreach (self::$script_top as $script_item) $script .= $script_item;
		foreach (self::$script as $script_item) $script .= $script_item;
		foreach (self::$script_after as $script_after_item) $script .= $script_after_item;

		$script = \mod\js::minify_script($script);

  		if(!$options["wrap"]) return $script;

  		// result
  		return \mod\ui::make()->tag()->script(["@type" => "text/javascript", "*" => $script]);
  	}
  	//--------------------------------------------------------------------------------
    public static function parse_id($id) {
		return strtr($id, ["[" => "\\\\[", "]" => "\\\\]", "." => "\\\\."]);
	}
	//--------------------------------------------------------------------------------
	public static function escape_string($str) {
		return strtr($str, [
			"'" => "\\'",
		]);
	}
	//--------------------------------------------------------------------------------
	public static function minify_script($javascript) {

		return \JShrink\Minifier::minify($javascript);

//		return preg_replace(array("/\s+\n/", "/\n\s+/", "/ +/"), array("\n", "\n ", " "), $javascript);
	}
	//--------------------------------------------------------------------------------
}