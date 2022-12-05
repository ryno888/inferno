<?php

namespace mod\ui\set\system;

/**
 * @package mod\ui\set\system
 * @author Ryno Van Zyl
 */
class page_loader extends \mod\ui\intf\component {

	public $color_1 = '#82f900';
	public $color_2 = '#ffeb00';
	public $color_3 = '#ff005e';

	//--------------------------------------------------------------------------------
	// magic
	//--------------------------------------------------------------------------------
	protected function __construct($options = []) {
		// init
		$this->name = "Page Loader";
	}
	//--------------------------------------------------------------------------------
	public function build($options = []) {

		$options = array_merge([
		], $options);

		$buffer = \mod\ui::make()->buffer();
		$buffer->style(["*" => "
			.page-loader-overlay {
				position: fixed; /* Sit on top of the page content */
				width: 100%; /* Full width (cover the whole page) */
				height: 100%; /* Full height (cover the whole page) */
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-color: rgba(0,0,0,0.8); /* Black background with opacity */
				z-index: 1060;
				cursor: pointer; /* Add a pointer on hover */
			}
			.page-loader-wrapper {
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				z-index: 1061;
			}
			.page-loader-wrapper .page-loader {
				display: block;
				position: relative;
				left: 50%;
				top: 50%;
				width: 80px;
				height: 80px;
				margin: -75px 0 0 -75px;
				border-radius: 50%;
				border: 3px solid transparent;
				border-top-color: {$this->color_1};
				-webkit-animation: spin 2s linear infinite;
				animation: spin 2s linear infinite;
			}
			.page-loader-wrapper .page-loader:before {
				content: '';
				position: absolute;
				top: 5px;
				left: 5px;
				right: 5px;
				bottom: 5px;
				border-radius: 50%;
				border: 3px solid transparent;
				border-top-color: {$this->color_2};
				-webkit-animation: spin 3s linear infinite;
				animation: spin 3s linear infinite;
			}
			.page-loader-wrapper .page-loader:after {
				content: '';
				position: absolute;
				top: 15px;
				left: 15px;
				right: 15px;
				bottom: 15px;
				border-radius: 50%;
				border: 3px solid transparent;
				border-top-color: {$this->color_3};
				-webkit-animation: spin 1.5s linear infinite;
				animation: spin 1.5s linear infinite;
			}
			@-webkit-keyframes spin {
				0%   {
					-webkit-transform: rotate(0deg);
					-ms-transform: rotate(0deg);
					transform: rotate(0deg);
				}
				100% {
					-webkit-transform: rotate(360deg);
					-ms-transform: rotate(360deg);
					transform: rotate(360deg);
				}
			}
			@keyframes spin {
				0%   {
					-webkit-transform: rotate(0deg);
					-ms-transform: rotate(0deg);
					transform: rotate(0deg);
				}
				100% {
					-webkit-transform: rotate(360deg);
					-ms-transform: rotate(360deg);
					transform: rotate(360deg);
				}
			}
		"]);

		$buffer->div([".page-loader-overlay" => true]);
		$buffer->div_([".page-loader-wrapper" => true]);
			$buffer->div([".page-loader" => true]);
		$buffer->_div();

		\mod\js::add_script("
			$(function(){
				app.overlay.hide();
			});
		");

		return $buffer->build();

	}
	//--------------------------------------------------------------------------------
}