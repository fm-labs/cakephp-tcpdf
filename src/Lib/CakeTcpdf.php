<?php
namespace Tcpdf\Lib;

use TCPDF;

/**
 * CakeTcpdf - A CakePHP wrapper for TCPDF
 *
 * IMPORTANT: Please note that the TCPDF constructor sets the mb_internal_encoding to ASCII,
 * so if you are using the mbstring module functions with TCPDF you need to correctly
 * set/unset the mb_internal_encoding when needed.
 *
 *
 * @see http://www.tcpdf.org
 */
class CakeTcpdf extends TCPDF
{
    /**
     * @var bool
     */
    public $rendered = false;

    /**
     *
     *
     * @param $orientation (string) page orientation. Possible values are (case insensitive):<ul><li>P or Portrait (default)</li><li>L or Landscape</li><li>'' (empty string) for automatic orientation</li></ul>
     * @param $unit (string) User measure unit. Possible values are:<ul><li>pt: point</li><li>mm: millimeter (default)</li><li>cm: centimeter</li><li>in: inch</li></ul><br />A point equals 1/72 of inch, that is to say about 0.35 mm (an inch being 2.54 cm). This is a very common unit in typography; font sizes are expressed in that unit.
     * @param $format (mixed) The format used for pages. It can be either: one of the string values specified at getPageSizeFromFormat() or an array of parameters specified at setPageFormat().
     * @param $unicode (boolean) TRUE means that the input text is unicode (default = true)
     * @param $encoding (string) Charset encoding (used only when converting back html entities); default is UTF-8.
     * @param $diskcache (boolean) DEPRECATED FEATURE
     * @param $pdfa (boolean) If TRUE set the document to PDF/A mode.
     * @public
     * @see TCPDF::__construct()
     * @see getPageSizeFromFormat(), setPageFormat()
     */
    public function __construct(
        $orientation = 'P',
        $unit = 'mm',
        $format = 'A4',
        $unicode = true,
        $encoding = 'UTF-8',
        $diskcache = false,
        $pdfa = false
    ) {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);

        $this->initialize();
    }

    /**
     * Initialize.
     * Called after constructing the TCPDF instance.
     * Override in subclasses
     */
    public function initialize()
    {
        // set document information
        $this->SetTitle('Untitled Document');
        $this->SetSubject('Untitled Document');
        $this->SetKeywords('');

        // set header and footer fonts
        $this->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $this->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

        // set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $this->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $this->SetTextColor(0, 0, 0);
        $this->SetFont('helvetica', '', 11);
    }

    /**
     * Overwrite this method in your subclass to specify a custom header
     * which will be added at the top of every page
     *
     * @see TCPDF::Header()
     */
    public function Header()
    {
        parent::Header();
    }

    /**
     * Overwrite this method in your subclass to specify a custom footer
     * which will be added at the bottom of every page
     *
     * @see TCPDF::Header()
     */
    public function Footer()
    {
        parent::Footer();
    }
}
