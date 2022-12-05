<?php

namespace mod\ui\set;

/**
 * @package mod\ui\set
 * @author Ryno Van Zyl
 */
class website extends system {
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Website";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function get($name, $options = []) {
	    $options_arr = array_merge([
	    ], $options);

		$class = $this->get_class_name($name);

		return $class::make($options);
	}
    //--------------------------------------------------------------------------------
    protected function get_class_name($name){

		//evaluate app - bootstrap folder
	    if(file_exists(DIR_MOD."/ui/set/website/mod.ui.set.custom.$name.php")){
	        return "\\mod\\ui\\set\\custom\\{$name}";
        }

        //evaluate app - bootstrap folder
	    if(file_exists(DIR_MOD."/ui/set/website/mod.ui.set.website.$name.php")){
	        return "\\mod\\ui\\set\\website\\{$name}";
        }

        //default to com
	    return "\\mod\\ui\\set\\system\\{$name}";

    }
	//--------------------------------------------------------------------------------
}