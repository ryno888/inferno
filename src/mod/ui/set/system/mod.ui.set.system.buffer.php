<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class buffer extends \mod\ui\intf\component {
	//--------------------------------------------------------------------------------
	// fields
	//--------------------------------------------------------------------------------
	/**
	 * Internal buffer used to store html returned from the calls made to this class.
	 * @var string
	 */
	protected $html = null;
	/**
	 * Keeps track of the current open tag structure and level.
	 * @var string[]
	 */
	protected $tag_arr = [];
	/**
	 * When set to true, calls passed to the class will be echoed directly instead of
	 * added to the buffer html.
	 * @var bool
	 */
	protected $echo = null;
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// options
		$options = array_merge([
			"echo" => false,
		], $options);

		// init
		$this->name = "HTML Buffer";
		$this->html = false;
		$this->echo = $options["echo"];
	}
	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	public function __call($name, $arguments) {
		// allow calls to be made directly to com.ui by prefixing the function with a x
		if (substr($name, 0, 1) == "x") {
			// chain-able
			return $this->add(call_user_func_array([\mod\ui::make(), substr($name, 1)], $arguments));
		}

		// any standard html tag
		$this->add(call_user_func_array([\mod\ui::make()->tag(), $name], $arguments));

		// check if tag was left open
		$last_detail = \mod\ui::make()->tag()->get_last_detail();
		if (!$last_detail["closed"]) {
			if ($last_detail["tag"]) $this->tag_arr[] = $last_detail["tag"];
		}
		else {
			$last_tag = end($this->tag_arr);
			if ($last_tag == $last_detail["tag"]) array_pop($this->tag_arr);
		}

		// chain-able
		return $this;
	}
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function build($options = []) {
		return $this->get_clean();
	}
	//--------------------------------------------------------------------------------
	public function is_clean() {
		return !(bool)$this->html;
	}
	//--------------------------------------------------------------------------------
	public function add($string) {
		// support for ui elements
		if (is_object($string) && method_exists($string, "build")) {
			$string = $string->build();
		}

		// echo or add to buffer
		if ($this->echo) {
			echo $string;
		}
		else {
			$this->html .= $string;
		}

		// chain-able
		return $this;
	}
	//--------------------------------------------------------------------------------
	/**
	 * Adds an HTML closing tag to the buffer.
	 *
	 * @param string|boolean|int $tag When a string is given, uses it as the tag to close. When boolean false, uses the last open tag added. When int is given, closes x number of last added open tags.
	 *
	 * @return \mod\ui\intf\buffer
	 */
	public function close($tag = false) {
		// close more than once
		$count = 1;
		if (is_numeric($tag)) {
			$count = $tag;
			$tag = false;
		}
		elseif ($tag === true) {
			$count = count($this->tag_arr);
			$tag = false;
		}

		// close tags
		for ($i = 0; $i < $count; $i++) {
			// get last tag in dom tree if we got nothing
			$current_tag = false;
			if (!$tag) $current_tag = array_pop($this->tag_arr);
			else {
				// make sure we remove the last tag from the stack if we are forcing a remove
				$last_tag = end($this->tag_arr);
				if ($last_tag == $tag) $current_tag = array_pop($this->tag_arr);
			}

			// do nothing if we have no tag
			if (!$current_tag) continue;

			// close tag
			$this->add(call_user_func_array([\mod\ui::make()->tag(), "_{$current_tag}"], []));
		}

		// chain-able
		return $this;
	}
	//--------------------------------------------------------------------------------
	/*
	 * Returns the contents of the buffer.
	 *
	 * @return string <p>The HTML buffer contents.</p>
	 */
	public function get() {
		// done
		return $this->html;
	}
	//--------------------------------------------------------------------------------
	/**
	 * Output the contents of the buffer to the page and cleans the buffer. Will close
	 * the entire tag tree first.
	 */
	public function flush() {
		// close tag tree
		$this->close(true);

		// display buffer
		echo $this->html;

		// clear buffer
		$this->html = false;
	}
	//--------------------------------------------------------------------------------
	/**
	 * Clears the contents of the HTML buffer without closing any tags.
	 */
	public function clean() {
		// clear buffer
		$this->html = false;

		// clear tag buffer
		$this->tag_arr = [];
	}
    //--------------------------------------------------------------------------------
	/**
	 * Returns and cleans the contents of the buffer. Will close the entire tag tree
	 * first.
	 *
	 * @return string <p>The HTML buffer contents.</p>
	 */
	public function get_clean() {
		// close tag tree
		$this->close(true);

		// display buffer
		$html = $this->html;

		// clear buffer
		$this->html = false;

		// done
		return $html;
	}
	//--------------------------------------------------------------------------------
	public function form_wrapper($options) {
		// close tag tree
		$this->close(true);

		// display buffer
		$html = $this->html;

		// clear buffer
		$this->html = false;

		// done
		return $html;
	}
	//--------------------------------------------------------------------------------
}