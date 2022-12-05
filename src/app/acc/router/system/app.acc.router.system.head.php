<?php

namespace app\acc\router\system;

/**
 * @package app\acc\section
 * @author Ryno Van Zyl
 */
class head extends \mod\intf\router {

	//--------------------------------------------------------------------------------
	/**
	 * @param $buffer \mod\ui\set\system\buffer
	 * @param array $options
	 */
	public function run(&$buffer, $options = []) {

		$buffer->head_();
			$buffer->meta(["@charset" => "utf-8"]);
			$buffer->meta(["@name" => "viewport", "@content" => "width=device-width, initial-scale=1.0, shrink-to-fit=no"]);

			$buffer->title(["*" => \core::get_env("core.instance.title")]);

			$buffer->link(["@rel" => "shortcut icon", '@type' => 'image/x-icon', '@href' => \mod\http::get_img_stream("favicon.png")]);
			$buffer->link(["@rel" => "preconnect", "@href" => "https://fonts.googleapis.com"]);
			$buffer->link(["@rel" => "preconnect", "@href" => "https://fonts.gstatic.com", "@crossorigin" => true]);
			$buffer->link(["@rel" => "stylesheet", "@href" => "https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"]);

			$buffer->add(\mod\compiler\assets::make(["section" => "system"])->run()->get_stream_css());
			$buffer->script(["@src" => \mod\http::get_stream_url(ROOTPATH."/vendor/components/jquery/jquery.min.js")]);
		$buffer->_head();

	}
	//--------------------------------------------------------------------------------
}