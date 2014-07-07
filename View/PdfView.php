<?php
App::uses('View','View');
App::uses('CakeTcpdf', 'Tcpdf.Lib');
 
class PdfView extends View {
	
	/**
	 * @var CakeTcpdf
	 */
	protected $_tcpdf;
	
	protected $_config = array(
		'download' => false,
		'filename' => '',
		'raw' => false,
	);
	
	public function __construct(Controller $controller = null) {
        // construct view
		parent::__construct($controller);

        // init CakeTcpdf
        if ($this->get('tcpdf')) {
            $tcpdf = $this->get('tcpdf');
            if (!is_a($tcpdf, 'CakeTcpdf')) {
                throw new InvalidArgumentException('Given tcpdf object is not an instance of CakeTcpdf');
            }
            $this->_tcpdf = $tcpdf;
        } else {
            $this->_tcpdf = new CakeTcpdf();
            $this->_tcpdf->setupDefaults();
        }

        // @todo set response type before rendering not on construct
		$this->response->type('pdf');

        // set pdf layout path
		if ($this->layoutPath === null) {
			$this->layoutPath = 'pdf';
		}

		// set pdf subdir for views
		if ($this->subDir === null) {
			$this->subDir = 'pdf';
		}

        /*
        // @deprecated
		if ($this->request->query('download')) {
			$this->_config['download'] = true;
		}

		if ($this->request->query('raw')) {
			$this->_config['raw'] = true;
		}
        */
		
		// autoload PdfHelper
		if (!array_key_exists('Tcpdf.Pdf', $this->helpers) && !in_array('Tcpdf.Pdf', $this->helpers)) {
			$this->helpers[] = 'Tcpdf.Pdf';
		}
	}

    /**
     * @return CakeTcpdf
     * @deprecated
     */
    public function &tcpdf() {
		return $this->_tcpdf;
	}
	
	public function render($view = null, $layout = null) {
		
		// read config from view vars
		$config = $this->_config;
		if ($this->get('pdf')) {
			$config = am($config, $this->get('pdf'));
		}
		
		$pdf =& $this->tcpdf();
		
		$content = parent::render($view, $layout);
		
		//if ($pdf->rendered === true) {
			//debug('already rendered');
		//}
		//else {
		//}
		$pdf->writeHTML($content, true, 0, true, 0);
		//debug('rendered');
		
		$outputType = 'I';
		if ($config['download']) {
			$outputType = 'D';
		}
		elseif ($config['raw']) {
			$outputType = 'S';
			$this->response->type('text');
		}
		
		$filename = ($config['filename']) 
			? ($config['filename']) 
			: $this->name;
		$filename .= '.pdf';
		
		$pdfBuffer = $pdf->Output($filename, $outputType);
		
		return $pdfBuffer;
	}
	
}