<?php

namespace app\acc\router\system;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class scripts extends \mod\intf\router {

	//--------------------------------------------------------------------------------
	/**
	 * @param $buffer \mod\ui\set\system\buffer
	 * @param array $options
	 */
	public function run(&$buffer, $options = []) {

		$buffer->add(\mod\compiler\assets::make()->run()->get_stream_js());
		$buffer->xdebug();

	}
	//--------------------------------------------------------------------------------
}