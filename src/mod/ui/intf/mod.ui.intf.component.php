<?php

namespace mod\ui\intf;

/**
 * @package mod\ui\intf
 * @author Ryno Van Zyl
 */
abstract class component extends \mod\intf\standard{

	protected $id;
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->id = \mod\str::generate_id(["prefix" => "component"]);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @return string
	 */
	public function get_id(): string {
		return $this->id;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param string $id
	 */
	public function set_id(string $id): void {
		$this->id = $id;
	}
	//--------------------------------------------------------------------------------
	// interface
	//--------------------------------------------------------------------------------
	abstract public function build($options = []);
	//--------------------------------------------------------------------------------
}