<?php

namespace mod\db\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class sql extends \mod\intf\standard {

	//--------------------------------------------------------------------------------
	// internal
	//--------------------------------------------------------------------------------
	protected function is_mysql() {

		return (\mod\db::get_db_driver() == "MySQLi");
	}
	//--------------------------------------------------------------------------------
	protected function is_sqlsrv() {
		return (\mod\db::get_db_driver() == "sqlsrv");
	}
	//--------------------------------------------------------------------------------
}