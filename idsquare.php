<?php
namespace Cerlestes\IdSquare;

use Exception;

class IdSquare {

	/**
	 * The string to generate the identicon for
	 * 
	 * @var string
	 */
	protected $subject;

	/**
	 * The subject's hash
	 * 
	 * @var array
	 */
	protected $hash;

	/**
	 * The color palette to be used
	 * 
	 * @var array
	 */
	protected $colors;



	/**
	 * Instantiates IdSquare
	 * 
	 * @param  string $subject  The string to generate the identicon for
	 * @param  array $colors  The color palette to be used
	 */
	public function __construct($subject, $colors = null) {
		if(!is_string($subject)) {
			throw new Exception("IdSquare::__construct(): The given subject must be a string!", 1425896254);
		}

		$this->setSubject($subject);
		$this->setColors($colors);
	}

	/**
	 * Returns the subject property
	 * 
	 * @return string
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Sets the subject and hash properties
	 * 
	 * @param  string $subject
	 * @return void
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
		$this->hash = array();

		for($sha1 = sha1($subject, true), $i = 0; $i < 20; $i++) {
			$this->hash[$i] = unpack("C", $sha1[$i])[1];
		}
	}

	/**
	 * Returns the hash property
	 * 
	 * @return array
	 */
	public function getHash() {
		return $this->hash;
	}

	/**
	 * Returns the colors property
	 * 
	 * @return array
	 */
	public function getColors() {
		return $this->colors;
	}

	/**
	 * Returns the colors property
	 * 
	 * @param  array $colors
	 * @return void
	 */
	public function setColors($colors) {
		$this->colors = ($colors) ?: array(0xFFFFFF, 0xD24D57, 0xF22613, 0xD91E18, 0x96281B, 0xEF4836, 0xD64541, 0xC0392B, 0xCF000F, 0xE74C3C, 0xDB0A5B, 0xF64747, 0xD2527F, 0xE08283, 0xF62459, 0xE26A6A, 0x663399, 0x674172, 0xAEA8D3, 0x913D88, 0x9A12B3, 0xBF55EC, 0xBE90D4, 0x8E44AD, 0x9B59B6, 0xE4F1FE, 0x4183D7, 0x59ABE3, 0x81CFE0, 0x52B3D9, 0xC5EFF7, 0x22A7F0, 0x3498DB, 0x2C3E50, 0x19B5FE, 0x336E7B, 0x22313F, 0x6BB9F0, 0x1E8BC3, 0x3A539B, 0x34495E, 0x67809F, 0x2574A9, 0x1F3A93, 0x89C4F4, 0x4B77BE, 0x5C97BF, 0xA2DED0, 0x87D37C, 0x90C695, 0x26A65B, 0x03C9A9, 0x68C3A3, 0x65C6BB, 0x1BBC9B, 0x1BA39C, 0x66CC99, 0x36D7B7, 0xC8F7C5, 0x86E2D5, 0x2ECC71, 0x16a085, 0x3FC380, 0x019875, 0x03A678, 0x4DAF7C, 0x2ABB9B, 0x00B16A, 0x1E824C, 0x049372, 0x26C281, 0xFDE3A7, 0xF89406, 0xEB9532, 0xE87E04, 0xF4B350, 0xF2784B, 0xEB974E, 0xF5AB35, 0xD35400, 0xF39C12, 0xF9690E, 0xF9BF3B, 0xF27935, 0xE67E22, 0xECECEC, 0x6C7A89, 0xBDC3C7, 0xECF0F1, 0x95A5A6, 0xDADFE1, 0xABB7B7, 0xF2F1EF);
	}



	/**
	 * Generates an identicon for the given string
	 * 
	 * @param  int $size  The identicon's width and height in pixels
	 * @return resource
	 */
	public function generate($size = 128) {
		if(!is_int($size)) {
			throw new Exception("IdSquare::generate(): The given size must be an integer!", 1425896317);
		}

		$hash = $this->getHash();
		$colors = $this->getColors();
		$colorsCount = count($colors);
		$sizeInteral = ($size * 2);

		if(!$hash || count($hash) != 20) {
			throw new Exception("IdSquare::generate(): The hash property must be exactly 20 bytes long!", 1425905694);
		}

		if(!$colors || count($colors) < 9) {
			throw new Exception("IdSquare::generate(): The colors property must contain at least 9 colors!", 1425905738);
		}

		// Read config from hash
		$cfgColors = array_slice($hash, 0, 9);
		$cfgSquares = 2;
		$cfgAngle = 5;

		// Make sure colors are unique
		foreach($cfgColors as $i => $value) {
			$color = ($cfgColors[$i] % $colorsCount);

			while(in_array($color, $cfgColors)) {
				$color = (($color + 1) % $colorsCount);
			}

			$cfgColors[$i] = $color;
		}

		// Create our image resource
		$image = @imagecreatetruecolor($sizeInteral, $sizeInteral);

		if(!$image || !is_resource($image)) {
			throw new Exception("IdSquare::generate(): GDlib returned bad value! Is GDlib correctly installed and available?", 1425901398);
		}

		// Draw the image
		for($ih = 0; $ih < $cfgSquares; $ih++) {
			for($iv = 0; $iv < $cfgSquares; $iv++) {
				
				$left = floor($ih * ($sizeInteral / $cfgSquares));
				$right = floor(($ih + 1) * ($sizeInteral / $cfgSquares));
				$top = floor($iv * ($sizeInteral / $cfgSquares));
				$bottom = floor(($iv + 1) * ($sizeInteral / $cfgSquares));
				$color = $colors[ $cfgColors[ ($iv * 3 + $ih) ] ];

				$allocated = imagecolorallocate($image, ($color >> 16 & 0xFF), ($color >> 8 & 0xFF), ($color & 0xFF));
				imagefilledrectangle($image, $left, $top, $right, $bottom, $allocated);

			}
		}

		// Rotate the image
		$image = imagerotate($image, $cfgAngle, 0);

		// Crop out the area that we want
		$padding = ($sizeInteral / 10);
		$output = imagecreatetruecolor($size, $size);
		imagecopyresampled($output, $image, 0, 0, $padding, $padding, $size, $size, ($sizeInteral - $padding), ($sizeInteral - $padding));

		return $output;
	}

	/**
	 * Generates an identicon for the given string and outputs it directly (incl. setting up headers)
	 * 
	 * @param  int $size  The identicon's width and height in pixels
	 * @return void
	 */
	public function generateAndOutput($size = 128) {
		$image = $this->generate($size);

		header('Content-Type: image/png');

		imagepng($image);
		imagedestroy($image);
	}

}

/**
 * @FIXME
 */
function generate($subject, $size = 128) {
	return (new IdSquare($subject))->generate($size);
}

/**
 * @FIXME
 */
function output($subject, $size = 128) {
	(new IdSquare($subject))->generateAndOutput($size);
}