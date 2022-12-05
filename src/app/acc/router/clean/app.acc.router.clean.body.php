<?php

namespace app\acc\router\clean;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class body extends \mod\intf\router {

	//--------------------------------------------------------------------------------
	/**
	 * @param $buffer \mod\ui\set\system\buffer
	 * @param array $options
	 */
	public function run(&$buffer, $options = []) {

		$buffer->add($options["content"]);

	}
	//--------------------------------------------------------------------------------
}