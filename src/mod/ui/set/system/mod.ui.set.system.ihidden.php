<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class ihidden extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Hidden input";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// public static function ihidden($id, $value, $options = []) {

		// shared
		// options
		$options = array_merge([
			"id" => false,
			"value" => false,
		], $options);

		// init
		$id = $options["id"];
		$value = $options["value"];

		// done
		return \mod\ui::make()->input("hidden", $id, $value, $options);
	}
	//--------------------------------------------------------------------------------
}