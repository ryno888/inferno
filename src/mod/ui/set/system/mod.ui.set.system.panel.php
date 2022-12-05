<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class panel extends \mod\ui\intf\component {

    protected $id;
    protected $url;
    protected $html;
    protected $options = [];

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {

	    $options = array_merge([
	        "id" => \core::$request->get_get("p", TYPE_STRING, ["default" => \mod\str::generate_id(["prefix" => "panel"])]),
	        "url" => false,
	        "html" => false,
            ".ui-panel" => true,
	    ], $options);

		// init
		$this->name = "Panel";
		$this->id = $options["id"];

		$this->url = $options["url"];
		$this->html = $options["html"];
		$this->options = $options;
	}
	//--------------------------------------------------------------------------------
    /**
     * @param mixed $url
     */
    public function set_url($url): void {
        $this->url = $url;
    }
	//--------------------------------------------------------------------------------
    /**
     * @param mixed $html
     */
    public function set_html($html): void {
        $this->html = $html;
    }
	//--------------------------------------------------------------------------------
	public function build($options = []) {

	    $options = array_merge([
	        "@id" => $this->id
        ],$this->options, $options);

	    $buffer = \mod\ui::make()->buffer();

	    $buffer->div_($options);
	        $buffer->add($this->html);
	    $buffer->_div();


	    $js_options = \mod\js::create_options([
	        "*id" => $this->id,
	        "*url" => $this->url,
        ]);

        \mod\js::add_script("
            if(typeof {$this->id} === 'undefined'){
                var {$this->id};
                $(function(){
                    
                    {$this->id} = new panel({$js_options});
                    ".(!$this->html ? "{$this->id}.refresh();" : "")."
                });
            }
        ");

	    return $buffer->build();
	}
	//--------------------------------------------------------------------------------
}