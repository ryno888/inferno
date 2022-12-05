<?php

namespace action\website\index;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class home extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {

        $buffer->div_([".container" => true, ]);
            $buffer->div_([".row" => true, ]);
                $buffer->div_([".col" => true, ]);
                    $buffer->section_([".py-4 py-xl-5" => true, ]);
                        $buffer->div_([".container" => true, ]);
                            $buffer->div_([".text-white bg-dark border rounded border-dark p-4 p-md-5" => true, ]);
                                $buffer->xheader(2, "Welcome to Ember");

                                $buffer->p([".mb-4" => true, "*" => "Please run all required setups before you continue"]);

                                $buffer->div_(["." => true]);
                                    $buffer->xbutton(".btn-primary", "test_panel.requestUpdate('".\mod\http::build_action_url("website/index/table")."')", [".btn-primary mr-2" => true]);
                                    $buffer->xbutton(".btn-secondary", "test_panel.requestUpdate('".\mod\http::build_action_url("website/index/home_2")."')", [".btn-secondary mr-2" => true]);
                                    $buffer->xbutton(".btn-info", false, [".btn-info mr-2" => true]);
                                    $buffer->xbutton(".btn-warning", false, [".btn-warning mr-2" => true]);
                                    $buffer->xbutton(".btn-danger", false, [".btn-danger mr-2" => true]);
                                    $buffer->xbutton(".btn-success", false, [".btn-success mr-2" => true]);
                                $buffer->_div();

                            $buffer->_div();
                        $buffer->_div();
                    $buffer->_section();
                $buffer->_div();
            $buffer->_div();
        $buffer->_div();

        $panel = \mod\ui::make()->panel(\mod\http::build_action_url("website/index/home_2"), ["id" => "test_panel"]);
        $buffer->div_([".test" => true]);
            $buffer->add($panel->build());
        $buffer->_div();



		return "website";
	}
    //--------------------------------------------------------------------------------

}
