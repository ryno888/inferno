<?php

namespace app\acc\layout;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class clean extends \mod\intf\layout {

	protected $name = "system";

	//--------------------------------------------------------------------------------
	public function get_layout($options = []) {

		$this->head = \app\acc\router\clean\head::make();
		$this->body = \app\acc\router\clean\body::make();
		$this->scripts = \app\acc\router\clean\scripts::make();

	}
	//--------------------------------------------------------------------------------
}