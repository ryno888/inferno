<?php

namespace app\acc\router\website;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class navbar extends \mod\intf\router {

	//--------------------------------------------------------------------------------
	/**
	 * @param $buffer \mod\ui\set\system\buffer
	 * @param array $options
	 */
	public function run(&$buffer, $options = []) {

		$options = array_merge([
		], $options, $this->options);

			$buffer->nav_([".navbar navbar-light navbar-expand-md" => true, ]);
                $buffer->div_([".container-fluid" => true, ]);
                    $buffer->a_([".navbar-brand" => true, "@href" => "#", ]);
                    $buffer->add("Brand");
                    $buffer->_a();
                    $buffer->button_([".navbar-toggler" => true, "@data-toggle" => "collapse", "@data-target" => "#navcol-1", ]);
                        $buffer->span_([".sr-only" => true, ]);
                        $buffer->add("Toggle navigation");
                        $buffer->_span();
                    $buffer->span([".navbar-toggler-icon" => true, ]);
                    $buffer->_button();
                    $buffer->div_(["@id" => "navcol-1", ".collapse navbar-collapse" => true, ]);
                        $buffer->ul_([".navbar-nav" => true, ]);
                            $buffer->li_([".nav-item" => true, ]);
                                $buffer->a_([".nav-link active" => true, "@href" => "#", ]);
                                $buffer->add("First Item");
                                $buffer->_a();
                            $buffer->_li();
                            $buffer->li_([".nav-item" => true, ]);
                                $buffer->a_([".nav-link" => true, "@href" => "#", ]);
                                $buffer->add("Second Item");
                                $buffer->_a();
                            $buffer->_li();
                            $buffer->li_([".nav-item" => true, ]);
                                $buffer->a_([".nav-link" => true, "@href" => "#", ]);
                                $buffer->add("Third Item");
                                $buffer->_a();
                            $buffer->_li();
                        $buffer->_ul();
                    $buffer->_div();
                $buffer->_div();
            $buffer->_nav();



	}
	//--------------------------------------------------------------------------------
}