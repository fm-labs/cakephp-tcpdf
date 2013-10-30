<?php
App::uses('AppHelper', 'View/Helper');
App::uses('CakeTcpdf','Tcpdf.Lib');

/**
 * CakeTcpdf Plugin PdfHelper
 */
class PdfHelper extends AppHelper {

	/**
	 * @var CakeTcpdf
	 */
	protected $_tcpdf;
	
	/**
	 * View block name for buffering html
	 * 
	 * @var string
	 */
	protected $_bufferBlock = 'pdf';
	
	/**
	 * @see View::__constructor()
	 * @throws Exception
	 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		
		if (!is_a($this->_View, 'PdfView')) {
			throw new Exception('View has to be or extend the Tcpdf.PdfView class');
			//TODO PdfHelper should work without PdfView
			//return;
		}
		
		$this->_tcpdf =& $this->_View->tcpdf();
	}

	/**
	 * Direct access to CakeTcpdf tcpdf instance
	 * 
	 * @return CakeTcpdf
	 * @throws Exception
	 */
	public function &tcpdf() {
		if (!$this->_tcpdf) {
			throw new Exception('No CakeTcpdf instance found');
			
			//TODO Dependency injection
			//TODO PdfHelper should work without PdfView
			//$this->_tcpdf = new CakeTcpdf();
			//$this->_tcpdf->setupDefaults();
			
		}
		return $this->_tcpdf;
	}
	
	/**
	 * Passthrouh all method calls to the Tcpdf instance
	 * 
	 * @see Helper::__call()
	 */
	public function __call($method, $params) {
		return call_user_func_array(array($this->tcpdf(), $method), $params);
	}
	
	/**
	 * Start capturing html
	 */
	public function start() {
		$this->_View->start($this->_bufferBlock);
	}

	/**
	 * Stop capturing html
	 */
	public function end() {
		if ($this->_View->Blocks->active() === $this->_bufferBlock) {
			$this->_View->end();
		}
	}	
	
	/**
	 * Flush captured html buffer to pdf as HTML block
	 * 
	 * @param bool $newPage
	 * @param bool $restart
	 */
	public function flush($newPage = false, $restart = false) {
		
		// read html buffer from view block
		$this->end();
		$content = $this->_View->fetch($this->_bufferBlock);
		
		// write html buffer to pdf
		if ($content) {
			$this->tcpdf()->writeHTML($content, true, 0, true, 0);
			$this->tcpdf()->rendered = true;
			
			// add new page
			if ($newPage) {
				$this->tcpdf()->AddPage();
			}
		}
		
		// reset buffer
		$this->_View->assign($this->_bufferBlock, '');
		
		// start new html buffer 
		if ($restart) {
			$this->start();
		}

	}
	
	/**
	 * Cleanup
	 * 
	 * @see Helper::afterRender()
	 */
	public function afterRender($viewFile) {
		$this->_View->assign($this->_bufferBlock,'');
	}
	
}
?>