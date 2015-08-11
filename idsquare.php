<?php
namespace Cerlestes\IdSquare;

use Exception;

class IdSquare {

	/**
	 * The default color palettes
	 * 
	 * @var array
	 */
	public static $COLORS = array(
		array(0x69D2E7, 0xA7DBD8, 0xE0E4CC, 0xF38630, 0xFA6900),
		array(0xE94C6F, 0x542733, 0x5A6A62, 0xC6D5CD, 0xFDF200),
		array(0xDB3340, 0xE8B71A, 0xF7EAC8, 0x1FDA9A, 0x28ABE3),
		array(0x588C73, 0xF2E394, 0xF2AE72, 0xD96459, 0x8C4646),
		array(0xD0C91F, 0x85C4B9, 0x008BBA, 0xDF514C, 0xA82F2D),
		array(0x00B3DB, 0x59C4C5, 0xFFC33C, 0xFBE2B4, 0xFF4C65),
		array(0x5E412F, 0xFCEBB6, 0x78C0A8, 0xF07818, 0xF0A830),
		array(0xB1EB00, 0x53BBF4, 0xFF85CB, 0xFF432E, 0xFFAC00),
		array(0x4298B5, 0xADC4CC, 0x92B06A, 0xE19D29, 0xDD5F32),
		array(0xFFA200, 0x00A03E, 0x24A8AC, 0x0087CB, 0x982395),
		array(0x260126, 0x59323C, 0xF2EEB3, 0xBFAF80, 0x8C6954),
		array(0x3B3A35, 0x20457C, 0x5E3448, 0xFB6648, 0xECDFBD),
		array(0xE45F56, 0xA3D39C, 0x7ACCC8, 0x4AAAA5, 0x35404F),
		array(0x83AA30, 0x1499D3, 0x4D6684, 0x3D3D3D, 0xE74700),
		array(0xCFF09E, 0xA8DBA8, 0x79BD9A, 0x3B8686, 0x0B486B),
		array(0x774F38, 0xE08E79, 0xF1D4AF, 0xECE5CE, 0xC5E0DC),
		array(0xE8DDCB, 0xCDB380, 0x036564, 0x033649, 0x031634),
		array(0x490A3D, 0xBD1550, 0xE97F02, 0xF8CA00, 0x8A9B0F),
		array(0xD9CEB2, 0x948C75, 0xD5DED9, 0x7A6A53, 0x99B2B7),
		array(0x343838, 0x005F6B, 0x008C9E, 0x00B4CC, 0x00DFFC),
		array(0x99B898, 0xFECEA8, 0xFF847C, 0xE84A5F, 0x2A363B),
		array(0x413E4A, 0x73626E, 0xB38184, 0xF0B49E, 0xF7E4BE),
		array(0x554236, 0xF77825, 0xD3CE3D, 0xF1EFA5, 0x60B99A),
		array(0xFF4E50, 0xFC913A, 0xF9D423, 0xEDE574, 0xE1F5C4),
		array(0xFF4E50, 0xFC913A, 0xF9D423, 0xEDE574, 0xE1F5C4),
		array(0xD0DD2B, 0x98C73D, 0x00A9E0, 0x67CDDC, 0x3B3B3D),
		array(0xD0D102, 0xD70060, 0xE54028, 0xF18D05, 0x616161),
		array(0xE9F2B2, 0xEAA753, 0xBF87F3, 0x53E2EE, 0xD5126F),
		array(0xEAA753, 0xF3E88F, 0xFFF4E6, 0x869445, 0x84CEBF),
		array(0x164469, 0x729E31, 0xE0E03A, 0xE35D83, 0x87294A),
		array(0x40FB0E, 0x10C582, 0x06A2F5, 0x043266, 0x442AB2),
		array(0xF1EACD, 0xDED4B0, 0xD1B37D, 0x4394B2, 0x061326),
		array(0x4DB566, 0x14AFB6, 0x600876, 0x1E74B8, 0xBE2511),
		array(0xE6C78D, 0x306D3C, 0x1F4927, 0x7D8E80, 0x8A2214),
		array(0x83AF9B, 0xF16A83, 0xF9CDAD, 0xFC9D9A, 0x747462),
		array(0x042360, 0xFFC344, 0xFFF26B, 0xC1CEFF, 0x424244),
		array(0xFFBEE7, 0x70EABA, 0xFB4D36, 0xDF008D, 0xFFFFFF),
		array(0xFFFFFF, 0x768727, 0x8E7153, 0x201F1D, 0x323D12),
		array(0x481B5C, 0x4258FF, 0x0DC6FF, 0xADFFB8, 0xFFFAD1),
		array(0xF0F7FF, 0xD4D4FF, 0xB498F5, 0x9215D1, 0x21011B),
		array(0x3F4245, 0x784E5D, 0xD97E16, 0xFFB60D, 0xFFEF5C),
		array(0x10DAE8, 0xB8FF96, 0xDFFA11, 0xFFE603, 0xFFAB03),
		array(0x42FF8B, 0x90E53B, 0xE9FF42, 0xFFD642, 0xFFA742),
		array(0xBA0D66, 0xFC685B, 0xFCAE77, 0xFFEFBF, 0x0CE8F7),
		array(0x393042, 0x0A7AC4, 0x0CC3FA, 0x62E6F0, 0xDAEDDC),
		array(0xC2B4D1, 0x77C3E6, 0x3B9AFF, 0x0A64FF, 0x060017),
		array(0xD1ADF7, 0xF7CCAD, 0xFFA187, 0xFC6868, 0xFF406C),
		array(0x493B20, 0x2B5E33, 0x94AA23, 0xEFD816, 0xE3D9BE),
		array(0x210D21, 0xBF0867, 0xFF6524, 0xFFB45E, 0xFFF9C7),
		array(0x9074AB, 0xF1FF8A, 0x3A3142, 0xC25334, 0xC29A34),
		array(0x91C026, 0xCF8170, 0x976584, 0x703968, 0x4B0A13),
		array(0x0A8CF0, 0x74BACC, 0xE8D5CF, 0xF29D9D, 0xFF4596),
		array(0xF0ECDD, 0xFCBB9A, 0xFF7D63, 0xAB3F61, 0x08A5CC),
		array(0xF7EAB0, 0xFA8B1B, 0xD96F66, 0x625875, 0x003A78),
		array(0x9BBACF, 0x8AD1F2, 0xEBFEFF, 0xFFE9A8, 0xFFB057),
		array(0xEEEF84, 0xB9EF7D, 0x91EFD0, 0x91A6EF, 0xEC9BEF),
		array(0x2985CE, 0x57A9B4, 0x4A222A, 0xD2CECB, 0x6D5A32),
		array(0x3B4310, 0x6A7107, 0xC5C2BD, 0x87A7B2, 0x3B595B),
		array(0xBEB8C2, 0xDBCBB8, 0xEDBA9A, 0xFF8A78, 0xFF4782),
		array(0x587593, 0x9D886D, 0x575B66, 0xFEFEFE, 0xBFCBE3),
		array(0xFFD300, 0x989105, 0xEDE9EA, 0xFFAB63, 0xFF5827),
		array(0xFFF06B, 0xFFCE6B, 0xFF976B, 0xA65B6D, 0x0F82BF),
		array(0xA12323, 0xFF5757, 0xF2E67C, 0xA5CC52, 0x2B2740),
		array(0xB4ACBD, 0xD53141, 0x831010, 0xFFFFFF, 0xEE4131, 0xDED5D5, 0xFF835A, 0xFFAC9C),
		array(0xACACCD, 0x414183, 0x7383AC, 0x189C94, 0xBD314A, 0xEEEEFF, 0x396A94, 0xFF5241),
		array(0xFFFFFF, 0xC5C5D5, 0xE6E6EE, 0xF6D5B4, 0x523910, 0x525239, 0xC59C4A, 0x8B836A),
		array(0x735A8B, 0xC5BDEE, 0x4A3962, 0xCD4A20, 0xFF7B41, 0x7B2010, 0x6A6A6A, 0xFFFFFF),
		array(0x9CD54A, 0x4A5A20, 0x7394A4, 0x5A6A83, 0xC5E67B, 0x94B4C5, 0x29394A, 0xFFFFFF),
		array(0x5283C5, 0xFFFFFF, 0xD5D5DE, 0xBDBDBD, 0x183973, 0x525252, 0x8BA4E6, 0x7B7B7B),
		array(0xC5CD83, 0x836A20, 0x5A3900, 0xB49452, 0xBD7318, 0xF6B441, 0x009C20, 0x41DE41, 0xD5D5D5, 0xFFFFFF),
		array(0x62D5B4, 0x83EEC5, 0x184A4A, 0x73AC31, 0x317373, 0xBDFF73, 0xA4D541, 0xAC0031, 0xFF6A62, 0xEE2039),
		array(0xC5A47B, 0x524110, 0xDECD94, 0xFFFF94, 0x8B9462, 0x6A6A52, 0xA4AC7B, 0xD5BD83, 0xCDCDCD, 0xFFFFFF),
		array(0xEEAC41, 0x6A3908, 0x9C2920, 0xDE5A52, 0xFFFFFF, 0x5A5A62, 0x945A08, 0xFFE67B, 0xEE9C8B, 0x8B8B94),
		array(0xD5D5DE, 0xD54110, 0x52525A, 0xEE7B41, 0xFFC57B, 0x8B8B94, 0xEEEEEE, 0xAC1000, 0xAC5273, 0xF6838B),
		array(0xBD4A29, 0x732000, 0xBD735A, 0xDE7329, 0x835231, 0x5A3100, 0xF6BD7B, 0xA47341, 0xFFE6B4, 0xFFDE94),
		array(0x5ACDBD, 0x317B52, 0x104A39, 0xD5415A, 0x10414A, 0x7BD573, 0xFF7B7B, 0x83E6D5, 0x7B3129, 0x62AC5A),
		array(0x73A4A4, 0x5A7B6A, 0xACD5C5, 0x294A52, 0x6A5220, 0xAC9C5A, 0xB40000, 0xCDBD62, 0xEE5252, 0xEEE68B),
		array(0xACACD5, 0x735294, 0x524173, 0x9462CD, 0x31186A, 0xCDCDE6, 0x832041, 0xE68B9C, 0xCD394A, 0xAC83DE),
		array(0xEED56A, 0xF6EE94, 0xD5A4DE, 0xA46AB4, 0x8B52AC, 0x62317B, 0xC5B429, 0xDEDEDE, 0xA42000, 0xD5CD6A),
		array(0xC5395A, 0x8BD5EE, 0xFF6262, 0xEEAC9C, 0x085A73, 0x08ACD5, 0xF6D5C5, 0xFFFFFF, 0x5ABDE6, 0x7B2941),
		array(0x8BB4A4, 0xD5F6DE, 0x524A4A, 0xFFFFFF, 0x8B8B8B, 0x5A8362, 0xB4D5BD, 0x52CDF6, 0xFF8B4A, 0x2983AC),
	);

