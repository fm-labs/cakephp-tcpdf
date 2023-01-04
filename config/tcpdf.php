<?php
//============================================================+
// File name   : tcpdf_config.php
// Begin       : 2004-06-11
// Last Update : 2014-12-11
//
// Description : Configuration file for TCPDF.
// Author      : Nicola Asuni - Tecnick.com LTD - www.tecnick.com - info@tecnick.com
// License     : GNU-LGPL v3 (http://www.gnu.org/copyleft/lesser.html)
// -------------------------------------------------------------------
// Copyright (C) 2004-2014  Nicola Asuni - Tecnick.com LTD
//
// This file is part of TCPDF software library.
//
// TCPDF is free software: you can redistribute it and/or modify it
// under the terms of the GNU Lesser General Public License as
// published by the Free Software Foundation, either version 3 of the
// License, or (at your option) any later version.
//
// TCPDF is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with TCPDF.  If not, see <http://www.gnu.org/licenses/>.
//
// See LICENSE.TXT file for more information.
//============================================================+

/**
 * Configuration file for TCPDF.
 *
 * @author Nicola Asuni
 * @package com.tecnick.tcpdf
 * @version 4.9.005
 * @since 2004-10-27
 *
 *
 *
 * Optimized for CakePHP
 * @author Florian Beisskammer (fm-labs)
 */
use Cake\Core\Configure;

/**
 * Enable external config - THIS IS IMPORTANT!
 */
defined('K_TCPDF_EXTERNAL_CONFIG') || define('K_TCPDF_EXTERNAL_CONFIG', true);

/**
 * Default images directory.
 * By default it is automatically set but you can also set it as a fixed string to improve performances.
 */
defined('K_PATH_IMAGES') || define('K_PATH_IMAGES', WWW_ROOT . 'img' . DS);

/**
 * Cache directory for temporary files (full path).
 */
defined('K_PATH_CACHE') || define('K_PATH_CACHE', TMP);

/**
 * Document creator.
 */
defined('PDF_CREATOR')
    || define('PDF_CREATOR', Configure::read('Tcpdf.creator', 'CakePHP TCPDF'));

/**
 * Document author.
 */
defined('PDF_AUTHOR')
    || define('PDF_AUTHOR', Configure::read('Tcpdf.author', 'CakePHP TCPDF'));

/**
 * Header title.
 */
defined('PDF_HEADER_TITLE')
    || define('PDF_HEADER_TITLE', Configure::read('Tcpdf.headerTitle', 'CakePHP TCPDF Example'));

/**
 * Header description string.
 */
defined('PDF_HEADER_STRING')
    || define('PDF_HEADER_STRING', Configure::read('Tcpdf.headerString', 'by CakePHP TCPDF Plugin'));

/**
 * Installation path (/var/www/tcpdf/).
 * By default it is automatically calculated but you can also set it as a fixed string to improve performances.
 */
//defined('K_PATH_MAIN') || define('K_PATH_MAIN', '');

/**
 * URL path to tcpdf installation folder (http://localhost/tcpdf/).
 * By default it is automatically set but you can also set it as a fixed string to improve performances.
 */
//defined('K_PATH_URL') || define('K_PATH_URL', '/');

/**
 * Path for PDF fonts.
 * By default it is automatically set but you can also set it as a fixed string to improve performances.
 */
//defined('K_PATH_FONTS') || define('K_PATH_FONTS', K_PATH_MAIN.'fonts/');

/**
 * Deafult image logo used be the default Header() method.
 * Please set here your own logo or an empty string to disable it.
 */
defined('PDF_HEADER_LOGO') || define('PDF_HEADER_LOGO', '');

/**
 * Header logo image width in user units.
 */
defined('PDF_HEADER_LOGO_WIDTH') || define('PDF_HEADER_LOGO_WIDTH', 0);

/**
 * Generic name for a blank image.
 */
