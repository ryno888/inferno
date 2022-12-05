<?php

namespace app;

class app extends \mod\intf\standard {

	//--------------------------------------------------------------------------------
	public function init() {

		//build constants
		\mod\solid_classes\coder::make()->build_constants();
	}
	//--------------------------------------------------------------------------------
	public function install() {

		//build constants
		\mod\solid_classes\coder::make()->build_library();
		\mod\solid_classes\coder::make()->build_constants();
	}
	//--------------------------------------------------------------------------------
}