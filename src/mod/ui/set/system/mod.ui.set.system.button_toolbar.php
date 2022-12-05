<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class button_toolbar extends \mod\ui\intf\component {

	protected $button_arr = [];

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Button Toolbar";
	}
	//--------------------------------------------------------------------------------
	public function add_button($label, $onclick = false, $options = []) {

		$options["label"] = $label;
		$options["onclick"] = $onclick;

		$this->button_arr[] = $options;
	}
	//--------------------------------------------------------------------------------
	public function add_link($label, $href = "#", $options = []) {

		$options["label"] = $label;
		$options["onclick"] = false;
		$options["@href"] = $href;
		$options["@type"] = "link";

		$this->button_arr[] = $options;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		], $options);


		$buffer = \mod\ui::make()->buffer();

		$buffer->div_([".btn-toolbar" => true]);
			$buffer->div_([".btn-group" => true, "@role" => "group"]);
				foreach ($this->button_arr as $btn_opt){
					$buffer->xbutton($btn_opt["label"], $btn_opt["onclick"], $btn_opt);
				}
			$buffer->_div();
		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}