<?php

namespace app\acc\router\clean;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class head extends \mod\intf\router {

	//--------------------------------------------------------------------------------
	/**
	 * @param $buffer \mod\ui\set\system\buffer
	 * @param array $options
	 */
	public function run(&$buffer, $options = []) {

		$buffer->head_();
			$buffer->meta(["@charset" => "utf-8"]);
			$buffer->meta(["@name" => "viewport", "@content" => "width=device-width, initial-scale=1.0, shrink-to-fit=no"]);

			$buffer->title(["*" => "System - Clean"]);

		$buffer->_head();

	}
	//--------------------------------------------------------------------------------
}