<?php

namespace action\website\index;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class home_2 extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {

        $buffer->div_([".container" => true, ]);
            $buffer->div_([".row" => true, ]);
                $buffer->div_([".col" => true, ]);
                    $buffer->section_([".py-4 py-xl-5" => true, ]);
                        $buffer->div_([".text-white bg-dark border rounded border-dark p-4 p-md-5" => true, ]);
                            $buffer->xheader(2, "Welcome to Ember 2");

                            $buffer->p([".mb-4" => true, "*" => "Please run all required setups before you continue"]);

                            $buffer->div_(["." => true]);
                                $buffer->xbutton(".btn-primary", false, [".btn-primary mr-2" => true]);
                                $buffer->xbutton(".btn-secondary", false, [".btn-secondary mr-2" => true]);
                                $buffer->xbutton(".btn-info", false, [".btn-info mr-2" => true]);
                                $buffer->xbutton(".btn-warning", false, [".btn-warning mr-2" => true]);
                                $buffer->xbutton(".btn-danger", false, [".btn-danger mr-2" => true]);
                                $buffer->xbutton(".btn-success", false, [".btn-success mr-2" => true]);
                            $buffer->_div();
                        $buffer->_div();
                    $buffer->_section();
                $buffer->_div();
            $buffer->_div();

            $buffer->div_([".row" => true]);
                $buffer->div_([".col-12" => true]);
                    $html = \mod\ui::make()->html();
                    $html->form(\mod\http::build_action_url(["website", "index", "functions", "xtest"]), false, ["id" => "test_form"]);
                    $html->itext("Test", "test", false, ["required" => true]);
                    $html->submit_button();
                    $buffer->add($html->build());
                $buffer->_div();
            $buffer->_div();

            $buffer->div_([".row" => true]);
                $buffer->div_([".col-12" => true]);
                    $panel = \mod\ui::make()->panel(\mod\http::build_action_url("website/index/table"), ["id" => "table_panel"]);
                    $buffer->div_([".table" => true]);
                        $buffer->add($panel->build());
                    $buffer->_div();
                $buffer->_div();
            $buffer->_div();

            $buffer->div_([".row" => true]);
                $buffer->div_([".col-12" => true]);
                    $buffer->section_([".photo-gallery py-4 py-xl-5" => true, ]);
                        $buffer->div_([".container" => true, ]);
                            $buffer->div_([".row mb-5" => true, ]);
                                $buffer->div_([".col-md-8 col-xl-6 text-center mx-auto" => true, ]);
                                    $buffer->h2_([".font-weight-bold" => true, ]);
                                    $buffer->add("Heading");
                                    $buffer->_h2();
                                    $buffer->p_([".w-lg-50" => true, ]);
                                    $buffer->add("Curae hendrerit donec commodo hendrerit egestas tempus, turpis facilisis nostra nunc. Vestibulum dui eget ultrices.");
                                    $buffer->_p();
                                $buffer->_div();
                            $buffer->_div();
                            $buffer->div_([".row photos" => true, ]);
                                $buffer->div_([".col-sm-6 col-md-4 col-lg-3 item" => true, ]);
                                    $buffer->a_(["@data-lightbox" => "photos", "@href" => "desk.jpg", ]);
                                    $buffer->img([".img-fluid mb-4" => true, "@src" => "https://cdn.bootstrapstudio.io/placeholders/1400x800.png", ]);
                                    $buffer->_a();
                                $buffer->_div();
                                $buffer->div_([".col-sm-6 col-md-4 col-lg-3 item" => true, ]);
                                    $buffer->a_(["@data-lightbox" => "photos", "@href" => "building.jpg", ]);
                                    $buffer->img([".img-fluid mb-4" => true, "@src" => "https://cdn.bootstrapstudio.io/placeholders/1400x800.png", ]);
                                    $buffer->_a();
                                $buffer->_div();
                                $buffer->div_([".col-sm-6 col-md-4 col-lg-3 item" => true, ]);
                                    $buffer->a_(["@data-lightbox" => "photos", "@href" => "loft.jpg", ]);
                                    $buffer->img([".img-fluid mb-4" => true, "@src" => "https://cdn.bootstrapstudio.io/placeholders/1400x800.png", ]);
                                    $buffer->_a();
                                $buffer->_div();
                                $buffer->div_([".col-sm-6 col-md-4 col-lg-3 item" => true, ]);
                                    $buffer->a_(["@data-lightbox" => "photos", "@href" => "building.jpg", ]);
                                    $buffer->img([".img-fluid mb-4" => true, "@src" => "https://cdn.bootstrapstudio.io/placeholders/1400x800.png", ]);
                                    $buffer->_a();
                                $buffer->_div();
                                $buffer->div_([".col-sm-6 col-md-4 col-lg-3 item" => true, ]);
                                    $buffer->a_(["@data-lightbox" => "photos", "@href" => "loft.jpg", ]);
                                    $buffer->img([".img-fluid mb-4" => true, "@src" => "https://cdn.bootstrapstudio.io/placeholders/1400x800.png", ]);
                                    $buffer->_a();
                                $buffer->_div();
                                $buffer->div_([".col-sm-6 col-md-4 col-lg-3 item" => true, ]);
                                    $buffer->a_(["@data-lightbox" => "photos", "@href" => "desk.jpg", ]);
                                    $buffer->img([".img-fluid mb-4" => true, "@src" => "https://cdn.bootstrapstudio.io/placeholders/1400x800.png", ]);
                                    $buffer->_a();
                                $buffer->_div();
                                $buffer->div_([".col-sm-6 col-md-4 col-lg-3 item" => true, ]);
                                    $buffer->a_(["@data-lightbox" => "photos", "@href" => "desk.jpg", ]);
                                    $buffer->img([".img-fluid mb-4" => true, "@src" => "https://cdn.bootstrapstudio.io/placeholders/1400x800.png", ]);
                                    $buffer->_a();
                                $buffer->_div();
                                $buffer->div_([".col-sm-6 col-md-4 col-lg-3 item" => true, ]);
                                    $buffer->a_(["@data-lightbox" => "photos", "@href" => "desk.jpg", ]);
                                    $buffer->img([".img-fluid mb-4" => true, "@src" => "https://cdn.bootstrapstudio.io/placeholders/1400x800.png", ]);
                                    $buffer->_a();
                                $buffer->_div();
                            $buffer->_div();
                        $buffer->_div();
                    $buffer->_section();
                $buffer->_div();
            $buffer->_div();

        $buffer->_div();



		return "website";
	}
    //--------------------------------------------------------------------------------

}
