<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class card extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Card";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"color" => "primary",
			"icon" => false,
			"title" => false,
			"sub_title" => false,
			"html" => false,

			"/card" => [".h-100 py-2" => true],
			"/card_body" => [],
			"/title" => [".text-xs font-weight-bold text-uppercase mb-1" => true],
			"/sub_title" => [".h5 mb-0 font-weight-bold text-gray-800" => true],
			"/icon" => [".fa-2x text-gray-300" => true],
		], $options);


		$buffer = \mod\ui::make()->buffer();

		$options["/card"][".card"] = true;
		$options["/card"][".border-left-{$options["color"]}"] = true;

		$buffer->div_($options["/card"]);


			$options["/card_body"][".card-body"] = true;
			$buffer->div_($options["/card_body"]);

				if($options["html"]){

				    if($options["title"]){
				        $buffer->div_([".row no-gutters align-items-center mb-3" => true]);
                            $buffer->div_([".col mr-2" => true]);
                                $options["/title"][".text-{$options["color"]}"] = true;
                                $options["/title"]["*"] = $options["title"];
                                $buffer->div($options["/title"]);
                            $buffer->_div();
                        $buffer->_div();
                    }

				    if(is_callable($options["html"]))
				        $options["html"] = $options["html"]();

                    $buffer->add($options["html"]);

				}else{
					$buffer->div_([".row no-gutters align-items-center" => true]);
						$buffer->div_([".col mr-2" => true]);

							$options["/title"][".text-{$options["color"]}"] = true;
							$options["/title"]["*"] = $options["title"];
							$buffer->div($options["/title"]);

							if($options["sub_title"]){
								$options["/sub_title"]["*"] = $options["sub_title"];
								$buffer->div($options["/sub_title"]);
							}

						$buffer->_div();

						if($options["icon"]){
							$buffer->div_([".col-auto" => true]);
								$buffer->xicon($options["icon"], $options["/icon"]);
							$buffer->_div();
						}
					$buffer->_div();
				}


			$buffer->_div();


		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}