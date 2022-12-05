<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class progress extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Progress";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"color" => "primary",
			"value" => 50,
			"value_min" => 0,
			"value_max" => 100,
			"enable_label" => true,

			"/progress" => [],
			"/progress_wrapper" => [".progress-sm mr-2" => true],
			"/label" => [".h5 mb-0 mr-3 font-weight-bold text-gray-800" => true],
		], $options);

		$buffer = \mod\ui::make()->buffer();

		$buffer->div_([".row no-gutters align-items-center" => true]);

			if($options["enable_label"]){
				$buffer->div_([".col-auto" => true]);

					//label
					$options["/label"]["*"] = "{$options["value"]}%";
					$buffer->div($options["/label"]);

				$buffer->_div();
			}
			$buffer->div_([".col" => true]);

				$options["/progress_wrapper"][".progress"] = true;
				$buffer->div_($options["/progress_wrapper"]);

					$options["/progress"][".progress-bar"] = true;
					$options["/progress"][".bg-{$options["color"]}"] = true;
					$options["/progress"]["#width"] = "{$options["value"]}%";
					$options["/progress"]["@role"] = "progressbar";
					$options["/progress"]["@aria-valuenow"] = $options["value"];
					$options["/progress"]["@aria-valuemin"] = $options["value_min"];
					$options["/progress"]["@aria-valuemax"] = $options["value_max"];
					$buffer->div($options["/progress"]);

				$buffer->_div();

			$buffer->_div();
		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}