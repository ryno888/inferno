<?php

namespace mod\db;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class coder extends \mod\intf\standard {

	protected $name;
	protected $prefix;
	protected $key;
	protected $display_field;
	protected $display_name;
	protected $field_arr = [];

	//--------------------------------------------------------------------------------
	public function __construct() {
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $name
	 */
	public function set_name($name): void {
		$this->name = $name;
	}

	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $key
	 */
	public function set_key($key): void {
		$this->key = $key;
	}

	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $display_name
	 */
	public function set_display_name($display_name): void {
		$this->display_name = $display_name;
	}

	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $display_field
	 */
	public function set_display_field($display_field): void {
		$this->display_field = $display_field;
	}

	//--------------------------------------------------------------------------------
	/**
	 * @param mixed $prefix
	 */
	public function set_prefix($prefix): void {
		$this->prefix = $prefix;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $name
	 * @param $display_name
	 * @param $type
	 * @param $default
	 * @param $reference
	 */
	public function add_field($name, $display_name, $type, $default, $reference): void {
		$this->field_arr[] = [
			"name" => $name,
			"display_name" => $display_name,
			"type" => $type,
			"default" => $default,
			"reference" => $reference,
		];
	}
	//--------------------------------------------------------------------------------
	public function run() {


		$field_str_arr = [];

		foreach ($this->field_arr as $field_data){
			$field_str_arr[] = "\"{$field_data["name"]}\"			=> array(\"{$field_data["display_name"]}\"		, \"{$field_data["default"]}\", {$field_data["type"]}, {$field_data["reference"]}),";
		}

		$field_str = implode("\n", $field_str_arr);

		$content = <<<EOD
<?php
/**
 * @package db
 * @author Ryno Van Zyl
 */
class {$this->name} extends \\mod\\db\\intf\\table {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	public \$name = "{$this->name}";
	public \$key = "{$this->key}";
	public \$display = "{$this->display_field}";

	public \$display_name = "{$this->display_name}";

	public \$field_arr = array( // FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
		{$field_str}
	);
 	//--------------------------------------------------------------------------------
}
EOD;

		$filename = DIR_APP."/db/db.{$this->name}.php";
		if(file_exists($filename)) return;

		file_put_contents($filename, $content);

	}
	//--------------------------------------------------------------------------------
}