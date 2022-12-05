<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 * svg library https://undraw.co/
 */
class svg extends \mod\intf\standard {

	/**
	 * @var \SVG\SVG
	 */
	protected $svg;

	protected $base_color = "#6c63ff";

	//--------------------------------------------------------------------------------
	public function __construct($options = []) {

		$this->svg = new \SVG\SVG();

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $src
	 * @return svg
	 * @throws \Exception
	 */
	public function load($name) {

		$filename = DIR_ASSETS."/svg/undraw/{$name}.svg";
		if(file_exists($filename)){
			return $this->from_file($filename);
		}


	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $src
	 * @return svg
	 * @throws \Exception
	 */
	public function from_file($src) {

		if(substr($src, 0, 1) == "!"){
			$src = str_replace(".svg", "", $src);
			$src = DIR_ASSETS."/svg/undraw/".substr($src, 1, strlen($src)).".svg";
		}

		if(!file_exists($src)) throw new \Exception("File not found");

		$file_contents = file_get_contents($src);

		$this->svg = \SVG\SVG::fromString($file_contents);

		return $this;

	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $from
	 * @param $to
	 * @return svg
	 */
	public function change_color($to, $from = false) {

		if(!$from) $from = $this->base_color;

		$doc = $this->svg->getDocument();
		for ($i = 0; $i < $doc->countChildren(); $i++) {
			$rect = $doc->getChild($i);
			if($from == $rect->getStyle('fill'))
				$rect->setStyle('fill', $to);
		}

		return $this;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param int $size
	 * @return $this
	 */
	public function set_size(int $size) {
		$this->set_width($size);
		$this->set_height($size);
		return $this;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param int $width
	 * @return svg
	 */
	public function set_width(int $width) {
		$this->svg->getDocument()->setWidth($width);
		return $this;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param int $height
	 * @return svg
	 */
	public function set_height(int $height) {
		$this->svg->getDocument()->setHeight($height);
		return $this;
	}
	//--------------------------------------------------------------------------------
	public function get(){
		return $this->build();
	}
	//--------------------------------------------------------------------------------
	public function build(){
		return $this->svg;
	}
	//--------------------------------------------------------------------------------
	public function stream(){
		echo $this->get();
	}
	//--------------------------------------------------------------------------------
}