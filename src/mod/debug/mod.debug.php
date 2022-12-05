<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class debug {
	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	/**
	 * Displays the given variable inside a pre formatted html block perserving end lines.
	 * Has special support for the \mod\db\row class by not displaying the db and _original
	 * properties.
	 *
	 * @param mixed $var <p>The variable to display.</p>
	 *
	 * @param boolean $options[show_detail] <p>Should type information be added.</p>
	 */
	public static function view($var, $options = []) {
		// options
		$options = array_merge([
			"show_detail" => false,
			"no_formatting" => false,
		], $options);

		// show variable value
		if (!$options["no_formatting"]) echo "<pre>";
		if ($options["show_detail"]) var_dump($var);
		else print_r($var);
		if (!$options["no_formatting"])echo "</pre>";

	}
	//--------------------------------------------------------------------------------
	/**
	 * Writes the given variable to a file named console.txt in the temp folder. Will
	 * not overwrite the file, but append with each call. Has special support for the
	 * \mod\db\row class by not displaying the db and _original properties.
	 *
	 * @param mixed $var <p>The variable to display.</p>
	 *
	 * @param boolean $options[show_detail] <p>Should type information be added.</p>
	 */
	public static function console($var, $options = []) {
		// options
		$options = array_merge([
			"show_detail" => false,
			"no_formatting" => true,
		], $options);

		// buffer results to write to file later
		\mod\os::mkdir(DIR_TEMP);
		ob_start();
		self::view($var, $options);
		file_put_contents(DIR_TEMP."/console.txt", ob_get_clean().PHP_EOL, FILE_APPEND);
	}
	//--------------------------------------------------------------------------------
}