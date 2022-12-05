<?php

namespace app\acc\layout;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class website extends \mod\intf\layout {

	protected $name = "website";

	//--------------------------------------------------------------------------------
	public function get_layout($options = []) {

		$this->head = \app\acc\router\website\head::make();
		$this->navbar = \app\acc\router\website\navbar::make();
		$this->body = \app\acc\router\website\body::make();
		$this->footer = \app\acc\router\website\footer::make();
		$this->scripts = \app\acc\router\website\scripts::make();
	}
	//--------------------------------------------------------------------------------
}