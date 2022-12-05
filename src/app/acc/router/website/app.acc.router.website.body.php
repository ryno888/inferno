<?php

namespace app\acc\router\website;

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

	    $panel = \mod\ui::make()->panel(current_url());
	    $panel->set_id("mod");
	    $panel->set_html($options["content"]);
	    $buffer->add($panel->build());

	}
	//--------------------------------------------------------------------------------
}