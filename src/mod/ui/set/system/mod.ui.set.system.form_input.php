<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class form_input extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Form Input";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"fn" => false,
		], $options);

		$buffer = \mod\ui::make()->buffer();
		$buffer->div_([".form-row" => true]);
			$buffer->div_([".col mb-3" => true]);
				call_user_func_array($options["fn"], [$buffer, $options]);
			$buffer->_div();
		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}