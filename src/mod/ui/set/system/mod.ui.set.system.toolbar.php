<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class toolbar extends \mod\ui\intf\component {

	protected $item_arr = [];

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Toolbar";
	}
	//--------------------------------------------------------------------------------
	public function is_empty() {
	    return !$this->item_arr;
	}
	//--------------------------------------------------------------------------------
	public function add_button($label, $onclick = false, $options = []) {

	    $options = array_merge([
	        "/toolbar_item" => [],
	        "content" => \mod\ui::make()->button($label, $onclick, $options),
	    ], $options);

		$this->item_arr[] = $options;
	}
	//--------------------------------------------------------------------------------
	public function add_link($label, $href = "#", $options = []) {

	    $options = array_merge([
	        "/toolbar_item" => [],
	        "content" => \mod\ui::make()->link($href, $label, $options),
	    ], $options);

		$this->item_arr[] = $options;
	}
	//--------------------------------------------------------------------------------
	public function add_html($html, $options = []) {

	    $options = array_merge([
	        "/toolbar_item" => [],
	        "content" => is_callable($html) ? $html() : $html,
	    ], $options);

		$this->item_arr[] = $options;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		], $options);


		if(!$this->item_arr) return "";

		$buffer = \mod\ui::make()->buffer();

		$buffer->div_([".ui-toolbar d-flex flex-wrap" => true]);
		    $last_index = \mod\arr::get_last_index($this->item_arr);
		    foreach ($this->item_arr as $index => $item){

		        $item["/toolbar_item"][".ui-toolbar-item mb-2"] = true;
		        $item["/toolbar_item"][".mr-2"] = $index != $last_index;
		        $buffer->div_($item["/toolbar_item"]);
                    $buffer->add($item["content"]);
                $buffer->_div();

            }
	    $buffer->_div();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}