defined('K_BLANK_IMAGE') || define('K_BLANK_IMAGE', '_blank.png');

/**
 * Page format.
 */
defined('PDF_PAGE_FORMAT') || define('PDF_PAGE_FORMAT', 'A4');

/**
 * Page orientation (P=portrait, L=landscape).
 */
defined('PDF_PAGE_ORIENTATION') || define('PDF_PAGE_ORIENTATION', 'P');

/**
 * Document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch].
 */
defined('PDF_UNIT') || define('PDF_UNIT', 'mm');

/**
 * Header margin.
 */
defined('PDF_MARGIN_HEADER') || define('PDF_MARGIN_HEADER', 5);

/**
 * Footer margin.
 */
defined('PDF_MARGIN_FOOTER') || define('PDF_MARGIN_FOOTER', 10);

/**
 * Top margin.
 */
defined('PDF_MARGIN_TOP') || define('PDF_MARGIN_TOP', 27);

/**
 * Bottom margin.
 */
defined('PDF_MARGIN_BOTTOM') || define('PDF_MARGIN_BOTTOM', 25);

/**
 * Left margin.
 */
defined('PDF_MARGIN_LEFT') || define('PDF_MARGIN_LEFT', 15);

/**
 * Right margin.
 */
defined('PDF_MARGIN_RIGHT') || define('PDF_MARGIN_RIGHT', 15);

/**
 * Default main font name.
 */
defined('PDF_FONT_NAME_MAIN') || define('PDF_FONT_NAME_MAIN', 'helvetica');

/**
 * Default main font size.
 */
defined('PDF_FONT_SIZE_MAIN') || define('PDF_FONT_SIZE_MAIN', 10);

/**
 * Default data font name.
 */
defined('PDF_FONT_NAME_DATA') || define('PDF_FONT_NAME_DATA', 'helvetica');

/**
 * Default data font size.
 */
defined('PDF_FONT_SIZE_DATA') || define('PDF_FONT_SIZE_DATA', 8);

/**
 * Default monospaced font name.
 */
defined('PDF_FONT_MONOSPACED') || define('PDF_FONT_MONOSPACED', 'courier');

/**
 * Ratio used to adjust the conversion of pixels to user units.
 */
defined('PDF_IMAGE_SCALE_RATIO') || define('PDF_IMAGE_SCALE_RATIO', 1.25);

/**
 * Magnification factor for titles.
 */
defined('HEAD_MAGNIFICATION') || define('HEAD_MAGNIFICATION', 1.1);

/**
 * Height of cell respect font height.
 */
defined('K_CELL_HEIGHT_RATIO') || define('K_CELL_HEIGHT_RATIO', 1.25);

/**
 * Title magnification respect main font size.
 */
defined('K_TITLE_MAGNIFICATION') || define('K_TITLE_MAGNIFICATION', 1.3);

/**
 * Reduction factor for small font.
 */
defined('K_SMALL_RATIO') || define('K_SMALL_RATIO', 2 / 3);

/**
 * Set to true to enable the special procedure used to avoid the overlappind of symbols on Thai language.
 */
defined('K_THAI_TOPCHARS') || define('K_THAI_TOPCHARS', false);

/**
 * If true allows to call TCPDF methods using HTML syntax
 * IMPORTANT: For security reason, disable this feature if you are printing user HTML content.
 */
defined('K_TCPDF_CALLS_IN_HTML') || define('K_TCPDF_CALLS_IN_HTML', false);

/**
 * If true and PHP version is greater than 5,
 * then the Error() method throw new exception instead of terminating the execution.
 */
defined('K_TCPDF_THROW_EXCEPTION_ERROR') || define('K_TCPDF_THROW_EXCEPTION_ERROR', false);

/**
 * Default timezone for datetime functions
 *
 * @todo Use application timezone
 */
defined('K_TIMEZONE') || define('K_TIMEZONE', 'UTC');

//============================================================+
// END OF FILE
//============================================================+

return [];
