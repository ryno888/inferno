<?php

namespace action\website\index;

/**
 * Class data
 * @package app
 * @author Ryno Van Zyl
 */

class table extends \mod\intf\action {

	//--------------------------------------------------------------------------------
	// methods
	//--------------------------------------------------------------------------------
	public function run(&$buffer, $options = []) {

        $table = \mod\ui::make()->table();
        $table->set_key("per_id");
        $table->set_search_field(\mod\db::getsql_concat(["per_firstname", "per_email"]));
//        $table->nav_append_left(function($table, $toolbar){
//            $toolbar->add_button("test", false, [".btn-primary btn-sm" => true]);
//            $toolbar->add_button("test", false, [".btn-primary btn-sm" => true]);
//            $toolbar->add_html(function(){
//                return \mod\ui::make()->itext("test", false, false, [".form-control-sm" => true]);
//            });
//            $toolbar->add_html(function(){
//                return \mod\ui::make()->iselect("test2", [null => "-- Not Selected --", "test" => "test"], false, false, [".form-control-sm" => true]);
//            });
//        });
        $table->set_sql(\mod\db\sql\select::make()
            ->select("per_id AS id")
            ->select("person.*")
            ->from("person")
        );

        $table->add_field("Name", "per_firstname", ["function" => function($content, $item_index, $field_index, $list){
            return $content ? $content : "-";
        }]);
        $table->add_field("Email", "per_email");

        $table->add_action("Edit", \core::$panel.".popup('http://ember.local/index.php/index/route/website/index/table')");
        $table->add_action("Delete", "alert(1)", [".btn-danger" => true, ".btn-light" => false]);
        $table->add_action_dropdown(function($item_data, $dropdown, $table){
            $dropdown->add_link("#", "test");
            $dropdown->add_link("#", "test 2");
        });


        if($table->is_stream())
            return $table->stream_json_data();

        $table->build($buffer);

		return "website";
	}
    //--------------------------------------------------------------------------------

}
