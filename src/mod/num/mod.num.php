<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class num {

	public static $CURRENCY = "ZAR";
	public static $CURRENCY_SYMBOL = "R";

	//--------------------------------------------------------------------------------
	/**
	 * Formats numbers as bytes, based on size, and adds the appropriate suffix
	 * @param $num
	 * @param int $precision
	 */
	public static function number_to_size($num, $precision = 1) {
		return number_to_size($num, $precision);
	}
	//--------------------------------------------------------------------------------
	/**
	 * Converts a number in common currency formats, like USD, EUR, GBP
	 * @param $num
	 */
	public static function currency($num, $options= []) {

		$options = array_merge([
		    "currency" => \mod\num::$CURRENCY,
		    "locale" => \Config\Services::request()->getLocale(),
		    "precision" => 2,
		], $options);

		return number_to_currency($num, $options["currency"], $options["locale"], $options["precision"], self::$CURRENCY_SYMBOL);
	}
	//--------------------------------------------------------------------------------
	/**
	 * Converts a number into roman:
	 * @param $num
	 */
	public static function number_to_roman($num, $options= []) {
		return number_to_roman($num);
	}
	//--------------------------------------------------------------------------------
}