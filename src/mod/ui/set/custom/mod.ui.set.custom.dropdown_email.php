<?php

namespace mod\ui\set\custom;

/**
 * @package app\ui\set\custom
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class dropdown_email extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected $item_arr = [];
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		    "title" => false,
		    "email" => false,
		    "icon" => false,
		], $options);

		$email = $options["email"];
		$title = $options["title"];
		if(!$title) $title = $email;

		if(!$email) return "n/a";

    	$dropdown_email = \mod\ui::make()->dropdown();
		$dropdown_email->set_label($title);
		$dropdown_email->add_link("javascript:util.copy_text_to_clipboard('$email')", "Copy Email", ["icon" => "fa-clipboard"]);
		$dropdown_email->add_link("javascript:window.location.href = 'mailto:$email';", "Send Email", ["icon" => "fa-envelope"]);
		return $dropdown_email->build($options);

	}
	//--------------------------------------------------------------------------------
}