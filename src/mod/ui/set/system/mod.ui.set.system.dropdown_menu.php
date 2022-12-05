<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class dropdown_menu extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected $label = false;
	protected $item_arr = [];
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Dropdown Menu";
	}
	//--------------------------------------------------------------------------------
	public function add_link($href, $label, $options = []) {
		$this->item_arr[] = array_merge( [
			"label" => $label,
			"@href" => $href,
			"icon" => false,
			"type" => "link",
		], $options);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param string $label
	 */
	public function set_label(string $label): void {
		$this->label = $label;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		    "id" => \mod\str::generate_id(["prefix" => "dropdown_menu"]),
		    "label" => $this->label,
		    "/link" => [],
		    "icon" => false,
		    "badge" => false,
		    "badge_color" => "badge-danger",
		], $options);

		$id = $options["id"];
		$buffer = \mod\ui::make()->buffer();

		$buffer->div_([".dropdown no-arrow" => true]);

			$link = $options["/link"];
			$link[".nav-link dropdown-toggle"] = true;
			$link["@id"] = $id;
			$link["@href"] = true;
			$link["@role"] = "button";
			$link["@data-toggle"] = "dropdown";
			$link["@aria-haspopup"] = "true";
			$link["@aria-expanded"] = "false";
			$link["badge"] = $options["badge"];
			$link["badge_color"] = $options["badge_color"];
			$link["icon"] = $options["icon"];

			$buffer->xlink("#", $options["label"], $link);

			$buffer->div_([".dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" => true, "@aria-labelledby" => $id]);
				$buffer->xheader(6, "Message Center", false, [".dropdown-header" => true]);


				$fn_dropdown_item = function() use(&$buffer){
					
					$buffer->a_([".dropdown-item d-flex align-items-center" => true, "@href" => "#"]); 
						$buffer->div_([".mr-3 icon-circle bg-primary" => true]);
							$buffer->xicon("fa-file-alt", [".text-white" => true]);
						$buffer->_div();
						$buffer->div_([".font-weight-bold" => true]);
							$buffer->div([".text-truncate" => true, "*" => "Hi there! I am wondering if you can help me with a problem I've been having."]);
							$buffer->div([".small text-gray-500" => true, "*" => "Emily Fowler · 58m"]);
						$buffer->_div();
					$buffer->_a();
					
//					$buffer->add("
//						<a class='dropdown-item d-flex align-items-center' href='#'>
//							<div class='mr-3'>
//								<div class='icon-circle bg-primary'>
//									<i class='fas fa-file-alt text-white'></i>
//								</div>
//							</div>
//							<div class='font-weight-bold'>
//								<div class='text-truncate'>Hi there! I am wondering if you can help me with a
//									problem I've been having.</div>
//								<div class='small text-gray-500'>Emily Fowler · 58m</div>
//							</div>
//						</a>
//					");
				};

				$fn_dropdown_item();
				$fn_dropdown_item();
				$fn_dropdown_item();
				$fn_dropdown_item();
				$fn_dropdown_item();


			$buffer->_div();

		$buffer->_div();



//		$buffer->add("
//			<div class='dropdown no-arrow mx-1'>
//
//                                <a class='nav-link dropdown-toggle' href='#' id='messagesDropdown' role='button'
//                                    data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
//                                    <i class='fas fa-envelope fa-fw'></i>
//                                    <!-- Counter - Messages -->
//                                    <span class='badge badge-danger badge-counter'>7</span>
//                                </a>
//                                <!-- Dropdown - Messages -->
//                                <div class='dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in'
//                                    aria-labelledby='messagesDropdown'>
//                                    <h6 class='dropdown-header'>
//                                        Message Center
//                                    </h6>
//                                    <a class='dropdown-item d-flex align-items-center' href='#'>
//                                        <div class='dropdown-list-image mr-3'>
//                                            <img class='rounded-circle' src='img/undraw_profile_1.svg'
//                                                alt='...'>
//                                            <div class='status-indicator bg-success'></div>
//                                        </div>
//                                        <div class='font-weight-bold'>
//                                            <div class='text-truncate'>Hi there! I am wondering if you can help me with a
//                                                problem I've been having.</div>
//                                            <div class='small text-gray-500'>Emily Fowler · 58m</div>
//                                        </div>
//                                    </a>
//                                    <a class='dropdown-item d-flex align-items-center' href='#'>
//                                        <div class='dropdown-list-image mr-3'>
//                                            <img class='rounded-circle' src='img/undraw_profile_2.svg'
//                                                alt='...'>
//                                            <div class='status-indicator'></div>
//                                        </div>
//                                        <div>
//                                            <div class='text-truncate'>I have the photos that you ordered last month, how
//                                                would you like them sent to you?</div>
//                                            <div class='small text-gray-500'>Jae Chun · 1d</div>
//                                        </div>
//                                    </a>
//                                    <a class='dropdown-item d-flex align-items-center' href='#'>
//                                        <div class='dropdown-list-image mr-3'>
//                                            <img class='rounded-circle' src='img/undraw_profile_3.svg'
//                                                alt='...'>
//                                            <div class='status-indicator bg-warning'></div>
//                                        </div>
//                                        <div>
//                                            <div class='text-truncate'>Last month's report looks great, I am very happy with
//                                                the progress so far, keep up the good work!</div>
//                                            <div class='small text-gray-500'>Morgan Alvarez · 2d</div>
//                                        </div>
//                                    </a>
//                                    <a class='dropdown-item d-flex align-items-center' href='#'>
//                                        <div class='dropdown-list-image mr-3'>
//                                            <img class='rounded-circle' src='https://source.unsplash.com/Mv9hjnEUHR4/60x60'
//                                                alt='...'>
//                                            <div class='status-indicator bg-success'></div>
//                                        </div>
//                                        <div>
//                                            <div class='text-truncate'>Am I a good boy? The reason I ask is because someone
//                                                told me that people say this to all dogs, even if they aren't good...</div>
//                                            <div class='small text-gray-500'>Chicken the Dog · 2w</div>
//                                        </div>
//                                    </a>
//                                    <a class='dropdown-item text-center small text-gray-500' href='#'>Read More Messages</a>
//                                </div>
//                            </div>
//		");


		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}