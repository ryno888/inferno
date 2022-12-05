<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class header extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Header";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"size" => 1,
			"title" => "#",
			"sub_title" => "#",
		], $options);

		$buffer = \mod\ui::make()->buffer();
		$buffer->{"h{$options["size"]}_"}($options);
			$buffer->add($options["title"]);
			if($options["sub_title"]) $buffer->small(["*" => $options["sub_title"]]);
		$buffer->{"_h{$options["size"]}"}();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}