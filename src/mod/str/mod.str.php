<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class str {
	//--------------------------------------------------------------------------------
	public static function get_random_string($type, $options = []) {
		$options = array_merge([
		    "length" => 7
		], $options);

		return random_string($type, $options["length"]);
	}
	//--------------------------------------------------------------------------------
	public static function get_random_alpha($options = []) {
		return self::get_random_string("alpha", $options);
	}
	//--------------------------------------------------------------------------------
	public static function get_random_alnum($options = []) {
		return self::get_random_string("alnum", $options);
	}
	//--------------------------------------------------------------------------------
	public static function get_random_numeric($options = []) {
		$options = array_merge([
		    "no_zero" => false
		], $options);

		$type = "numeric";

		if($options["no_zero"]) $type = "nozero";

		return self::get_random_string($type);
	}
	//--------------------------------------------------------------------------------

	/**
	 * Removes special chars.
	 * @param $string
	 * @param array $options
	 * @return string|string[]|null
	 */
	public static function strip_special_chars($string, $options = []) {
		$options = array_merge([
			"replace" => []
		], $options);

		foreach ($options["replace"] AS $from => $to){
			$string = str_replace($from, $to, $string);
		}

	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	//--------------------------------------------------------------------------------

	/**
	 * Converts double slashes in a string to a single slash, except those found in URL protocol prefixes (e.g., http&#58;//).
	 * @param $string
	 * @param array $options
	 * @return string
	 */
	public static function reduce_double_slashes($string, $options = []) {
		return reduce_double_slashes($string);
	}
	//--------------------------------------------------------------------------------

	/**
	 * Removes any slashes from an array of strings.
	 * @param $string
	 * @param array $options
	 * @return array|mixed
	 */
	public static function strip_slashes($string, $options = []) {
		return strip_slashes($string);
	}
	//--------------------------------------------------------------------------------

	/**
	 * Reduces multiple instances of a particular character occurring directly after each other.
	 * If the third parameter is set to TRUE it will remove occurrences of the character at the beginning and the end of the string.
	 * @param $string
	 * @param $char
	 * @param $trim
	 * @return string
	 */
	public static function reduce_multiples($string, $char, $trim) {
		return reduce_multiples($string, $char, $trim);
	}
	//--------------------------------------------------------------------------------
	public static function generate_id($options = []) {

		$options = array_merge([
		    "prefix" => "id",
		    "suffix" => false,
		    "id" => md5(uniqid(rand(), true)),
		], $options);

		$parts = [];
		if($options["prefix"]) $parts[] = $options["prefix"];
		$parts[] = $options["id"];
		if($options["suffix"]) $parts[] = $options["suffix"];

		return implode("_", $parts);

	}
	//--------------------------------------------------------------------------------

	/**
	 * Converts single and double quotes in a string to the corresponding HTML entities.
	 * @param $string
	 * @return string
	 */
	public static function quotes_to_entities($string) {
		return quotes_to_entities($string);
	}
	//--------------------------------------------------------------------------------

	/**
	 * Removes single and double quotes from a string.
	 * @param $string
	 * @return string
	 */
	public static function strip_quotes($string) {
		return strip_quotes($string);
	}
	//--------------------------------------------------------------------------------

	/**
	 * Removes single and double quotes from a string.
	 * @param $string
	 * @return string
	 */
	public static function limit_by_word_count($string, $count) {
		return word_limiter($string, $count);
	}
	//--------------------------------------------------------------------------------

	/**
	 * Truncates a string to the number of characters specified. It maintains the integrity of words so the character count may be slightly more or less than what you specify.
	 * @param $string
	 * @return string
	 */
	public static function limit_by_string_length($string, $size) {
		return character_limiter($string, $size);
	}
	//--------------------------------------------------------------------------------

	/**
	 * This is a security function that will strip image tags from a string. It leaves the image URL as plain text.
	 * @param $string
	 * @return string|string[]|null
	 */
	public static function strip_image_tags($string) {
		return strip_image_tags($string);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $string
	 * @return string|string[]|null
	 */
	public static function escape_singlequote($string) {
		return self::replace($string, ["/'/i" => "\\'"]);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $string
	 * @param $replacement_pair_arr
	 * @return string|string[]|null
	 */
	public static function replace($string, $replacement_pair_arr) {
		// return regex replacement string
		return preg_replace(array_keys($replacement_pair_arr), array_values($replacement_pair_arr), $string);
	}
	//--------------------------------------------------------------------------------

	public static function encrypt_password($string, $options = []) {
		return password_hash($string, PASSWORD_DEFAULT);
	}
	//--------------------------------------------------------------------------------

	public static function encrypt_r($string, $options = []) {
		return base64_encode(\Config\Services::encrypter()->encrypt($string));
	}
	//--------------------------------------------------------------------------------

	public static function decrypt_r($string, $options = []) {
		return \Config\Services::encrypter()->decrypt(base64_decode($string));
	}
	//--------------------------------------------------------------------------------
	public static function encrypt_url_r($string, $options = []) {
	    $options = array_merge([
	    ], $options);


	    return base64_encode($string);
    }

	//--------------------------------------------------------------------------------
	public static function decrypt_url_r($string, $options = []) {
        $options = array_merge([
	    ], $options);


	    return base64_decode($string);

    }
	//--------------------------------------------------------------------------------
	public static function propercase($string, $options = []) {
		return ucwords(strtolower($string));
	}
	//--------------------------------------------------------------------------------
}