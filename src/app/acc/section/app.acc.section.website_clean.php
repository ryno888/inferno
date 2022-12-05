<?php

namespace app\acc\section;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class website_clean extends \mod\intf\section {

	//--------------------------------------------------------------------------------
	public function get_set() {
		return "website";
	}
	//--------------------------------------------------------------------------------
	public function get_layout() {
		return \app\acc\layout\website_clean::make();
	}
	//--------------------------------------------------------------------------------
	/**
	 * @return \mod\intf\standard|\mod\ui\set\website|string|void
	 */
	public function get_ui() {
		return \mod\ui\set\website::make();
	}
	//--------------------------------------------------------------------------------
}