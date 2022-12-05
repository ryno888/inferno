<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class db extends \mod\intf\standard {
	//--------------------------------------------------------------------------------
	/**
	 * @return mixed|\Config\Database
	 */
	public static function get_config() {
		return config('Database');
	}
	//--------------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	public static function get_db_driver() {
		return self::get_config()->default["DBDriver"];
	}
	//--------------------------------------------------------------------------------
    public function selectsingle($sql) {

		$result_arr = $this->select($sql);

		$result = reset($result_arr);

		if(is_array($result))
            return reset($result);
		else return false;
    }
	//--------------------------------------------------------------------------------
    /**
     * @param $sql
     * @return array|array[]
     */
    public function select($sql): array {

        if($sql instanceof \mod\db\sql\select)
            $sql = $sql->build();

        $connection = \mod\connection::get_connection();
		$query = $connection->query($sql);
		return $query->getResultArray();
    }
	//--------------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	public static function dbvalue($value, $options = []) {

		$options = array_merge([
			"wrap_quote" => "'",
			"skip_opentag" => false,
		], $options);

		$replace_arr = ["'" => "''", '<' => '&lt;', "\0" => ""];
		if ($options["skip_opentag"]) unset($replace_arr["<"]);
		return ($value === 'null' ? 'NULL' : $options["wrap_quote"].strtr($value, $replace_arr).$options["wrap_quote"]);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field_arr
     * @param false $alias
     * @return string
     */
    public static function getsql_concat($field_arr, $alias = false) {

	    $sql = "CONCAT(".implode(", ", $field_arr).")";
	    if($alias) $sql = "{$sql} AS {$alias}";

        return $sql;
    }
	//--------------------------------------------------------------------------------
}