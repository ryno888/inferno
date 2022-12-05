<?php

namespace db;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class product extends \mod\db\intf\table {

	//--------------------------------------------------------------------------------
    // properties
    //--------------------------------------------------------------------------------
    public $name = "product";
    public $key = "pro_id";
    public $display = "pro_name";

    public $display_name = "product";
    public $seo = "pro_seo_name";

    public $field_arr = array(// FIELDNAME => DISPLAY[0] DEFAULT[1] TYPE[2] REFERENCE[3]
        // identification
        "pro_id"                            => array("database id"                  , "null"    , TYPE_KEY),
		"pro_name"                          => array("name"                         , ""		, TYPE_STRING),
		"pro_type" 					        => array("type"					        , 0			, TYPE_ENUM),
		"pro_description" 					=> array("description"					, ""		, TYPE_TEXT),
		"pro_meta_description" 				=> array("meta Description"				, ""		, TYPE_TEXT),
		"pro_alternate_name" 				=> array("alternate Name"				, ""		, TYPE_STRING),
		"pro_key"                           => array("Product Code"                 , ""		, TYPE_STRING),
        "pro_is_deleted"                    => array("is deleted"                   , 0         , TYPE_BOOL),
        "pro_is_new"                        => array("is new"                       , 0         , TYPE_BOOL),
        "pro_is_secure"                     => array("is secure"                    , 0         , TYPE_BOOL),
        "pro_is_featured"                   => array("is featured"                  , 0         , TYPE_BOOL),
        "pro_date_modified"                 => array("date modified"                , "null"    , TYPE_DATE),
        "pro_date_created"                  => array("date created"                 , "null"    , TYPE_DATE),
        "pro_date_last_sync"                => array("date last sync"               , "null"    , TYPE_DATE),
        "pro_findstring"                    => array("findstring"                   , ""        , TYPE_TEXT),
        "pro_ref_product"					=> array("product"						, "null"	, TYPE_REFERENCE, "product"),
        "pro_ref_address"					=> array("address"						, "null"	, TYPE_REFERENCE, "address"),
        "pro_ref_person_created"		    => array("person created"			    , "null"	, TYPE_REFERENCE, "person"),
        "pro_seo_name"                      => array("seo_name"                     , ""        , TYPE_STRING),
    );
    //--------------------------------------------------------------------------------
    public $pro_is_enabled = [
        0 => "Unpublished",
        1 => "Published",
    ];
	//--------------------------------------------------------------------------------
	public static function test(){
		display("test");
	}
	//--------------------------------------------------------------------------------
}