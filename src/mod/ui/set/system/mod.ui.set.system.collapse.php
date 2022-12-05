<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class collapse extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected $title;
	protected $item_arr = [];
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Collapse";
	}
	//--------------------------------------------------------------------------------
	public function add_link($href, $label, $options = []) {
		$this->item_arr[] = array_merge( [
			"label" => $label,
			"@href" => $href,
			"icon" => false,
			"type" => "link",
			".collapse-item" => true,
		], $options);
	}
	//--------------------------------------------------------------------------------
	public function add_divider($options = []) {
		$this->item_arr[] = array_merge( [
			"type" => "divider",
		], $options);
	}
	//--------------------------------------------------------------------------------
	public function add_header($size, $title, $options = []) {
		$this->item_arr[] = array_merge( [
			"size" => $size,
			"title" => $title,
			"type" => "header",
			".collapse-header" => true
		], $options);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param string $title
	 */
	public function set_title(string $title): void {
		$this->title = $title;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		    "id" => \mod\str::generate_id(["prefix" => "dropdown"]),
		    "title" => $this->title,
		    "icon" => false,
		    "/link" => [],
		    "/collapse_inner" => [
		    	".py-2 rounded" => true,
			],
		], $options);

		$id = $options["id"];
		$buffer = \mod\ui::make()->buffer();

		$buffer->div_([".collapse-wrapper" => true]);

			$link = $options["/link"];
			$link[".nav-link collapsed"] = true;
			$link["@data-target"] = "#{$id}";
			$link["@aria-controls"] = $id;
			$link["@href"] = "#";
			$link["@data-toggle"] = "collapse";
			$link["@aria-expanded"] = "false";
			$link["icon"] = $options["icon"];

			$buffer->xlink("#", $options["title"], $link);

			$buffer->div_([".collapse" => true, "@id" => $id]);

				$collapse_inner = $options["/collapse_inner"];
				$collapse_inner[".collapse-inner"] = true;

				$buffer->div_($collapse_inner);
					$buffer->xheader(6, $options["title"], false, [".collapse-header" => true]);

					foreach ($this->item_arr as $item){
						switch ($item['type']){
							case "link": $buffer->xlink($item["@href"], $item["label"], $item); break;
							case "divider": $buffer->div([".collapse-divider" => true]); break;
							case "header": $buffer->xheader($item["size"], $item["title"], false, $item); break;
						}
					}

				$buffer->_div();
			$buffer->_div();

		$buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}