<?php

namespace mod\solid_classes;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */
class coder extends \mod\intf\standard {
	//--------------------------------------------------------------------------------
	public function loop_solid_classes($fn) {
		foreach (directory_map(DIR_MOD."/solid_classes/") as $key => $item){
			if(strpos($key, "\\") !== false){
				foreach ($item as $solid_class){
					$class_name = \mod\os::php_filename_to_classname($solid_class);
					call_user_func($fn, $class_name, str_replace("\\", "/", DIR_MOD."/solid_classes/".$solid_class));
				}
			}
		};
	}
	//--------------------------------------------------------------------------------
	/**
	 * @return array
	 */
	public function get_constant_arr(): array {
		$constant_arr = [];
		$this->loop_solid_classes(function($class_name, $filename) use(&$constant_arr){

			$category = str_replace("mod.solid_classes.", "", basename($filename));
			$category_parts = explode(".", $category);
			$category = reset($category_parts);

			$solid = helper::make()->get_from_classname($class_name);
			$constant_arr[strtoupper($category)][$solid->get_code()] = [
				"classname" => $class_name,
				"filename" => $filename,
				"constant" => $solid->get_code(),
				"value" => $solid->get_value(),
				"category" => strtoupper($category),
			];
		});

		return $constant_arr;
	}
	//--------------------------------------------------------------------------------
	public function build_constants() {

		$constants_str = $this->get_constants_arr_string();

		if ($constants_str) {
			$dir = DIR_MOD . "/solid_classes";
			$filename = "mod.solid_classes.constants.php";

			$constant_str = implode("\n", $constants_str);

			$content = <<<EOD
<?php
namespace mod\solid_classes;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */

$constant_str


EOD;

			file_put_contents("$dir/$filename", $content);
		}

	}
	//--------------------------------------------------------------------------------
	private function get_constants_arr_string() {

		$return_arr = [];
		$constant_arr = $this->get_constant_arr();

		foreach ($constant_arr as $category => $constant_data_arr) {

			$return_arr[] = <<<EOD
//-------------------------------------------------------------
//{$category}
//-------------------------------------------------------------
EOD;
			foreach ($constant_data_arr as $constant => $data) {
				$return_arr[] = "if(!defined(\"{$constant}\")) define(\"{$constant}\", \"{$data["value"]}\");";
			}

		}

		return $return_arr;

	}
	//--------------------------------------------------------------------------------
	public function build_library() {

		$constant_arr = $this->get_constant_arr();

		if ($constant_arr) {
			$dir = DIR_MOD . "/solid_classes";
			$filename = "mod.solid_classes.library.php";

			$content_arr= [];

			foreach ($constant_arr as $category => $constant_data_arr) {

				foreach ($constant_data_arr as $constant => $data) {

					$classname = str_replace("\\", "\\\\", $data["classname"]);
					$content_arr[] = <<<EOD
		"$constant" => [
			"classname" => "{$classname}",
			"filename" => "{$data["filename"]}",
			"constant" => "{$data["constant"]}",
			"value" => "{$data["value"]}",
			"category" => "{$data["category"]}",
		],
EOD;


					$return_arr[] = "if(!defined(\"{$constant}\")) define(\"{$constant}\", {$data["value"]});";
				}

			}

			$content_str = implode("\n", $content_arr);

			$content = <<<EOD
<?php
namespace mod\solid_classes;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */

class library extends \mod\intf\standard {

	public \$index_arr = [
		$content_str
	];

}


EOD;

			file_put_contents("$dir/$filename", $content);
		}

	}
	//--------------------------------------------------------------------------------
}