<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class arr {
	//--------------------------------------------------------------------------------
	public static function extract_signature_items($signature, $options = []) {
		// options
		$options = array_merge([
		], $options);

		// find and save the items with the matching signature
		$item_arr = [];
		$signature_size = strlen($signature);
		foreach ($options as $option_index => $option_item) {
			// signature
			$item_signature = substr($option_index, 0, $signature_size);
			$item_index = substr($option_index, 1);

			// we only care for the specified signature
			if ($item_signature != $signature) continue;

			// build item without signature
			$item_arr[$item_index] = $option_item;
		}

		// done
		return $item_arr;
	}
	//--------------------------------------------------------------------------------
	public static function splat($var, $options = []) {
		// options
		$options = array_merge([
			"delimiter" => false,
		], $options);

		// check if we have an array
		if (is_array($var)) return $var;

		// check if value is false
		if ($var === false) return [];

		// delimiter
		if ($options["delimiter"] !== false) {
			return explode($options["delimiter"], $var);
		}

		// done
		return [$var];
	}
	//--------------------------------------------------------------------------------
    /**
     * splits an array into to arrays
     * @param array $arr
     * @return array
     */
    public static function split($arr = []) {

        //return empty
        if(!$arr) return [[], []];

        //return chunk list
        return array_chunk($arr, ceil(sizeof($arr) / 2));
    }
    //--------------------------------------------------------------------------------
	public static function range($start, $end) {
		return array_combine(range($start,$end), range($start,$end));
	}
    //--------------------------------------------------------------------------------
	public static function get_first_index(&$arr) {
		// params
    	$arr = self::splat($arr);

		// return the first index
        foreach ($arr as $arr_index => $arr_item) {
			return $arr_index;
		}

		// done
        return false;
	}
	//--------------------------------------------------------------------------------
    public static function get_last_index($arr) {
		// params
    	$arr = self::splat($arr);

		return key(array_slice($arr, -1, 1, true));
    }
	//--------------------------------------------------------------------------------
	public static function unset_first_index(&$arr) {
		$index = \mod\arr::get_first_index($arr);
		unset($arr[$index]);
	}
	//--------------------------------------------------------------------------------
}