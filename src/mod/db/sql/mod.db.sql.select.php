<?php

namespace mod\db\sql;

/**
 * Class.
 *
 * @author Liquid Edge Solutions
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class select extends \mod\db\intf\sql {

	/**
	 * @var \CodeIgniter\Database\BaseConnection
	 */
	protected $connection;

	/**
	 * @var \CodeIgniter\Database\BaseBuilder
	 */
	protected $builder;
	protected $init_table = false;

	/**
	 * @var array
	 */
	private $distinct = false;

	private $select_arr = [];
	private $from_arr = [];
	private $where_arr = [];
	private $groupby_arr = [];
	private $orderby;

	private $limit = 0;
	private $offset = 0;
	//--------------------------------------------------------------------------------

	public function __construct() {

		$this->connection = \mod\connection::get_connection();

	}
	//--------------------------------------------------------------------------------
	/**
	 * @return \CodeIgniter\Database\BaseConnection
	 */
	public function get_connection(): \CodeIgniter\Database\BaseConnection {
		return $this->connection;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $table
	 * @return $this
	 */
	public function from($table) {

	    if(!$this->init_table) $this->init_table = $table;
	    else {
            $this->from_arr[] = [
                "type" => "FROM",
                "sql" => $table,
            ];
        }

		return $this;
	}
	//--------------------------------------------------------------------------------
    public function clear_select() {
        $this->select_arr = [];
    }
	//--------------------------------------------------------------------------------
	/**
	 * @param $sql
	 * @return $this
	 */
	public function select($sql) {

		$this->select_arr[] = [
		    "type" => "SELECT",
		    "sql" => $sql,
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $sql
	 * @return $this
	 */
	public function select_max($field, $alias = false) {

	    $this->select_method("MAX", $field, $alias);

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $method
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_method($method, $field, $alias = false) {

	    $this->select_arr[] = [
		    "type" => $method,
		    "field" => $field,
		    "alias" => $alias,
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_min($field, $alias = false) {

		return $this->select_method("MIN", $field, $alias);

	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_avg($field, $alias = false) {

		return $this->select_method("AVG", $field, $alias);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_sum($field, $alias = false) {

		return $this->select_method("SUM", $field, $alias);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param false $alias
     * @return $this
     */
	public function select_count($field, $alias = false) {

		return $this->select_method("COUNT", $field, $alias);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $table
	 * @param $on
	 * @param false $left_join
	 * @return $this
	 */
	public function join($table, $on, $left_join = false) {

	    $this->from_arr[] = [
	        "type" => "JOIN",
	        "sql" => $table,
	        "on" => $on,
	        "left_join" => $left_join,
        ];

//		$this->builder->join($table, $on, !$left_join?:'left');

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $table
     * @param $on
     * @return $this
     */
	public function left_join($table, $on) {
		return $this->join($table, $on, true);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $where
	 * @return $this
	 */
	public function and_where($where, $fn_subquery = null) {

		if($fn_subquery){

			$mixed = $fn_subquery(\mod\db\sql\select::make());
			if($mixed instanceof \mod\db\sql\select) $mixed = $mixed->build();

			$where = "$where (\n\t".str_replace("\n", "\n\t", $mixed)."\n)";
		}

		$this->where_arr[] = [
            "type" => "AND_WHERE",
            "sql" => $where,
        ];

//		$this->builder->where($where);

		return $this;
	}
	//--------------------------------------------------------------------------------
    /**
     * @param $field
     * @param null $operator
     * @param null $value
     * @return $this
     */
	public function or_where($field, $operator = null, $value = null) {

	    $this->where_arr[] = [
            "type" => "OR_WHERE",
            "field" => $field,
            "operator" => $operator,
            "value" => $value,
        ];

//		$this->builder->orWhere("{$field} {$operator}", $value);
		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param array $in_arr
     * @param false $not
     * @return $this
     */
	public function where_in($field, $in_arr = [], $not = false) {

	    $this->where_arr[] = [
            "type" => "IN_WHERE",
            "field" => $field,
            "values" => is_callable($in_arr) ? $in_arr() : \mod\arr::splat($in_arr),
            "not" => $not ? " NOT " : "",
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param array $search_arr
     * @param false $not
     * @return $this
     */
	public function or_where_in($field, $search_arr = [], $not = false) {

	    $this->where_arr[] = [
            "type" => "OR_IN_WHERE",
            "field" => $field,
            "operator" => is_callable($search_arr) ? $search_arr() : \mod\arr::splat($search_arr),
            "not" => $not ? " NOT " : "",
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param $match
     * @param false $not
     * @return $this
     */
	public function like($field, $match, $not = false) {

	    $this->where_arr[] = [
            "type" => "LIKE",
            "field" => $field,
            "match" => $match,
            "not" => $not ? " NOT " : "",
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @param array $search_arr
     * @param false $not
     * @return $this
     */
	public function or_like($field, $search_arr = [], $not = false) {

		$search_arr = \mod\arr::splat($search_arr);

		if (!$search_arr) return $this;

		$this->where_arr[] = [
            "type" => "OR_LIKE",
            "field" => $field,
            "search_arr" => $search_arr,
            "not" => $not ? " NOT " : "",
        ];

		return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $field
     * @return $this
     */
	public function groupby($field) {
	    $this->groupby_arr[] = $field;

	    return $this;
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
	public function having($key, $value = null) {

	    $this->where_arr[] = [
            "type" => "HAVING",
            "key" => $key,
            "value" => $value,
        ];

	    return $this;

//		$this->builder->having($key, $value);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
	public function or_having($key, $value = null) {

	    $this->where_arr[] = [
            "type" => "OR_HAVING",
            "key" => $key,
            "value" => $value,
        ];

	    return $this;
//		$this->builder->orHaving($key, $value);
	}
	//--------------------------------------------------------------------------------

    /**
     * @return $this
     */
	public function distinct() {
		$this->distinct = true;

		return $this;
	}
	//--------------------------------------------------------------------------------
    /**
     * @param $field
     * @param $sort
     * @return $this
     */
	public function orderby($field, $sort) {

	    $this->orderby = [
	        "field" => $field,
	        "sort" => $sort,
        ];

	    return $this;

//		$this->builder->orderBy($field, $sort);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $value
     * @return $this
     */
	public function limit($value) {

		$this->limit = $value;

		return $this;
//		$this->builder->limit($value, $offset);
	}
	//--------------------------------------------------------------------------------

    /**
     * @param $value
     * @return $this
     */
	public function offset($value) {

		$this->offset = $value;

		return $this;
//		$this->builder->limit($value, $offset);
	}
	//--------------------------------------------------------------------------------
	public function run() {

		$sql = $this->build();

		$query = $this->connection->query($sql);

		$result_arr = $query->getResultArray();

		if($this->limit == 1){
			return reset($result_arr);
		}

		return $result_arr;
	}
	//--------------------------------------------------------------------------------
	public function build() {

	    $this->builder = $this->connection->table($this->init_table);

	    //distinct
        if($this->distinct)
            $this->builder->distinct();

        //select
        foreach ($this->select_arr as $select_data){
            switch ($select_data["type"]){
                case "SELECT": $this->builder->select($select_data["sql"]); break;
                case "MAX": $this->builder->selectMax($select_data["field"], $select_data["alias"]); break;
                case "MIN": $this->builder->selectMin($select_data["field"], $select_data["alias"]); break;
                case "AVG": $this->builder->selectAvg($select_data["field"], $select_data["alias"]); break;
                case "SUM": $this->builder->selectSum($select_data["field"], $select_data["alias"]); break;
                case "COUNT": $this->builder->selectCount($select_data["field"], $select_data["alias"]); break;
            }
        }

        //from
        foreach ($this->from_arr as $from_data){
            switch ($from_data["type"]){
                case "FROM": $this->builder->from($from_data["sql"]); break;
                case "JOIN": $this->builder->join($from_data["sql"], $from_data["on"], !$from_data["left_join"]?:'left'); break;
            }
        }

        //where
        foreach ($this->where_arr as $where_data){
            switch ($where_data["type"]){
                case "AND_WHERE": $this->builder->where($where_data["sql"]); break;
                case "OR_WHERE": $this->builder->orWhere("{$where_data["field"]} {$where_data["operator"]}", $where_data["value"]); break;
                case "IN_WHERE": $this->builder->whereIn("{$where_data["not"]}{$where_data["field"]}", $where_data["values"]); break;
                case "OR_IN_WHERE": $this->builder->orWhereIn("{$where_data["not"]}{$where_data["field"]}", $where_data["values"]); break;
                case "LIKE": $this->builder->like("{$where_data["not"]}{$where_data["field"]}", $where_data["match"]); break;
                case "OR_LIKE": $this->builder->orLike("{$where_data["not"]}{$where_data["field"]}", $where_data["match"]); break;
                case "HAVING": $this->builder->having($where_data["key"], $where_data["value"]); break;
                case "OR_HAVING": $this->builder->orHaving($where_data["key"], $where_data["value"]); break;
            }
        }

        //group by
        if($this->groupby_arr)
		    $this->builder->groupBy($this->groupby_arr);

        //order by
		if($this->orderby)
		    $this->builder->orderBy($this->orderby["field"], $this->orderby["sort"]);

		//limit
        if($this->limit)
            $this->builder->limit($this->limit, $this->offset);

		return $this->builder->getCompiledSelect(false);

	}
	//--------------------------------------------------------------------------------
}
