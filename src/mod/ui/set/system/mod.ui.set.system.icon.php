<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class icon extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Icon";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"icon" => false,
			".fas" => true,
		], $options);

		$buffer = \mod\ui::make()->buffer();

		$options[".{$options["icon"]}"] = true;
		$buffer->i($options);

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}