<?php

namespace mod;

/**
 * @package mod
 * @author Ryno Van Zyl
 */
class img extends \mod\intf\standard {

	protected $lib;
	protected $src;
	protected $image_info;
	protected $dest;
	//--------------------------------------------------------------------------------
	public function __construct($options = []) {

		$options = array_merge([
		    "src" => false,
		    "dest" => false,
		], $options);

		$this->lib = \Config\Services::image();

		if($options["src"]) $this->src = $options["src"];
		if($options["dest"]) $this->dest = $options["dest"];
	}
	//--------------------------------------------------------------------------------
	public function get_width() {
		return isset($this->image_info[0]) ? $this->image_info[0] : 0;
	}
	//--------------------------------------------------------------------------------
	public function get_height() {
		return isset($this->image_info[1]) ? $this->image_info[1] : 0;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $name
	 * @param $arguments
	 * @return false|mixed|\CodeIgniter\Images\Handlers\BaseHandler
	 */
	public function __call($name, $arguments) {
		return call_user_func_array([$this->lib, $name], $arguments);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param $width
	 * @param $height
	 * @param array $options [age_on_date] - [ top-left, top, top-right, left, center, right, bottom-left, bottom, bottom-right];
	 * @return \CodeIgniter\Images\Handlers\BaseHandler
	 */
	public function fit($width, $height, $options = []) {

		$options = array_merge([
		    "position" => "center"
		], $options);

        return $this->lib->fit($width, $height, $options["position"]);
	}
	//--------------------------------------------------------------------------------

	/**
	 * Resize the image
	 *
	 * @param integer $width
	 * @param integer $height
	 * @param boolean $maintainRatio If true, will get the closest match possible while keeping aspect ratio true.
	 * @param string $masterDim
	 * @return \CodeIgniter\Images\Handlers\BaseHandler
	 */
	public function resize(int $width, int $height, $options = []) {

		$options = array_merge([
		    "maintainRatio" => true,
		    "masterDim" => "auto",
		], $options);

		return $this->lib->resize($width, $height, $options["maintainRatio"], $options["masterDim"]);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param int $width
	 * @param array $options
	 * @return \CodeIgniter\Images\Handlers\BaseHandler
	 */
	public function resize_to_width(int $width, $options = []) {

		$options = array_merge([
		    "maintainRatio" => false,
		    "masterDim" => "auto",
		], $options);

		$ratio = $width / $this->get_width();
        $height = round($this->get_height() * $ratio);

		return $this->lib->resize($width, $height, $options["maintainRatio"], $options["masterDim"]);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param int $height
	 * @param array $options
	 * @return \CodeIgniter\Images\Handlers\BaseHandler
	 */
	public function resize_to_height(int $height, $options = []) {

		$options = array_merge([
		    "maintainRatio" => false,
		    "masterDim" => "auto",
		], $options);

		$ratio = $height / $this->get_height();
        $width = round($this->get_width() * $ratio);

		return $this->lib->resize($width, $height, $options["maintainRatio"], $options["masterDim"]);
	}
	//--------------------------------------------------------------------------------

	public function max_area(int $width, int $height, $options = []) {

		$options = array_merge([
		    "maintainRatio" => true,
		    "masterDim" => "auto",
		    "multiplier" => 1,
		], $options);


		$dest = $this->dest;
		$temp = dirname($this->dest)."/temp_".basename($this->dest);

		$this->set_dest($temp);
		if($width > $height) $this->resize_to_width(($width * $options["multiplier"]));
		else $this->resize_to_height(($height * $options["multiplier"]));
		$this->save();

		$this->set_src($temp);
		$this->set_dest($dest);
		$this->reorient();

		//center
		$x = floor(($this->get_width() - $width) / 2);
		$y = floor(($this->get_height() - $height) / 2);

		$result = $this->crop($width, $height, $x, $y);

		@unlink($temp);
		return $result;
	}
	//--------------------------------------------------------------------------------

	/**
	 * Crops the image to the desired height and width. If one of the height/width values
	 * is not provided, that value will be set the appropriate value based on offsets and
	 * image dimensions.
	 *
	 * @param integer|null $width
	 * @param integer|null $height
	 * @param integer|null $x X-axis coord to start cropping from the left of image
	 * @param integer|null $y Y-axis coord to start cropping from the top of image
	 * @param array $options
	 * @return \CodeIgniter\Images\Handlers\BaseHandler
	 */
	public function crop(int $width = null, int $height = null, int $x = null, int $y = null, $options = []) {

		$options = array_merge([
		    "maintainRatio" => false,
		    "masterDim" => "auto",
		], $options);

        return $this->lib->crop($width, $height, $x, $y, $options["maintainRatio"], $options["masterDim"]);
	}
	//--------------------------------------------------------------------------------
	/**
	 * Reads the EXIF information from the image and modifies the orientation
	 * so that displays correctly in the browser. This is especially an issue
	 * with images taken by smartphones who always store the image up-right,
	 * but set the orientation flag to display it correctly.
	 *
	 * @param boolean $silent If true, will ignore exceptions when PHP doesn't support EXIF.
	 *
	 * @return \CodeIgniter\Images\Handlers\BaseHandler
	 */
	public function reorient(bool $silent = false){
		return $this->lib->reorient();
	}
	//--------------------------------------------------------------------------------

	/**
	 * Rotates the image on the current canvas.
	 * @param $angle
	 * @param array $options
	 * @return \CodeIgniter\Images\Handlers\BaseHandler
	 */
	public function rotate($angle, $options = []) {

        return $this->lib->rotate($angle);
	}
	//--------------------------------------------------------------------------------
	public function save($options = []) {

		$options = array_merge([
		    "position" => "center"
		], $options);

		if(!$this->src) throw new \Exception("src cannot be empty");
		if(!$this->dest) throw new \Exception("dest cannot be empty");

        $this->lib->save($this->dest);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param mixed $dest
	 */
	public function set_dest($dest): void {
		$this->dest = $dest;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param mixed $src
	 */
	public function set_src($src): void {
		$this->src = $src;
		$this->lib->withFile($this->src);
		$this->image_info = getimagesize($this->src);
	}
	//--------------------------------------------------------------------------------
}