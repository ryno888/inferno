<?php

namespace mod\solid_classes;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class intf extends \mod\intf\standard {
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return $this->get_display_name();
	}
	//--------------------------------------------------------------------------------
	/**
	 * The display name of the property
	 * @return string
	 */
	abstract public function get_display_name(): string;
	//--------------------------------------------------------------------------------

	/**
	 * Return a description
	 * @return string
	 */
	abstract public function get_description(): string;
	//--------------------------------------------------------------------------------

	/**
	 * The code used to build the constant
	 * @return string
	 */
	abstract public function get_code(): string;
	//--------------------------------------------------------------------------------

	/**
	 * The GS1 key of the property
	 * @return mixed
	 */
	abstract public function get_value();
	//--------------------------------------------------------------------------------

	/**
	 * The data type of the property
	 * @return mixed
	 */
	abstract public function get_data_type();
	//--------------------------------------------------------------------------------

	/**
	 * The default value of the property
	 * @return mixed
	 */
	public function get_default() {
		return \mod\data::parse(null, $this->get_data_type());
	}
	//--------------------------------------------------------------------------------

	/**
	 * Parses the value to the appropriate data type
	 * @param $mixed
	 * @return mixed|string
	 */
	public function parse($mixed) {
		return \com\data::parse($mixed, $this->get_data_type());
	}
	//--------------------------------------------------------------------------------
}