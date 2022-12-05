<?php

namespace mod;

class ui extends \mod\intf\standard {

	/**
	 * @var false|mixed | \mod\intf\section
	 */
	protected $section;

	//--------------------------------------------------------------------------------
	public function __construct($options = []) {

		$options = array_merge([
		    "section" => "system"
		], $options);

		$this->section = call_user_func(["\\app\\acc\\section\\{$options["section"]}", "make"]);
	}

	//--------------------------------------------------------------------------------
	/**
	 * @return false|mixed|\mod\ui\intf\set
	 */
	public function get_ui_set() {

		$set = $this->section->get_set();

		if(!$set) $set = "system";

		$path = "\\mod\\ui\\set\\$set";

		return call_user_func([$path, "make"]);

	}
	//--------------------------------------------------------------------------------

    /**
     * @param $url
     * @param array $options
     * @return intf\standard|ui\set\system\panel
     */
    public function panel($url, $options = []) {
	    $options = array_merge([
	        "url" => $url,
	        "id" => false,
	    ], $options);

	    return \mod\ui\set\system\panel::make($options);

    }
	//--------------------------------------------------------------------------------
    /**
     * @param array $options
     * @return false|string|null
     */
    public function pagination( $options = []) {
	    return \mod\ui\set\system\pagination::make()->build($options);
    }
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \mod\ui\set\system\page_loader
	 */
	public function page_loader($options = []) {

		return $this->section->get_ui()->get("page_loader")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \mod\ui\set\system\debug
	 */
	public function debug($options = []) {

		return $this->section->get_ui()->get("debug")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \mod\ui\set\system\toolbar
	 */
	public function toolbar($options = []) {

		return $this->section->get_ui()->get("toolbar", $options);

	}
	//--------------------------------------------------------------------------------

	public function form($action, $options = []) {

		$options = array_merge([
		    "id" => str::generate_id(["prefix" => "form"]),
		    "action" => $action,
		], $options);

		return $this->section->get_ui()->get("form")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param false $id
	 * @param array $options
	 * @return mixed|\mod\ui\set\system\table
	 */
	public function table($id = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
		], $options);

		return $this->section->get_ui()->get("table", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $src
	 * @param array $options
	 * @return \SVG\SVG
	 * @throws \Exception
	 */
	public function svg($src, $options = []) {

		$options = array_merge([
		    "color" => false,
		    "change_colors" => [],
		], $options);

		$svg = \mod\svg::make($options);
		$svg->from_file("$src");
		if($options["color"]) $svg->change_color($options["color"]);
		if($options["change_colors"]){
			foreach ($options["change_colors"] as $from => $to){
				$svg->change_color($to, $from);
			}
		}
		return $svg->get();

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \mod\ui\set\system\list_inline
	 */
	public function list_inline($options = []) {

		return $this->section->get_ui()->get("list_inline", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \mod\ui\set\system\tag
	 */
	public function tag($options = []) {

		return $this->section->get_ui()->get("tag", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \mod\ui\set\system\buffer
	 */
	public function buffer($options = []) {

		return $this->section->get_ui()->get("buffer", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \mod\ui\set\system\dropdown
	 */
	public function dropdown($options = []) {

		return $this->section->get_ui()->get("dropdown", $options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $email
	 * @param false $label
	 * @param false $icon
	 * @param array $options
	 * @return mixed|ui\set\system\link|string
	 */
	public function dropdown_email($email, $label = false, $icon = false, $options = []) {

		if(!$label) $label = $email;

		$options["title"] = $label;
		$options["email"] = $email;
		$options["icon"] = $icon;

		// done
		return \mod\ui\set\custom\dropdown_email::make()->build($options);
	}
    //--------------------------------------------------------------------------------

	/**
	 * @param $number
	 * @param false $label
	 * @param false $icon
	 * @param array $options
	 * @return mixed
	 */
	public function dropdown_number($number, $label = false, $icon = false, $options = []) {

		if(!$number) return "";

		$dropdown_number = \mod\ui\set\custom\dropdown_number::make();

		if(!$label) $label = $number;

		$dropdown_number->add_number($number, $label, $icon);

		$options["icon"] = $icon;

		// done
		return $dropdown_number->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed
	 */
	public function space($height = 10, $options = []) {
		$options["height"] = $height;
		return $this->section->get_ui()->get("space")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\collapse
	 */
	public function collapse($options = []) {

		return $this->section->get_ui()->get("collapse", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $title
	 * @param false $sub_title
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\card
	 */
	public function card($title, $sub_title = false, $options = []) {

		$options = array_merge([
			"color" => "primary",
		    "icon" => false,
		    "title" => $title,
		    "sub_title" => $sub_title,
            "html" => false,
		], $options);

		return $this->section->get_ui()->get("card")->build($options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $value
	 * @param string $color
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\progress
	 */
	public function progress($value, $color = "primary", $options = []) {

		$options = array_merge([
			"color" => $color,
			"value" => $value,
			"value_min" => 0,
			"value_max" => 100,
			"enable_label" => true,
		], $options);

		return $this->section->get_ui()->get("progress")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed| \mod\ui\set\system\dropdown_menu
	 */
	public function dropdown_menu($options = []) {

		return $this->section->get_ui()->get("dropdown_menu", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param string $type
	 * @param array $options
	 * @return mixed|\mod\ui\set\system\navbar
	 */
	public function navbar($type = "standard", $options = []) {

		$options["type"] = $type;

		return $this->section->get_ui()->get("navbar", $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $icon
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\icon
	 */
	public function icon($icon, $options = []) {

		$options["icon"] = $icon;

		return $this->section->get_ui()->get("icon")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $href
	 * @param false $label
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\link
	 */
	public function link($href, $label = null, $options = []) {

		$options = array_merge([
		    "label" => $label,
		    "@href" => $href,
		    "icon" => false,
		], $options);

		return $this->section->get_ui()->get("link")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $href
	 * @param false $label
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\link
	 */
	public function image($src, $options = []) {

		$options = array_merge([
		    "@src" => $src,
		], $options);

		return $this->section->get_ui()->get("image")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $size
	 * @param $title
	 * @param false $sub_title
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\header
	 */
	public function header($size, $title, $sub_title = false, $options = []) {

		$options = array_merge([
		    "size" => $size,
		    "title" => $title,
		    "sub_title" => $sub_title,
		], $options);

		return $this->section->get_ui()->get("header")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $label
	 * @param string $onclick
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\button
	 */
	public function button($label, $onclick = false, $options = []) {

		$options = array_merge([
		    "label" => $label,
		    "!click" => $onclick,
		], $options);

		return $this->section->get_ui()->get("button")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed|\mod\ui\set\system\button_toolbar
	 */
	public function button_toolbar($options = []) {
		return $this->section->get_ui()->get("button_toolbar", $options);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $type
	 * @param $id
	 * @param $value
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\input
	 */
	public function input($type, $id, $value, $options = []) {

		$options = array_merge([
		    "@id" => $id,
			"@value" => $value,
			"@type" => $type,
		], $options);

		return $this->section->get_ui()->get("input")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $type
	 * @param $id
	 * @param $value
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\itext
	 */
	public function itext($id, $value = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"value" => $value,
			"label" => $label,
		], $options);

		return $this->section->get_ui()->get("itext")->build($options);

	}
	//--------------------------------------------------------------------------------

	public function ihidden($id, $value, $options = []) {

		return \mod\ui::make()->input("hidden", $id, $value, $options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $type
	 * @param $id
	 * @param $value
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\itextarea
	 */
	public function itextarea($id, $value = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"value" => $value,
			"label" => $label,
			"rows" => 5,
		], $options);

		return $this->section->get_ui()->get("itextarea")->build($options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param false $checked
	 * @param false $label
	 * @param array $options
	 * @return mixed|\mod\ui\set\system\icheckbox
	 */
	public function icheckbox($id, $checked = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"checked" => $checked,
			"label" => $label,
		], $options);

		return $this->section->get_ui()->get("icheckbox")->build($options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param $input_options_arr
	 * @param false $value
	 * @param false $label
	 * @param array $options
	 * @return mixed
	 */
	public function iradio($id, $input_options_arr, $value = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"label" => $label,
			"input_options_arr" => $input_options_arr,
			"value" => $value,
		], $options);


		/**
		 *
		 //todo:toggle between custom and standard
		 <div class="form-check form-check-radio">
			<label class="form-check-label">
				<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
					   value="option1">
				<span class="form-check-sign"></span>
				Radio is off
			</label>
		</div>
		 */

		return $this->section->get_ui()->get("iradio")->build($options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param $value_options_arr
	 * @param false $value
	 * @param false $label
	 * @param array $options
	 * @return mixed
	 */
	public function iselect($id, $value_options_arr, $value = false, $label = false, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"label" => $label,
			"value_options_arr" => $value_options_arr,
			"value" => $value,
		], $options);

		return $this->section->get_ui()->get("iselect")->build($options);

	}
	//--------------------------------------------------------------------------------
	public function idate($id, $value = false, $label = false, $options = []) {
		// options
  		$options["id"] = $id;
  		$options["value"] = $value;
  		$options["label"] = $label;

		// done
		return $this->section->get_ui()->get("idate")->build($options);
	}
//	//--------------------------------------------------------------------------------
//	public function idatetime($id, $value = false, $label = false, $options = []) {
//		// options
//  		$options["id"] = $id;
//  		$options["value"] = $value;
//  		$options["label"] = $label;
//
//		// done
//		return $this->set->get("idatetime")->build($options);
//	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $id
	 * @param false $startdate
	 * @param false $enddate
	 * @param false $label
	 * @param array $options
	 * @return false|string|null
	 */
	public function idaterange($id, $startdate = false, $enddate = false, $label = false, $options = []) {

	    // options
  		$options["id"] = $id;
  		$options["startdate"] = $startdate;
  		$options["enddate"] = $enddate;
  		$options["label"] = $label;

	    return $this->section->get_ui()->get("idaterange")->build($options);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $id
	 * @param $fn
	 * @param array $options
	 * @return mixed
	 */
	public function form_input($id, $fn, $options = []) {

		$options = array_merge([
		    "id" => $id,
			"fn" => $fn,
		], $options);

		return $this->section->get_ui()->get("form_input")->build($options);

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param array $options
	 * @return mixed | \mod\ui\set\system\html
	 */
	public function html($options = []) {
		return $this->section->get_ui()->get("html", $options);
	}
	//--------------------------------------------------------------------------------
}
