<?php

namespace mod\ui\set\system;

/**
 *
 * https://www.daterangepicker.com/#usage
 *
 * Class scrolltotop
 * @package app\ui\set\bootstrap
 * @author Ryno Van Zyl
 * @copyright Copyright Liquid Edge Solutions. All rights reserved.
 */

class idaterange extends \mod\ui\intf\component {

    //--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	protected static $is_singleton = true;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Date Range Picker";
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
    public function build($options = []) {
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
			"hidden" => false,
			"multifield" => false,
			"singlepicker" => false,
			"autoapply" => true,
			"/field1" => [],
			"/field2" => [],

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
		], $options);

        // init
		$id = $options["id"];
		$startdate = $options["startdate"];
		$enddate = $options["enddate"];
		$label = $options["label"];
		$onchange = '';

		// value
  		if($startdate) $startdate = \mod\date::strtodate($startdate, ($options["value_format"] ?: \mod\date::$DATE_FORMAT), ["default" => \mod\date::strtodate()]);
  		if($enddate) $enddate = \mod\date::strtodate($enddate, ($options["value_format"] ?: \mod\date::$DATE_FORMAT), ["default" => \mod\date::strtodate()]);

        $buffer = \mod\ui::make()->buffer();
        $options["prepend"] = \mod\ui::make()->icon("calendar", [".mr-2" => false]);
        $options[".$id"] = true;

        $JS_start_id = \mod\js::parse_id("{$id}[startdate]");
        $JS_end_id = \mod\js::parse_id("{$id}[enddate]");
        $JS_id = \mod\js::parse_id($id);

        $options["target"] = "#$JS_id";

        if($options["multifield"]) $this->add_multifield($buffer, $id, $options);
        else $buffer->xitext($id, false, $label, $options);

        $js = [];
        $js[] = "
            $('{$options["target"]}').daterangepicker(".\mod\js::create_options([
                "*autoUpdateInput" => false,
                "*singleDatePicker" => $options["singlepicker"],
                "*autoApply" => $options["autoapply"],
                "*opens" => "center",
                "*minDate" => \mod\date::strtodate(),
                "*locale" => ["format" => "YYYY-MM-DD"],
            ]).", function(start, end, label) {
                $onchange
            });
        ";

        if($startdate) {
            $js[] = "$('{$options["target"]}').data('daterangepicker').setStartDate('$startdate');";
            \mod\js::add_script("$(function(){ setTimeout(function(){ $('#$JS_start_id').val('$startdate'); }, 50) });");
        }
        if($enddate){
            $js[] = "$('{$options["target"]}').data('daterangepicker').setEndDate('$enddate');";
            \mod\js::add_script("$(function(){ setTimeout(function(){ $('#$JS_end_id').val('$enddate'); }, 50) });");
        }

        if($options["multifield"]){
            $js[]= "
                $('{$options["target"]}').on('show.daterangepicker', function(ev, picker) {
                    if($('#$JS_start_id').val().length){
                        picker.setStartDate($('#$JS_start_id').val());
                        $('#$JS_start_id').val(picker.startDate.format('YYYY-MM-DD'));
                    }
                    if($('#$JS_end_id').val().length){
                        picker.setEndDate($('#$JS_end_id').val());
                        $('#$JS_end_id').val(picker.endDate.format('YYYY-MM-DD'));
                    }
                });
                $('{$options["target"]}').on('cancel.daterangepicker', function(ev, picker) {
                    $('#$JS_start_id').val(picker.startDate.format('YYYY-MM-DD'));
                    $('#$JS_end_id').val(picker.endDate.format('YYYY-MM-DD'));
                });
                $('{$options["target"]}').on('apply.daterangepicker', function(ev, picker) {
                    $('#$JS_start_id').val(picker.startDate.format('YYYY-MM-DD'));
                    $('#$JS_end_id').val(picker.endDate.format('YYYY-MM-DD'));
                });
                $('{$options["target"]}').on('hide.daterangepicker', function(ev, picker) {
                    $('#$JS_start_id').val(picker.startDate.format('YYYY-MM-DD'));
                    $('#$JS_end_id').val(picker.endDate.format('YYYY-MM-DD'));
                });
            ";
        }

        \mod\js::add_script("
            $(function(){".implode(" ", $js)."});
        ");

        return $buffer->get_clean();

    }
    //--------------------------------------------------------------------------------
    private function add_multifield(&$buffer, $id, &$options) {

	    $options["target"] = ".$id";
	    $options[".daterange"] = false;
	    $options["@readonly"] = true;
	    $options[".bg-white"] = true;
	    $options["/wrapper"] = [".w-50" => true];

        $buffer->div_([".d-flex $id" => true]);
            $buffer->xitext("{$id}[startdate]", false, false, array_merge($options, $options["/field1"]));
            $buffer->div([".mr-2" => true]);
            $buffer->xitext("{$id}[enddate]", false, false, array_merge($options, $options["/field2"]));
        $buffer->_div();
    }
	//--------------------------------------------------------------------------------
}