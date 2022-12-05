<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class icheckbox extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Input Checkbox";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"id" => false,
			"label" => false,
			"checked" => false,

			"help" => false,
			"required" => false,

			"valid_feedback" => "",
			"invalid_feedback" => "This field is required",
		], $options);

		$id = $options["id"];
		$label = $options["label"];
		$checked = (bool) $options["checked"];

		if($options["required"]) $options["@required"] = true;

		$buffer = \mod\ui::make()->buffer();

		$buffer->div_([".form-group" => true]);
			$buffer->div_([".custom-control custom-checkbox" => true]);

				$options[".custom-control-input"] = true;
				$buffer->xinput("checkbox", $id, $checked, $options);
				$buffer->label([".custom-control-label" => true, "*" => $label, "@for" => $id]);

				$buffer->div([".valid-feedback" => true, "*" => $options["valid_feedback"]]);
				$buffer->div([".invalid-feedback" => true, "*" => $options["invalid_feedback"]]);
			$buffer->_div();
			if($options["help"]) $buffer->small(["*" => $options["help"], "@id" => "{$id}Help", ".form-text text-muted" => true]);
		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}