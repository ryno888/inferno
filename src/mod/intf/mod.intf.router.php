<?php

namespace mod\intf;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
abstract class router extends standard {

	protected $options = [];
	protected $session;

	//--------------------------------------------------------------------------------
	public function __construct($options = []) {
		$this->session = session();
		$this->options = $options;
	}
	//--------------------------------------------------------------------------------
	abstract public function run(&$buffer, $options = []);
	//--------------------------------------------------------------------------------
}