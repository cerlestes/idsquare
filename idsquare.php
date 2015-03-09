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
		$this->colors = ($colors) ?: array(
			array(0x69D2E7, 0xA7DBD8, 0xE0E4CC, 0xF38630, 0xFA6900),
			array(0xE94C6F, 0x542733, 0x5A6A62, 0xC6D5CD, 0xFDF200),
			array(0xDB3340, 0xE8B71A, 0xF7EAC8, 0x1FDA9A, 0x28ABE3),
			array(0x588C73, 0xF2E394, 0xF2AE72, 0xD96459, 0x8C4646),
			array(0xD0C91F, 0x85C4B9, 0x008BBA, 0xDF514C, 0xA82F2D),
			array(0x00B3DB, 0x59C4C5, 0xFFC33C, 0xFBE2B4, 0xFF4C65),
			array(0x5E412F, 0xFCEBB6, 0x78C0A8, 0xF07818, 0xF0A830),
			array(0xB1EB00, 0x53BBF4, 0xFF85CB, 0xFF432E, 0xFFAC00),
			array(0x4298B5, 0xADC4CC, 0x92B06A, 0xE19D29, 0xDD5F32),
			array(0xBCCF02, 0x5BB12F, 0x73C5E1, 0x9B539C, 0xEB65A0),
			array(0xFFA200, 0x00A03E, 0x24A8AC, 0x0087CB, 0x982395),
			array(0x260126, 0x59323C, 0xF2EEB3, 0xBFAF80, 0x8C6954),
			array(0x3B3A35, 0x20457C, 0x5E3448, 0xFB6648, 0xECDFBD),
			array(0xE45F56, 0xA3D39C, 0x7ACCC8, 0x4AAAA5, 0x35404F),
			array(0x83AA30, 0x1499D3, 0x4D6684, 0x3D3D3D, 0xE74700),
			array(0xCFF09E, 0xA8DBA8, 0x79BD9A, 0x3B8686, 0x0B486B),
			array(0x774F38, 0xE08E79, 0xF1D4AF, 0xECE5CE, 0xC5E0DC),
			array(0xE8DDCB, 0xCDB380, 0x036564, 0x033649, 0x031634),
			array(0x490A3D, 0xBD1550, 0xE97F02, 0xF8CA00, 0x8A9B0F),
			array(0x00A0B0, 0x6A4A3C, 0xCC333F, 0xEB6841, 0xEDC951),
			array(0xD9CEB2, 0x948C75, 0xD5DED9, 0x7A6A53, 0x99B2B7),
			array(0x343838, 0x005F6B, 0x008C9E, 0x00B4CC, 0x00DFFC),
			array(0x99B898, 0xFECEA8, 0xFF847C, 0xE84A5F, 0x2A363B),
			array(0x413E4A, 0x73626E, 0xB38184, 0xF0B49E, 0xF7E4BE),
			array(0x554236, 0xF77825, 0xD3CE3D, 0xF1EFA5, 0x60B99A),
			array(0xFF4E50, 0xFC913A, 0xF9D423, 0xEDE574, 0xE1F5C4)
		);
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

		if(!$hash || count($hash) != 20) {
			throw new Exception("IdSquare::generate(): The hash property must be exactly 20 bytes long!", 1425905694);
		}

		if(!$colors || !count($colors)) {
			throw new Exception("IdSquare::generate(): The colors property must contain at least one palette of colors!", 1425905738);
		}

		// Pick a random color palette, reduce it to 4 colors and shuffle it
		$colors = $colors[ $hash[0] % count($colors) ];
		$colors = array_slice($colors, max(0, (($hash[1] % count($colors)) - 4)), 4);
		$hashSlice = array_slice($hash, 2, 4);
		array_multisort($hashSlice, $colors);

		// Create image resource
		$image = @imagecreatetruecolor(($size * 2), ($size * 2));

		if(!$image || !is_resource($image)) {
			throw new Exception("IdSquare::generate(): GDlib returned bad value! Is GDlib correctly installed and available?", 1425901398);
		}

		// Draw the squares onto the image
		for($ih = 0; $ih < 2; $ih++) {
			for($iv = 0; $iv < 2; $iv++) {
				
				$color = $colors[ ($iv * 2 + $ih) ];
				$left = floor($ih * $size);
				$right = floor(($ih + 1) * $size);
				$top = floor($iv * $size);
				$bottom = floor(($iv + 1) * $size);

				$allocated = imagecolorallocate($image, ($color >> 16 & 0xFF), ($color >> 8 & 0xFF), ($color & 0xFF));
				imagefilledrectangle($image, $left, $top, $right, $bottom, $allocated);

			}
		}

		// Rotate the image randomly first, then in a nice angle
		$image = imagerotate($image, (($hash[10] % 4) * 90), 0);
		$image = imagerotate($image, 5, 0);

		// Crop out the area that we want
		$padding = ($size / 5);
		$output = imagecreatetruecolor($size, $size);
		imagecopyresampled($output, $image, 0, 0, $padding, $padding, $size, $size, (($size * 2) - $padding), (($size * 2) - $padding));

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