<?php

namespace mod\ui\intf;

/**
 * @package mod\ui\intf
 * @author Ryno Van Zyl
 */
abstract class set extends \mod\intf\standard{
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// interface
	//--------------------------------------------------------------------------------
	/**
	 * @param $name
	 * @param array $options
	 * @return mixed|\mod\ui\intf\component
	 */
	abstract public function get($name, $options = []);
	//--------------------------------------------------------------------------------
	abstract public function get_js_includes();
	//--------------------------------------------------------------------------------
	abstract public function get_css_includes();
	//--------------------------------------------------------------------------------
}