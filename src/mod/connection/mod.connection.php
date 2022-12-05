<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class connection extends \mod\connection\intf\connection {
	//--------------------------------------------------------------------------------
	/**
	 * @param array $options
	 * @return \CodeIgniter\Database\BaseConnection
	 */
	public static function get_connection($options = []) {

		return \Config\Database::connect();
	}
	//--------------------------------------------------------------------------------
}