<?php

namespace app\acc\router\system;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class navbar extends \mod\intf\router {

	//--------------------------------------------------------------------------------
	/**
	 * @param $buffer \mod\ui\set\system\buffer
	 * @param array $options
	 */
	public function run(&$buffer, $options = []) {

		$navbar = \mod\ui::make()->navbar();

		$navbar->add_item("Services");
		$navbar->add_item("Services|Wheel Balancing", "#");
		$navbar->add_item("Services|Tyre Rotation", "#");
		$navbar->add_item("Services|Punctures & Repairs", "#");
		$navbar->add_item("Services|Lowering Kits", "#");
		$navbar->add_item("Services|Shocks", "#");
		$navbar->add_item("Services|Mag rims", "#");

		$navbar->add_item("Products", "#");
		$navbar->add_item("Specials", "#");
		$navbar->add_item("Suppliers", "#");
		$navbar->add_item("About", "#");
		$navbar->add_item("Staff", "#");
		$navbar->add_item("Contact", "#");

		$buffer->add($navbar->build());

	}
	//--------------------------------------------------------------------------------
}