<?php

namespace mod\intf;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
abstract class action extends standard {

	public $session;

	/**
	 * @var \mod\request
	 */
	public $request;

	public $data = [];

	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

		$this->session = session();
		$this->request = \core::$request;

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $buffer \mod\ui\set\system\buffer
	 * @param array $options
	 * @return mixed
	 */
	abstract public function run(&$buffer, $options = []);
	//--------------------------------------------------------------------------------
	public function set_data(array $data) {
		$this->data = $data;
	}
	//--------------------------------------------------------------------------------
	public function __get($name) {

		if(isset($this->data[$name])) return $this->data[$name];

	}
	//--------------------------------------------------------------------------------
	public function build_url($control, $data = []) {

		return \mod\http::build_action_url($control, $data);

	}
	//--------------------------------------------------------------------------------
}