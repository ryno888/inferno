<?php

namespace app\acc\layout;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class system extends \mod\intf\layout {

	protected $name = "system";

	//--------------------------------------------------------------------------------
	public function get_layout($options = []) {

		$this->head = \app\acc\router\system\head::make();
		$this->navbar = \app\acc\router\system\navbar::make();
		$this->body = \app\acc\router\system\body::make();
		$this->footer = \app\acc\router\system\footer::make();
		$this->scripts = \app\acc\router\system\scripts::make();

	}
	//--------------------------------------------------------------------------------
}