	/**
	 * The string to generate the identicon for
	 * 
	 * @var string
	 */
	protected $subject;

	/**
	 * The subject's hash as an integer-array
	 * 
	 * @var array
	 */
	protected $hash;

	/**
	 * The color palettes to be used
	 * 
	 * @var array
	 */
	protected $colors;



	/**
	 * Instantiates IdSquare
	 * 
	 * @param  string $subject  The string to generate the identicon for
	 * @param  array  $colors   The color palettes to be used
	 */
	public function __construct($subject, $colors = null) {
		if(!is_string($subject)) {
			throw new Exception("IdSquare::__construct(): The given subject must be a string!", 1425896254);
		}

		$this->setSubject($subject);
		$this->setColors($colors ?: self::$COLORS);
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
		$this->colors = $colors;
	}



	/**
	 * Generates an identicon for the given string
	 * 
	 * @param  int $size  The identicon's width and height in pixels
	 * @return resource
	 */
	public function generate($size = 128) {
		if(!is_int($size) || ($size % 2) == 1) {
			throw new Exception("IdSquare::generate(): The given size must be an integer and a multiple of two!", 1425896317);
		}

		$hash = $this->getHash();
		$colors = $this->getColors();

		if(!$hash || count($hash) != 20) {
			throw new Exception("IdSquare::generate(): The hash property must be exactly 20 bytes long!", 1425905694);
		}

		if(!$colors || !count($colors)) {
			throw new Exception("IdSquare::generate(): The colors property must contain at least one palette-array!", 1425905738);
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

		// Cut out the area that we want
		$padding = ($size / 5);
		$output = imagecreatetruecolor($size, $size);
		imagecopyresampled($output, $image, 0, 0, $padding, $padding, $size, $size, (($size * 2) - $padding), (($size * 2) - $padding));

		return $output;
	}

	/**
	 * Generates an identicon for the given string and outputs it directly
	 * 
	 * @param  boolean $setContentTypeHeader  Whether or not to also set the "Content-Type" header to "image/png"
	 * @param  int     $size                  The identicon's width and height in pixels
	 * @return void
	 */
	public function generateAndOutput($setContentTypeHeader = true, $size = 128) {
		$image = $this->generate($size);

		if ($setContentTypeHeader) {
			header('Content-Type: image/png');
		}

		imagepng($image);
		imagedestroy($image);
	}

	/**
	 * Generates an identicon for the given string and returns its Base64 representation
	 * 
	 * @param  boolean $asDataUrl  Whether or not to wrap the Base64 string in a "data:" scheme
	 * @param  int     $size       The identicon's width and height in pixels
	 * @return string
	 */
	public function generateAsBase64($asDataUrl = true, $size = 128) {
		ob_start();
		$this->generateAndOutput(false, $size);
		$image = ob_get_contents();
		ob_end_clean();

		if ($asDataUrl) {
			return "data:image/png;base64," . base64_encode($image);
		} else {
			return base64_encode($image);
		}
	}

}

/**
 * Functional way to create an identicon for the given string
 * 
 * @param  int $size  The identicon's width and height in pixels
 * @return resource
 */
function generate($subject, $size = 128) {
	return (new IdSquare($subject))->generate($size);
}

/**
 * Functional way to create an identicon for the given string and output it directly (incl. setting up the Content-Type HTTP header)
 * 
 * @param  int $size  The identicon's width and height in pixels
 * @return void
 */
function output($subject, $size = 128) {
	(new IdSquare($subject))->generateAndOutput(true, $size);
}