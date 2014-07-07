<?php
require_once(dirname(dirname(__FILE__)).DS.'Config'.DS.'tcpdf_config.php');

App::import('Vendor','Tcpdf.tcpdf/tcpdf');

/**
 * CakeTcpdf - A CakePHP wrapper for TCPDF
 * 
 * @see http://www.tcpdf.org
 */
class CakeTcpdf extends TCPDF {

	public $rendered = false;
	
	public function setupDefaults() {
		
		$textfont = 'helvetica';
		
		// set document information
		$this->SetTitle('Untitled CakeTcpdf Document');
		$this->SetSubject('Untitled CakeTcpdf Document');
		$this->SetKeywords('CakeTcpdf, CakePHP, Pdf');
		
		
		// set default header data
		//$this->SetHeaderData('ticket_header.png', '50', '', '', array(172,172,172), array(172,172,172));
		//$this->setFooterData($tc=array(0,64,0), $lc=array(0,64,128));
		
		
		// set header and footer fonts
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		//set margins
		$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		//set auto page breaks
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		//set image scale factor
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		//set some language-dependent strings
		//$this->setLanguageArray($l);
		
		#$this->setPrintHeader(false);
		#$this->setPrintFooter(false);
		
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('helvetica','',11);
		
		// content
		$this->AddPage();		
	}
	
/**
 * Overwrite this method in your subclass to specify a custom header
 * which will be added at the top of every page
 * 
 * @see TCPDF::Header()
 */
	public function Header() {
		return parent::Header();
	}


/**
 * Overwrite this method in your subclass to specify a custom footer
 * which will be added at the bottom of every page
 * 
 * @see TCPDF::Header()
 */	
	public function Footer() {
		return parent::Footer();
	}
	
}