<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class list_inline extends \mod\ui\intf\component {
	protected $item_arr = [];
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "List Inline";
	}
	//--------------------------------------------------------------------------------
	public function add_item($fn, $options = []) {
		$options = array_merge([
		    ".list-inline-item" => true
		], $options);

		$options["fn"] = $fn;

		$this->item_arr[] = $options;
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		], $options);


		$buffer = \mod\ui::make()->buffer();

		$buffer->ul_([".list-inline" => true]);

			foreach ($this->item_arr as $item){
				$buffer->li_($item);
					$item["fn"]($buffer);
				$buffer->_li();
			}

		$buffer->_ul();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}