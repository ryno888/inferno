<?php

namespace action\index;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class verror extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {

		$error = \mod\solid_classes\helper::make()->get_from_constant($this->id);
		$buffer->div_([".container" => true]);
		    $buffer->div_([".row" => true]);
		        $buffer->div_([".col-12 min-h-65vh d-flex justify-content-center" => true]);
		        	$buffer->div_([".align-self-center text-center" => true]);
						$buffer->xheader(2, $error->get_display_name());
						$buffer->div(["*" => $error->get_description()]);

						$buffer->div_([".my-3" => true]);
							$buffer->xbutton("Go home");
						$buffer->_div();
		        	$buffer->_div();
		        $buffer->_div();
		    $buffer->_div();
		$buffer->_div();


		return "website_top_nav";
	}
    //--------------------------------------------------------------------------------

}
