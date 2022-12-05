<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class navbar extends \mod\ui\intf\component {

	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public $id;
	public $item_arr = [];
	public $buffer = false;
	public $type = "standard";
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	public function __construct($options = []) {

		$options = array_merge([
		    "id" => \mod\str::generate_id(["prefix" => "navbar"]),
		    "type" => "standard",
		], $options);

		// init
		$this->id = $options["id"];
        $this->name = "Navbar";
		$this->type = $options["type"];
		$this->buffer = \mod\ui::make()->buffer();

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $label
	 * @param false $link
	 * @param array $options
	 * @param array $options[icon] = fa-times
	 * @param array $options[type] = link | dropdown | dropdown_menu
	 * @return bool
	 */
	public function add_item($label, $link = false, $options = []) {
		// options
		$options = array_merge([
			"icon" => false,
		], $options);

		// sub menu item
		$label_arr = explode("|", $label);
		$count = count($label_arr);
		$current_item = &$this->item_arr;

		for ($i = 1; $i <= $count; $i++) {
			$current_label = $label_arr[$i - 1];
			if ($i == $count) {
				// label
				$label_text = $current_label;

				// add item
				$current_item[$current_label] = [
					"label" => $label_text,
					"link" => $link,
					"icon" => $options["icon"],
					"submenu" => [],
					"dropdown_type" => "dropdown",
				];
			}
			else {
				if (!isset($current_item[$current_label])) return false;
				$current_item = &$current_item[$current_label]["submenu"];
			}
		}

		// done
		return true;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
			"type" => $this->type
		], $options);


		$buffer = \mod\ui::make()->buffer();

		switch ($options["type"]){
			case "standard": $this->build_standard($buffer, $options); break;
		}

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
	private function build_standard(&$buffer, $options = []){

		$options = array_merge([
			".navbar navbar-light navbar-expand-md" => true
		], $options);

		$buffer->nav_($options);
			$buffer->div_([".container-fluid" => true]);
			
				$buffer->div_([".navbar-translate" => true]);
				$buffer->xlink("#", "Campany Name", [".navbar-brand" => true]);
				$buffer->button_([".navbar-toggler" => true, "@data-toggle" => "collapse", "@data-target" => "#$this->id", "@type" => "button"]);
					$buffer->span([".sr-only" => true, "*" => "Toggle navigation"]);
					$buffer->xicon("fa-bars", [".text-white" => true]);
				$buffer->_button();
				$buffer->_div();


				$buffer->div_([".collapse navbar-collapse justify-content-end" => true, "@id" => $this->id]);

					$buffer->ul_([".navbar-nav mr-auto" => true]);

						$fn_add_li = function($link, $label, $options = []) use(&$buffer){

							$is_dropdown = (bool) $options["submenu"];


								if(!$is_dropdown){
									$options[".nav-link"] = true;
									$buffer->li_([".nav-item" => true]);
										$buffer->xlink($link, $label, $options);
									$buffer->_li();
								}else{
									switch ($options["dropdown_type"]){
										case "dropdown":
											$dropdown = \mod\ui::make()->dropdown();
											$dropdown->set_label($label);
											foreach ($options["submenu"] as $submenu){
												$dropdown->add_link($submenu["link"], $submenu["label"], $submenu);
											}
											$options["/link"][".nav-link"] = true;
											$options["wrapper_element"] = "li";
											$options["/wrapper"] = [".dropdown no-arrow nav-item" => true];
											$buffer->add($dropdown->build($options));
											break;
									}
								}

						};

						foreach ($this->item_arr as $item){
							$fn_add_li($item["link"], $item["label"], $item);
						}

					$buffer->_ul();
				$buffer->_div();
			$buffer->_div();
		$buffer->_nav();


//		$this->buffer->add("
//			<nav class='navbar navbar-light navbar-expand-md navigation-clean-button'>
//				<div class='container'>
//					<a class='navbar-brand' href='#'>Company Name</a>
//					<button data-toggle='collapse' data-target='#navcol-1' class='navbar-toggler'>
//						<span class='sr-only'>Toggle navigation</span>
//						<span class='navbar-toggler-icon'></span>
//					</button>
//					<div class='collapse navbar-collapse' id='navcol-1'>
//						<ul class='navbar-nav mr-auto'>
//							<li class='nav-item'>
//								<a class='nav-link active' href='#'>First Item</a>
//							</li>
//							<li class='nav-item'>
//								<a class='nav-link' href='#'>Second Item</a>
//							</li>
//							<li class='nav-item dropdown'>
//								<a aria-expanded='false' data-toggle='dropdown' class='dropdown-toggle nav-link' href='#'>Dropdown </a>
//								<div class='dropdown-menu'>
//									<a class='dropdown-item' href='#'>First Item</a>
//									<a class='dropdown-item' href='#'>Second Item</a>
//									<a class='dropdown-item' href='#'>Third Item</a>
//								</div>
//							</li>
//						</ul>
//						<span class='navbar-text actions'>
//							<a class='login' href='#'>Log In</a>
//							<a class='btn btn-light action-button' role='button' href='#'>Sign Up</a>
//						</span>
//					</div>
//				</div>
//			</nav>
//
//		");
		
	}
	//--------------------------------------------------------------------------------
	protected function dropdown(&$html, $item_arr, $level = 0) {
		// get keys
		$item_keys = array_keys($item_arr);

		foreach ($item_arr as $item_key => $item_item) {
			// get numeric index
			$key_index = array_search($item_key, $item_keys);

			// divider
			if (preg_match("/^-$/", $item_item["label"])) {
				$html->div(".dropdown-divider");
				continue;
			}

			// subheader
			if (preg_match("/^-.*/", $item_item["label"])) {
				// label
				$label = substr($item_item["label"], 1);

				// divider, only if this is not the first item
				if ($key_index) $html->div(".dropdown-divider");

				// item
				$html->h6_(".dropdown-header");
					if ($item_item["icon"]) $html->xicon($item_item["icon"], ["space" => true]);
					$html->content($label);
				$html->_h6();
				continue;
			}

			// submenu
			if ($item_item["submenu"]) {
				if (!$level) {
					$html->li_(".nav-item .dropdown .mr-2");
						$tid = \com\session::$current->session_uid;
						$html->xlink(false, $item_item["label"], [
							"@id" => $tid,
							".nav-link" => true,
							".dropdown-toggle" => true,
							"@role" => "button",
							"@data-toggle" => "dropdown",
							"@aria-haspopup" => "true",
							"@aria-expanded" => "false",
							"caret" => true,
							"icon" => $item_item["icon"],
						]);

						$html->ul_(".dropdown-menu", ["@aria-labelledby" => $tid]);
							$this->dropdown($html, $item_item["submenu"], $level + 1);
						$html->_ul();
					$html->_li();
				}
				else {
					$html->li_(".dropdown-submenu");
						$html->a(".dropdown-item .dropdown-toggle ^{$item_item["label"]}", ["@href" => "#"]);
						$html->ul_(".dropdown-menu");
							$this->dropdown($html, $item_item["submenu"], $level + 1);
						$html->_ul();
					$html->_li();
				}
			}
			else {
				if (!$level) $html->li_(".nav-item .mr-2");
				$this->link($html, $item_item, $level);
				if (!$level) $html->_li();
			}
		}
	}
	//--------------------------------------------------------------------------------
	protected function link(&$html, $item, $level) {
		// target
		$options = [];
		if (preg_match("/^http/i", $item["link"])) $options["@target"] = "_blank";

		// href
		$href = ($item["link"] ? $item["link"] : "#");

		// tab index
		$options["@tabindex"] = ($level ? -1 : false);

		// icon
		$options["icon"] = $item["icon"];
		if (!$level) {
			$options[".nav-link"] = true;
		}
		else $options[".dropdown-item"] = true;

		// html
		$html->xlink($href, $item["label"], $options);
	}
	//--------------------------------------------------------------------------------
}