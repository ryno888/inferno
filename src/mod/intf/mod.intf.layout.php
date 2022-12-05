<?php

namespace mod\intf;

/**
 * @package mod\intf
 * @author Ryno Van Zyl
 */
abstract class layout extends standard {

	/**
	 * @var \mod\intf\router
	 */
	public $head, $menu, $navbar, $body, $footer, $scripts, $debug;

	//--------------------------------------------------------------------------------
	abstract public function get_layout($options = []);
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		    "content" => false
		], $options);

		$this->get_layout();

		$buffer = \mod\ui::make()->buffer();

		$buffer->add("<!DOCTYPE html>");
		$buffer->html_(["@lang" => "en"]);

			if($this->head) $this->head->run($buffer);

			$buffer->body_(["@id" => "page-top"]);
				$buffer->div_(["@id" => "wrapper"]);
					if($this->menu) $this->menu->run($buffer);
					$buffer->div_(["@id" => "content-wrapper", ".d-flex flex-column" => true]);
						$buffer->div_(["@id" => "content"]);
							if($this->navbar) $this->navbar->run($buffer);

							$buffer->xpage_loader();
							if($this->body){
								$this->body->run($buffer, $options);
							}

						$buffer->_div();
					$buffer->_div();

					if($this->footer){
						$buffer->footer_(["@id" => "footer", ".footer" => true]);
							 $this->footer->run($buffer);
						$buffer->_footer();
					}

					if($this->debug) $this->debug->run($buffer);

				$buffer->_div();

				if($this->scripts) $this->scripts->run($buffer);

			$buffer->_body();
			$buffer->div(["@data-token" => \core::$request->get_csrf(), ".security-token" => true]);
		$buffer->_html();

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}