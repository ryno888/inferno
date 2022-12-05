<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class itext extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Input Text";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"label" => false,
			"value" => false,

			"type" => "text",
			"help" => false,
			"prepend" => false,
			"append" => false,
			"required" => false,

			".form-control" => true,

			"valid_feedback" => "",
			"invalid_feedback" => "This field is required",
		], $options);

		$id = $options["id"];
		$label = $options["label"];
		$value = $options["value"];

		if($options["required"]) $options["@required"] = true;

		$buffer = \mod\ui::make()->buffer();

		if(!$options["prepend"] && !$options["append"] && !$label && !$options["help"]){
		    $buffer->xinput($options["type"], $id, $value, $options);
		    return $buffer->build();
        }


		$buffer->div_([".form-group" => true]);

			if($label) $buffer->label(["@for" => $id, "*" => $label]);
			$buffer->div_([".input-group mb-2" => $options["prepend"] || $options["append"]]);

				if($options["prepend"]){
					$buffer->div_([".input-group-prepend" => true]);
						$buffer->span([".input-group-text" => true, "*" => $options["prepend"], "@id" => "prepend{$id}"]);
					$buffer->_div();
				}

				$buffer->xinput($options["type"], $id, $value, $options);

				if($options["append"]){
					$buffer->div_([".input-group-append" => true]);
						$buffer->span([".input-group-text" => true, "*" => $options["append"], "@id" => "append{$id}"]);
					$buffer->_div();
				}

				$buffer->div([".valid-feedback" => true, "*" => $options["valid_feedback"]]);
				$buffer->div([".invalid-feedback" => true, "*" => $options["invalid_feedback"]]);

			$buffer->_div();
			if($options["help"]) $buffer->small(["*" => $options["help"], "@id" => "{$id}Help", ".form-text text-muted" => true]);


		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}