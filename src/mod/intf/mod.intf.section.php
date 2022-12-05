<?php

namespace mod\intf;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
abstract class section extends \mod\intf\standard{

	//--------------------------------------------------------------------------------
	/**
	 * @return string
	 */
	abstract function get_set();
	//--------------------------------------------------------------------------------
	/**
	 * @return \mod\intf\standard
	 */
	abstract function get_ui();
	//--------------------------------------------------------------------------------
	/**
	 * @return \mod\intf\standard|string
	 */
	abstract function get_layout();
	//--------------------------------------------------------------------------------
}