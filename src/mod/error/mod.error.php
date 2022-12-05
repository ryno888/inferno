<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class error {
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	public static function create($message, $options = []) {

		$options = array_merge([
		    "level" => "error",
		    "fatal" => false,
		], $options);

		if($options["fatal"]) $options["level"] = "critical";

		log_message($options["level"], $message);

		if($options["fatal"]) die($message);

	}
	//--------------------------------------------------------------------------------
}