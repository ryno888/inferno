<?php

namespace action\system\person;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class vedit extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {


        $person = \core::$request->getdb("person", true);

        $html = \mod\ui::make()->html();
        $html->form("");

        $html->div_([".container-fluid" => true]);
            $html->div_([".row" => true]);
                $html->div_([".col-12 col-lg-4" => true]);
                    $html->xcard("general Details", false, [
                        "html" => function() use($person){
                            $buffer = \mod\ui::make()->buffer();
                            $buffer->xitext("per_firstname", $person->per_firstname, "Firstname", ["required" => true]);
                            $buffer->xitext("per_lastname", $person->per_lastname, "Surname", ["required" => true]);
                            $buffer->xitext("per_email", $person->per_email, "Email", ["required" => true]);
                            return $buffer->build();
                        }
                    ]);
                $html->_div();
                $html->div_([".col-12 col-lg-4" => true]);
                    $html->itext("Firstname", "per_firstname", $person->per_firstname, ["required" => true]);
                    $html->itext("Surname", "per_lastname", $person->per_lastname, ["required" => true]);
                    $html->itext("Email", "per_email", $person->per_email, ["required" => true]);
                $html->_div();
                $html->div_([".col-12 col-lg-4" => true]);
                    $html->itext("Firstname", "per_firstname", $person->per_firstname, ["required" => true]);
                    $html->itext("Surname", "per_lastname", $person->per_lastname, ["required" => true]);
                    $html->itext("Email", "per_email", $person->per_email, ["required" => true]);
                $html->_div();
            $html->_div();
        $html->_div();


        $buffer->add($html->build());

		return "system";
	}
    //--------------------------------------------------------------------------------

}
