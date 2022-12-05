<?php

namespace app\acc\section;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class system extends \mod\intf\section {

	//--------------------------------------------------------------------------------
	public function get_set() {
		return "system";
	}
	//--------------------------------------------------------------------------------
	public function get_layout() {
		return \app\acc\layout\system::make();
	}
	//--------------------------------------------------------------------------------
	public function get_ui() {
		return \mod\ui\set\system::make();
	}
	//--------------------------------------------------------------------------------
}