<?php

namespace mod\ui\set\system;

/**
 * @package app\ui\set\bootstrap
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */
class idate extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct() {
		$this->name = "Date input";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		// options
		$options = array_merge([
			"id" => false,
			"value" => false,
			"value_format" => false,
			"label" => false,

			// basic
			"!change" => false,
			"@disabled" => false,
			"@placeholder" => "yyyy-mm-dd",
			"@data-date-format" => "yyyy-mm-dd",

			// advanced
			"width" => false,
			"hidden" => false,
			"start_date" => false,
			"end_date" => false,
			"disabled_dates_arr" => [],
			"min_view" => "month", // lowest view to go down to
			"start_view" => false, // which view to start at
			"view_select" => false, // which view to trigger selection at

			// form-input
			"help" => false,
			"required" => false,
			"prepend" => false,
			"append" => false,
			"wrapper_id" => false,
			"label_width" => false,
			"label_col" => false,
			"label_html" => false,

			".ui-idate" => true,
			"js_options" => [],
		],$options);

		// init
		$id = $options["id"];
		$value = $options["value"];
		$label = $options["label"];

		$fn_js_array = function ($array) {
			$temp = array_map(function($s){
				$s = \mod\date::strtodate($s, "d-m-Y");
				return "'" . addcslashes($s, "\0..\37\"\\") . "'";
			}, $array);
			return "[". implode(",", $temp) ."]";
		};

		$disabled_dates_js_str = $fn_js_array($options["disabled_dates_arr"]);


		// value
  		if($value) $value = \mod\date::strtodate($value, ($options["value_format"] ?: \mod\date::$DATE_FORMAT), ["default" => ""]);

		// html
		$html = \mod\ui::make()->buffer();

		// input
        $options[".bg-white"] = true;
		$html->xitext($id, $value, $label, $options);

		// javascript
		$JS_id = strtr($id, ["[" => "\\\\[", "]" => "\\\\]", "." => "\\\\."]);
		if (!$options["hidden"] && !$options["@disabled"]) {

		    $js = [];
            $js[] = "
                $('#$JS_id').daterangepicker(".\mod\js::create_options(array_merge([
                    "*autoUpdateInput" => false,
                    "*singleDatePicker" => true,
                    "*showDropdowns" => true,
                    "*autoApply" => true,
                    "*drops" => "auto",
                    "*opens" => "center",
                    "*minDate" => \mod\date::strtodate(),
                    "*locale" => ["format" => "YYYY-MM-DD"],
                    "*isInvalidDate" => "!function(date){
						for(var ii = 0; ii < disabled_dates_arr.length; ii++){
							if (date.format('DD-MM-YYYY') == disabled_dates_arr[ii]){
							  return true;
							}
						}
					}",
                ], $options["js_options"])).", function(start, end, label) {
                    {$options["!change"]}
                });
            ";

		    \mod\js::add_script("
                $(function(){
                
                	$('body').on('focus', '#$id', function(){
                	   $(this).attr('readonly', 'readonly');
                	});
                	
                	$('body').on('blur', '#$id', function(){
                	   $(this).removeAttr('readonly');
                	});
                
                	 var disabled_dates_arr = $disabled_dates_js_str;
                	 
                    ".implode(" ", $js)."
                    
                    $('#$JS_id').on('apply.daterangepicker', function(ev, picker) {
                        $(this).val(picker.startDate.format('YYYY-MM-DD'));
                    });
                    
                    $('#$JS_id').on('cancel.daterangepicker', function(ev, picker) {
                        $(this).val('');
                    });
                    
                });
            ");

		}

  		// done
		return $html->get_clean();
	}
	//--------------------------------------------------------------------------------
}