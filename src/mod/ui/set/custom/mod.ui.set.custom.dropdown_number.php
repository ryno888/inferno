<?php

namespace mod\ui\set\custom;

/**
 * @package app\ui\set\custom
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class dropdown_number extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected $item_arr = [];
	//--------------------------------------------------------------------------------
	public function add_number($number, $label, $icon = false, $options = []) {

		$options["label"] = $label;
		$options["number"] = $number;
		$options["icon"] = $icon;

		$this->item_arr[] = $options;

	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		    "enable_whatsapp" => true,
		    "enable_calling" => true,
		    "icon" => false,
		], $options);

    	$buffer = \mod\ui::make()->buffer();

		$add_number = function($number, $title, $icon = false) use (&$buffer, $options){
			if(!$number) return;
			$buffer->div_([".d-inline" => true]);
				$dropdown_user = \mod\ui::make()->dropdown([".dropdown-number" => true]);
				$dropdown_user->set_label($number);
				if($options["enable_whatsapp"]) $dropdown_user->add_link("javascript:window.open('https://wa.me/".str_replace([" ", "+"], "", $number)."', '_blank')", "Open Whatsapp", ["icon" => "fab fa-whatsapp", "@type" => "link"]);
				if($options["enable_calling"]) $dropdown_user->add_link("javascript:window.open('tel:{$number}')", "Call", ["@type" => "link", "icon" => "fa-phone-volume"]);
				$dropdown_user->add_link("javascript:app.util.copy_text_to_clipboard('{$number}')", "Copy Number", ["@type" => "link", "icon" => "fa-copy"]);
				$buffer->add($dropdown_user->build($options));
			$buffer->_div();
		};

		foreach ($this->item_arr as $item){
			$add_number($item["number"], $item["label"], $item["icon"]);
		}

		return $buffer->is_clean() ? "n/a" : $buffer->get_clean();

	}
	//--------------------------------------------------------------------------------
}