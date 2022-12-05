<?php

namespace mod;

use \CodeIgniter\I18n\Time;
use \CodeIgniter\I18n\TimeDifference;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class date{

    //--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------

	/**
	 * 24-03-12
	 * @var string
	 */
	public static $DATE_FORMAT = "Y-m-d";

	/**
	 * 24-03-12 12:32:21
	 * @var string
	 */
	public static $DATE_TIME_FORMAT = "Y-m-d H:i:s";

	/**
	 * 15:12:15
	 * @var string
	 */
    public static $DATE_TIME = "H:i:s";

	/**
	 * Saturday 24th March 2012
	 * @var string
	 */
    public static $DATE_FORMAT_01 = "l\, jS F Y";

	/**
	 * 5:45pm on Saturday 24th March 2012
	 * @var string
	 */
    public static $DATE_FORMAT_02 = "g:ia \o\\n l jS F Y";

	/**
	 * 24th March 2012
	 * @var string
	 */
    public static $DATE_FORMAT_03 = "jS F Y";

	/**
	 * 24th March 2012, 5:45pm
	 * @var string
	 */
    public static $DATE_FORMAT_04 = "jS F Y\, g:ia";

	/**
	 * 24th Mar, 5:45pm
	 * @var string
	 */
    public static $DATE_FORMAT_5 = "jS M Y\, g:ia";

    /**
     * output date format: 5:45pm
     */
    public static $DATE_FORMAT_6 = "g:ia";


	public static $list_weekdays = [
		"Sunday",
		"Monday",
		"Tuesday",
		"Wednesday",
		"Thursday",
		"Friday",
		"Saturday",
	];
	public static $list_months = [
		1 => "January",
		2 => "February",
		3 => "March",
		4 => "April",
		5 => "May",
		6 => "June",
		7 => "July",
		8 => "August",
		9 => "September",
		10 => "October",
		11 => "November",
		12 => "December",
	];
	public static $list_months_af = [
		1 => "Januarie",
		2 => "Februarie",
		3 => "Maart",
		4 => "April",
		5 => "Mei",
		6 => "Junie",
		7 => "Julie",
		8 => "Augustus",
		9 => "September",
		10 => "Oktober",
		11 => "November",
		12 => "Desember",
	];

	protected static $timer_arr = [];

	//--------------------------------------------------------------------------------
	// static
	//--------------------------------------------------------------------------------
	public static function strtodate($string = "today", $format = false, $options = []) {
		// options
		$options = array_merge([
			"default" => null,
		], $options);

		if(!$format) $format = self::$DATE_FORMAT;

		// format
		$time = Time::parse($string);
		$time->format($format);
		return $time->toDateString();
	}
	//--------------------------------------------------------------------------------
	public static function strtodatetime($string = "now", $format = false, $options = []) {

		if(!$format) $format = self::$DATE_TIME_FORMAT;

		// format
		$time = Time::parse($string);
		$time->format($format);
		return $time->toDateTimeString();
	}
	//--------------------------------------------------------------------------------
	public static function strtotime($string = "now", $format = false, $options = []) {

		if(!$format) $format = self::$DATE_TIME;

		return self::strtodate($string, $format, $options);
	}
	//--------------------------------------------------------------------------------
	public static function parse_timestamp($timestamp, $format = false, $options = []) {

		return self::strtodatetime(date('m/d/Y H:i:s', $timestamp), $format);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $date
	 * @return array
	 */
	public static function split($date) {
		// get timestamp
		$stamp = strtotime($date);

		// return date parts
		return [
			"year" => date("Y", $stamp),
			"month" => date("n", $stamp),
			"day" => date("j", $stamp),
		];
	}
	//--------------------------------------------------------------------------------
	public static function build($options = []) {
		// options
		$options = array_merge([
			"date" => false,
			"year" => false,
			"month" => false,
			"day" => false,
		], $options);

		// date
		if (!$options["date"]) {
			$options["date"] = \mod\date::strtodate();
		}

		// build date
		$split = \mod\date::split($options["date"]);
		if ($options["year"]) $split["year"] = $options["year"];
		if ($options["month"]) $split["month"] = $options["month"];
		if ($options["day"]) $split["day"] = $options["day"];

		// done
		return self::strtodate("{$split["year"]}-{$split["month"]}-{$split["day"]}");
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $date1
	 * @param $date2
	 * @return TimeDifference
	 */
	public static function get_diff($date1, $date2) {
	    $date1 = Time::parse($date1);
		$date2    = Time::parse($date2);
		return $date1->difference($date2);
	}
	//--------------------------------------------------------------------------------
	public static function year_diff($date1, $date2) {
		return self::get_diff($date1, $date2)->getYears();
	}
	//--------------------------------------------------------------------------------
	public static function month_diff($date1, $date2) {
		return self::get_diff($date1, $date2)->getMonths();
	}
	//--------------------------------------------------------------------------------
	public static function days_diff($date1, $date2) {
		return self::get_diff($date1, $date2)->getDays();
	}
	//--------------------------------------------------------------------------------
	public static function minute_diff($date1, $date2) {
		return self::get_diff($date1, $date2)->getMinutes();
	}
	//--------------------------------------------------------------------------------
	public static function hour_diff($date1, $date2) {
		return self::get_diff($date1, $date2)->getHours();
	}
	//--------------------------------------------------------------------------------
	public static function second_diff($date1, $date2) {
		return self::get_diff($date1, $date2)->getSeconds();
	}
 	//--------------------------------------------------------------------------------
    public static function is_date($date, $format = false){

		if(!$format) $format = self::$DATE_FORMAT;

        if (\DateTime::createFromFormat($format, $date) !== FALSE) {
            return true;
        }
        return false;
    }
	//--------------------------------------------------------------------------------
    public static function is_datetime($date, $format = false){

		if(!$format) $format = self::$DATE_TIME_FORMAT;

        if (\DateTime::createFromFormat($format, $date) !== FALSE) {
            return true;
        }
        return false;
    }
	//--------------------------------------------------------------------------------
	/**
	 * @return bool
	 */
    public static function is_weekend_day_today(){
        $day = strtolower(\mod\date::strtodate("today", "l"));
        if(($day == "saturday" )|| ($day == "sunday")){
            return true;
        }
        return false;
    }
	//--------------------------------------------------------------------------------

	/**
	 * @param string $format
	 * @return array
	 */
    public static function get_calendar_months_arr($format = "F"){

        $current_year = \mod\date::strtodate("today", "Y");

        $return_arr = [];
        $date_arr = self::get_datetime_arr("$current_year-01-01", "$current_year-12-31", "+ 1 month", "Y-m-d");

        array_walk($date_arr, function(&$item) use($format, &$return_arr){
            $return_arr[\mod\date::strtodate($item, "n")] = \mod\date::strtodate($item, $format);
        });

        return $return_arr;
    }
    //--------------------------------------------------------------------------------

	/**
	 * Takes a nova datetime stamp, and substitutes the year in the timestamp with the new year
	 * @param $start_date
	 * @param $end_date
	 * @param string $step
	 * @param string $format
	 * @return array
	 */
    public static function get_datetime_arr( $start_date, $end_date, $step = '+ 1 hour', $format = false ) {

    	if(!$format) $format = self::$DATE_FORMAT;

        $dates = array();
        $current = \mod\date::strtodatetime($start_date);
        $last = \mod\date::strtodatetime($end_date);

        while( $current <= $last ) {
            $dates[] = \mod\date::strtodatetime($current, $format);
            $current = \mod\date::strtodatetime("$current $step");
        }

        return $dates;
    }
    //--------------------------------------------------------------------------------
	/**
	 * gets an array of 24h
	 * @return array
	 */
	public static function get_time_arr() {
		$formatter = function ($time) {
			return \mod\date::strtotime("$time:00", "g:i a");
		};
		$halfHourSteps = range(1, 24);

		$return = [];
		array_walk($halfHourSteps, function($value, $key) use(&$return, $formatter){
			$return[$value] = $formatter($value);
		});

		return $return;
	}
    //--------------------------------------------------------------------------------
    public static function get_year_list($start_year = 1970, $end_year = false) {
        if(!$end_year) $end_year = \mod\date::strtodate("today", "Y");

        $return = [];

        foreach(range($start_year, (int)date("Y")) as $year) {
            $return[$year] = $year;
            if($end_year == $year) { break; }
        }
        asort($return);

        return $return;
    }
    //--------------------------------------------------------------------------------
    public static function get_weeks_arr() {
        $week_arr = [];
        for ($index = 1; $index <= 52; $index++) {
            $week_arr[$index] = $index > 1 ? "$index Weeks" : "$index Week";
        }
        return $week_arr;
    }
    //--------------------------------------------------------------------------------
    public static function is_between($date, $date_start, $date_end) {

		$date = \mod\date::strtodate($date);
		$date_start = \mod\date::strtodate($date_start);
		$date_end = \mod\date::strtodate($date_end);

		if($date == "null") return false;
		if($date_start == "null") return false;
		if($date_end == "null") return false;

		if (($date >= $date_start) && ($date <= $date_end)) return true;
		return false;
    }
    //--------------------------------------------------------------------------------

}
