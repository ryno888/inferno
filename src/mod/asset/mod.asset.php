<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class asset {
	//--------------------------------------------------------------------------------
	public static function mkdir($dir, $options = []) {
		if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return str_replace("//", "/", $dir);
	}
	//--------------------------------------------------------------------------------
}