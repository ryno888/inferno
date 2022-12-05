<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class debug extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Debug";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		], $options);

		if(!file_exists(DIR_TEMP."/console.txt")) return null;
		if(\core::get_environment() != "development") return null;


		$buffer = \mod\ui::make()->buffer();
		if(file_exists(DIR_TEMP."/console.txt")){
			$buffer->div_(["#position" => "fixed", "#left" => "0", "#bottom" => "0", ".debug-wrapper" => true]);
				$buffer->xbutton("view", "window.open('".\mod\http::build_action_url("index/vdebug")."', '_blank')", [".btn-sm" => true]);
				$buffer->xbutton("clear", \mod\js::ajax(\mod\http::build_action_url("index/functions/xclear_debug"), [
					"*data" => ["close_window" => \mod\http::get_control() == "index/vdebug"],
					"*success" => "function(response){
						app.ajax.process_response(response);
					}"
				]), [".btn-sm" => true]);
			$buffer->_div();
		}

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}