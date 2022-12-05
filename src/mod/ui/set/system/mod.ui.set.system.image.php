<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class image extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Image";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"@src" => false,
		], $options);


		$buffer = \mod\ui::make()->buffer();
		$buffer->img($options);
		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}