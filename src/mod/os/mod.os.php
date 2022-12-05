<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class os {
	//--------------------------------------------------------------------------------
	public static function mkdir($dir, $options = []) {
		if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return str_replace("//", "/", $dir);
	}
	//--------------------------------------------------------------------------------

	/**
	 * Provides protection against directory traversal.
	 * @param $filename
	 * @param array $options
	 * @return string
	 */
	public static function sanitize_filename($filename, $options = []) {
        return sanitize_filename($filename);
	}
	//--------------------------------------------------------------------------------
	public static function is_newer_than($filepath, $filepath_arr) {
		// check if file exists
		if (!file_exists($filepath)) return false;

		// check if newer than provided file arrary
		$filemtime = filemtime($filepath);
		foreach ($filepath_arr as $filepath_item) {
			if (filemtime($filepath_item) > $filemtime) return false;
		}

		// done
		return true;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $filename
	 * @return string
	 */
	public static function php_filename_to_classname($filename): string {
		
		try{
		    $basename = basename($filename);

		    $basename_parts = explode(".", $basename);
		    array_pop($basename_parts);

		    return "\\".implode("\\", $basename_parts);

		}catch(\Exception $ex){
			error::create($ex->getMessage(), ["fatal" => true]);
		}
		
	}
	//--------------------------------------------------------------------------------
}