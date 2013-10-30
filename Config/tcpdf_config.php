<?php
/*
 * @todo: re-evaluate default values of: 
 * K_PATH_URL, K_PATH_FONTS, K_PATH_CACHE, K_TCPDF_CALLS_IN_HTML,
 * PDF_HEADER_*, K_BLANK_IMAGE
 * 
 * @todo: use Configure class
 * @todo: make k_path_url configurable
 */
$k_path_main = App::pluginPath('Tcpdf').'Vendor'.DS.'tcpdf'.DS;
$k_path_url = Router::url('/files/pdf/',true);
$tcpdfConfig = array(
	/**
	 * If the constant K_TCPDF_EXTERNAL_CONFIG is defined, the built-in config won't be loaded
	 */
	'K_TCPDF_EXTERNAL_CONFIG' => TRUE,

	/**
	 * Installation path (/var/www/tcpdf/).
	 * By default it is automatically calculated but you can also set it as a fixed string to improve performances.
	 */
	'K_PATH_MAIN' => $k_path_main,

	/**
	 * URL path to tcpdf installation folder (http://localhost/tcpdf/).
	 * By default it is automatically calculated but you can also set it as a fixed string to improve performances.
	 */
	'K_PATH_URL' => $k_path_url, //TODO

	/**
	 * path for PDF fonts
	 * use K_PATH_MAIN.'fonts/old/' for old non-UTF8 fonts
	 */
	'K_PATH_FONTS' =>  $k_path_main.'fonts'.DS,
	
	/**
	 * cache directory for temporary files (full path)
	*/
	//'K_PATH_CACHE' =>  K_PATH_MAIN.'cache/',
	'K_PATH_CACHE' =>  CACHE.'tcpdf'.DS,
	
	/**
	 * cache directory for temporary files (url path)
	*/
	'K_PATH_URL_CACHE' =>  $k_path_url.'cache/',
	
	/**
	 *images directory
	*/
	//'K_PATH_IMAGES' =>  K_PATH_MAIN.'images/',
	'K_PATH_IMAGES' =>  IMAGES ,
	
	/**
	 * blank image
	*/
	'K_BLANK_IMAGE' =>  IMAGES.'tcpdf'.DS.'_blank.png',
	
	/**
	 * page format
	*/
	'PDF_PAGE_FORMAT' =>  'A4',
	
	/**
	 * page orientation (P=portrait, L=landscape)
	*/
	'PDF_PAGE_ORIENTATION' =>  'P',
	
	/**
	 * document creator
	*/
	'PDF_CREATOR' =>  'CakeTcpdf',
	
	/**
	 * document author
	*/
	'PDF_AUTHOR' =>  'CakeTcpdf',
	
	/**
	 * header title
	*/
	'PDF_HEADER_TITLE' =>  'Cake TCPDF Example',
	
	/**
	 * header description string
	*/
	'PDF_HEADER_STRING' =>  "Hello Cake TCPDF!",
	
	/**
	 * image logo
	*/
	'PDF_HEADER_LOGO' =>  'logo.png',
	
	/**
	 * header logo image width [mm]
	*/
	'PDF_HEADER_LOGO_WIDTH' =>  30,
	
	/**
	 *  document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch]
	*/
	'PDF_UNIT' =>  'mm',
	
	/**
	 * header margin
	*/
	'PDF_MARGIN_HEADER' =>  5,
	
	/**
	 * footer margin
	*/
	'PDF_MARGIN_FOOTER' =>  10,
	
	/**
	 * top margin
	*/
	'PDF_MARGIN_TOP' =>  25,
	
	/**
	 * bottom margin
	*/
	'PDF_MARGIN_BOTTOM' =>  25,
	
	/**
	 * left margin
	*/
	'PDF_MARGIN_LEFT' =>  15,
	
	/**
	 * right margin
	*/
	'PDF_MARGIN_RIGHT' =>  15,
	
	/**
	 * default main font name
	*/
	'PDF_FONT_NAME_MAIN' =>  'helvetica',
	
	/**
	 * default main font size
	*/
	'PDF_FONT_SIZE_MAIN' =>  10,
	
	/**
	 * default data font name
	*/
	'PDF_FONT_NAME_DATA' =>  'helvetica',
	
	/**
	 * default data font size
	*/
	'PDF_FONT_SIZE_DATA' =>  8,
	
	/**
	 * default monospaced font name
	*/
	'PDF_FONT_MONOSPACED' =>  'courier',
	
	/**
	 * ratio used to adjust the conversion of pixels to user units
	*/
	'PDF_IMAGE_SCALE_RATIO' =>  1.25,
	
	/**
	 * magnification factor for titles
	*/
	'HEAD_MAGNIFICATION' =>  1.1,
	
	/**
	 * height of cell respect font height
	*/
	'K_CELL_HEIGHT_RATIO' =>  1.25,
	
	/**
	 * title magnification respect main font size
	*/
	'K_TITLE_MAGNIFICATION' =>  1.3,
	
	/**
	 * reduction factor for small font
	*/
	'K_SMALL_RATIO' =>  2/3,
	
	/**
	 * set to true to enable the special procedure used to avoid the overlappind of symbols on Thai language
	*/
	'K_THAI_TOPCHARS' =>  true,
	
	/**
	 * if true allows to call TCPDF methods using HTML syntax
	 * IMPORTANT: For security reason, disable this feature if you are printing user HTML content.
	*/
	'K_TCPDF_CALLS_IN_HTML' =>  true,		
		
);

foreach($tcpdfConfig as $k => $v) {
	defined($k) or define($k, $v);
}
unset($tcpdfConfig);
unset($k_path_main);
unset($k_path_url);
