<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class table extends \mod\intf\standard {

	protected $id;

	/**
	 * @var \mod\db\sql\select
	 */
	protected $sql;
	protected $orderby = false;

	protected $total_items = 0;
	protected $total_pages = 0;
	protected $limit = 20;
	protected $offset = 0;
	protected $page = 1;
	protected $search = "";
	protected $search_field = "";

	protected $key = "";

	protected $action_arr = [];
	protected $field_arr = [];
	public $item_arr = [];

	protected $is_db_init = false;

	protected $enable_toolbar = true;

    /**
     * @var toolbar
     */
	protected $toolbar_left, $toolbar_right;

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Button";
		$this->id = \mod\str::generate_id(["prefix" => "table"]);
		$this->parse_requests();

		$this->toolbar_left = \mod\ui::make()->toolbar();
		$this->toolbar_right = \mod\ui::make()->toolbar();
	}
	//--------------------------------------------------------------------------------
    /**
     * @return string
     */
    public function get_id(): string {
        return $this->id;
    }
	//--------------------------------------------------------------------------------
    /**
     * @param string $key
     */
    public function set_key(string $key): void {
        $this->key = $key;
    }
	//--------------------------------------------------------------------------------
	public function build(&$buffer, $options = []) {

		$options = array_merge([
		], $options);

		if($this->sql) $this->init_db();

		$this->build_html($buffer);
		$this->build_js($buffer);

	}
	//--------------------------------------------------------------------------------
    public function nav_append_left($fn) {
        call_user_func_array($fn, [$this, &$this->toolbar_left]);
    }
	//--------------------------------------------------------------------------------
    public function nav_append_right($fn) {
        call_user_func_array($fn, [$this, &$this->toolbar_right]);
    }
	//--------------------------------------------------------------------------------
    public function parse_requests() {

        $this->page = \core::$request->get("page", TYPE_INT, ["default" => 1]);
        $this->orderby = \core::$request->get("orderby", TYPE_STRING);
        $this->search = \core::$request->get("search", TYPE_STRING);
        $id = \core::$request->get("ui_table", TYPE_STRING);
        if($id) $this->id = $id;

    }
	//--------------------------------------------------------------------------------
    public function set_search_field($field) {

        $this->search_field = $field;

        $this->toolbar_left->add_html(function(){
            return \mod\ui::make()->itext("search[{$this->id}]", $this->search, false, [
                ".form-control-sm" => true,
                "@placeholder" => "Search",
            ]);
        });
        $this->toolbar_left->add_button("", "{$this->id}.search();", [".btn-primary btn-sm" => true, "icon" => "fa-search"]);
        $this->toolbar_left->add_button("Clear", "{$this->id}.reset();", [".btn-primary btn-sm btn-reset" => true, ".d-none" => !$this->search]);
    }
	//--------------------------------------------------------------------------------

	/**
	 * @param $sql \mod\db\sql\select
	 */
	public function set_sql(\mod\db\sql\select $sql) {
		$this->sql = $sql;
	}
	//--------------------------------------------------------------------------------

	public function add_field($title, $field, $options = []){

	    $options = array_merge([
	        "title" => $title,
	        "index" => $field,
	        "function" => false,
	    ], $options);

		$this->field_arr[] = $options;
	}
	//--------------------------------------------------------------------------------

	public function add_action($label, $onclick, $options = []){

	    $options = array_merge([
	        "type" => "button",
	        "label" => $label,
	        "!click" => $onclick,
	        "/td" => [],
	    ], $options);

		$this->action_arr[] = $options;
	}
	//--------------------------------------------------------------------------------

	public function add_action_link($label, $href, $options = []){

	    $options = array_merge([
	        "type" => "link",
	        "label" => $label,
	        "@href" => $href,
	        "/td" => [],
	    ], $options);

		$this->action_arr[] = $options;
	}
	//--------------------------------------------------------------------------------

	public function add_action_dropdown($fn, $options = []){

	    $options = array_merge([
	        "type" => "dropdown",
	        "function" => $fn,
            "/td" => [],
	    ], $options);

		$this->action_arr[] = $options;
	}
	//--------------------------------------------------------------------------------

	public function add_action_sortable($options = []){
	    $this->add_action("", "alert(1)", ["icon" => "fa-arrows-alt-v"]);
	}
	//--------------------------------------------------------------------------------
    public function is_stream() {
        return \mod\http::is_ajax() && isset($_REQUEST["ui_table"]);
    }
	//--------------------------------------------------------------------------------
	public function stream_json_data() {

		if($this->is_stream()){
			if($this->sql && !$this->is_db_init){
				$this->init_db();

				$buffer = \mod\ui::make()->buffer();
				$this->build_thead($buffer);
			    $this->build_tbody($buffer);
			    $this->build_tfoot($buffer);

			    $buffer->script(["*" => "
			        $(function(){
			            let total_pages = parseInt('{$this->total_pages}');
			            let total_items = parseInt('{$this->total_items}');
			            if(total_pages > 1){
                            $('#{$this->id}_pagination').removeClass('d-none');
                            $('#{$this->id}_pagination').bootpag({total:total_pages, page:{$this->page}});
			            }else{
                            $('#{$this->id}_pagination').addClass('d-none');
			            }
			        });
			    "]);

			    ob_clean();

                \mod\http::json($buffer->build());
            }
			return "stream";
		}

	}
	//--------------------------------------------------------------------------------
	public function init_db() {

	    //init
		$this->is_db_init = true;

		//search
		if($this->search){
	        $this->sql->like($this->search_field, $this->search);
        }


		//get total entries
		$clone = clone $this->sql;
		$clone->clear_select();
		$clone->select_count($this->key);
		$this->total_items = \mod\db::make()->selectsingle($clone->build());
		$this->total_pages = ceil($this->total_items/$this->limit);

		//sql
        $this->offset = ($this->page == 1 ? 0 : ($this->limit * ($this->page-1)));
	    $this->sql->limit($this->limit);
	    $this->sql->offset($this->offset);

	    //build
		$this->item_arr = $this->sql->run();
	}
	//--------------------------------------------------------------------------------
	public function get_item_arr() {
		return [
			0 => [
				"id" => "1",
				"name" => "Tiger Nixon",
				"position" => "System Architect",
				"salary" => "$320,800",
				"start_date" => "2011/04/25",
				"office" => "Edinburgh",
				"extn" => "5421"
			],
			1 => [
				"id" => "2",
				"name" => "Garrett Winters",
				"position" => "System Architect",
				"salary" => "$320,800",
				"start_date" => "2011/04/25",
				"office" => "Edinburgh",
				"extn" => "5422"
			]
		];
	}
	//--------------------------------------------------------------------------------
    private function init_pagination() {
        $this->toolbar_right->add_html(function(){
	        return \mod\ui::make()->pagination([
	            "id" => "{$this->id}_pagination",
	            "*total" => $this->total_pages,
                "*page" => $this->page,
                "*maxVisible" => 5,
                "*firstLastUse" => true,
                "*leaps" => false,

                "*next" => \mod\ui::make()->icon("fa-angle-right"),
                "*prev" => \mod\ui::make()->icon("fa-angle-left"),

                "*first" => \mod\ui::make()->icon("fa-angle-double-left"),
                "*last" => \mod\ui::make()->icon("fa-angle-double-right"),

                "!click" => "function(page){ 
                    {$this->id}.paginate(page);
                }",

                "*wrapClass" => "ui-pagination",
                "*activeClass" => "active",
                "*disabledClass" => "disabled",
                "*nextClass" => "next",
                "*prevClass" => "previous",
                "*lastClass" => "last",
                "*firstClass" => "first",
            ]);
        });
    }
	//--------------------------------------------------------------------------------
    public function build_toolbar(&$buffer) {

	    $this->init_pagination();

	    $is_empty = $this->toolbar_right->is_empty() && $this->toolbar_left->is_empty();

	    if(!$is_empty){
            $buffer->div_([".ui-table-toolbar" => true]);

                $buffer->div_([".row align-items-center" => true]);
                    if(!$this->toolbar_left->is_empty()){
                        $buffer->div_([".col-auto" => true]);
                            $buffer->add($this->toolbar_left->build());
                        $buffer->_div();
                    }

                    if(!$this->toolbar_right->is_empty()){
                        $buffer->div_([".col-12 col-md d-flex justify-content-lg-end" => true]);
                            $buffer->add($this->toolbar_right->build());
                        $buffer->_div();
                    }
                $buffer->_div();

            $buffer->_div();
        }

    }
	//--------------------------------------------------------------------------------
    private function build_thead(&$buffer){

	    $columns_name_arr = array_column($this->field_arr, "title");

	    $buffer->thead_();
            $buffer->tr_();
                foreach ($columns_name_arr as $columns_name)
                    $buffer->th(["*" => \mod\str::propercase($columns_name)]);

                if($this->action_arr){
                    $buffer->th(["@colspan" => sizeof($this->action_arr)]);
                }

            $buffer->_tr();
        $buffer->_thead();
    }
	//--------------------------------------------------------------------------------
    private function build_tbody(&$buffer){

	    $buffer->body_();
        foreach ($this->item_arr as $item_index => $item_data){
            $buffer->tr_(["@data-row-id" => $item_data[$this->key]]);
            foreach ($this->field_arr as $field_index => $field_item){

                $field_name = $field_item["index"];
                $field_value = $item_data[$field_name];

                if($field_item["function"]){
                    $field_value = call_user_func_array($field_item["function"], [&$item_data[$field_name], $item_index, $field_index, $this]);
                }

                $field_item["*"] = $field_value;
                $buffer->td($field_item);
            }

            if($this->action_arr){
                foreach ($this->action_arr as $field_index => $field_item){

                    switch ($field_item["type"]){
                        case "dropdown":
                            $id = "{$this->get_id()}_{$item_index}_{$field_index}";
                            $dropdown = \mod\ui::make()->dropdown();
                            $dropdown->set_id($id);

                            call_user_func_array($field_item["function"], [$item_data, &$dropdown, $this]);
                            $field_item["/td"]["*"] = $dropdown->build(["icon" => "fa-ellipsis-v", "/link" => [".btn btn-light border btn-sm font-small" => true, ".dropdown-toggle" => false],]);
                            break;

                        case "button":

                            $onclick = $field_item["!click"];
                            unset($field_item["!click"]);
                            foreach ($item_data as $field => $value){
                                $onclick = str_replace(urlencode("%{$field}%"), $value, $onclick);
                                $onclick = str_replace("%{$field}%", $value, $onclick);
                            }

                            $field_item["/td"]["*"] = \mod\ui::make()->button($field_item["label"], $onclick, array_merge([".border btn-sm font-small" => true, ".btn-light" => true], $field_item));
                            break;

                        case "link":

                            $href = $field_item["@href"];
                            unset($field_item["@href"]);
                            foreach ($item_data as $field => $value){
                                $href = str_replace(urlencode("%{$field}%"), $value, $href);
                                $href = str_replace("%{$field}%", $value, $href);
                            }

                            $field_item["/td"]["*"] = \mod\ui::make()->link($href, $field_item["label"], array_merge([".border btn-sm font-small" => true, ".btn-light" => true], $field_item));
                            break;
                    }


                    $field_item["/td"][".ui-table-action"] = true;
                    $buffer->td($field_item["/td"]);
                }
            }
            $buffer->_tr();
        }
        $buffer->_body();
    }
	//--------------------------------------------------------------------------------
    private function build_tfoot(&$buffer){

	    $columns_name_arr = array_column($this->field_arr, "title");

	    $buffer->tfoot_();
            $buffer->tr_();
                foreach ($columns_name_arr as $columns_name)
                    $buffer->th(["*" => \mod\str::propercase($columns_name)]);
            $buffer->_tr();
        $buffer->_tfoot();
    }
	//--------------------------------------------------------------------------------
	private function build_html(&$buffer = false){

		$buffer->div_([".ui-table-wrapper" => true, "@data-id" => $this->id]);

		    if($this->enable_toolbar){
		        $this->build_toolbar($buffer);
            }

			$buffer->table_(["@class" => "table table-striped table-bordered", "@id" => $this->id]);
			    $this->build_thead($buffer);
			    $this->build_tbody($buffer);
			    $this->build_tfoot($buffer);
			$buffer->_table();
		$buffer->_div();
	}
	//--------------------------------------------------------------------------------
	private function build_js(&$buffer){

		$js_options = [];
		$js_options["*id"] = $this->id;
		$js_options["*url"] = current_url()."?ui_table={$this->id}";
		$js_options["*panel"] = \core::$panel;
		$js_options = \mod\js::create_options($js_options);

		$buffer->script(["*" => "
		    if(typeof {$this->id} === 'undefined'){
                var {$this->id};
                $(function(){
                    {$this->id} = new table({$js_options});
                });
            }
		"]);
//		\mod\js::add_script("
//		    if(typeof {$this->id} === 'undefined'){
//                var {$this->id};
//                $(function(){
//                    {$this->id} = new table({$js_options});
//                });
//            }
//
//		");
	}
	//--------------------------------------------------------------------------------
}