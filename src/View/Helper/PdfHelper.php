<?php
namespace Tcpdf\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Tcpdf\Lib\CakeTcpdf;
use Tcpdf\View\PdfView;

/**
 * Cake Tcpdf Plugin PdfHelper
 */
class PdfHelper extends Helper
{
    /**
     * @var string View block name for buffering html
     */
    protected $_bufferBlock = 'pdf';

    /**
     * @var PdfView
     */
    protected $_View;

    /**
     * @see View::__constructor()
     * @throws \Exception
     */
    public function __construct(PdfView $View, $settings = [])
    {
        parent::__construct($View, $settings);
    }

    /**
     * Direct access to pdf engine
     *
     * @return CakeTcpdf
     */
    public function engine()
    {
        return $this->_View->engine();
    }

    /**
     * Pass all method calls to pdf engine
     */
    public function __call($method, $params)
    {
        return call_user_func_array([$this->engine(), $method], $params);
    }

    /**
     * Start capturing html
     */
    public function start()
    {
        $this->_View->start($this->_bufferBlock);
    }

    /**
     * Stop capturing html
     */
    public function end()
    {
        if ($this->_View->Blocks->active() === $this->_bufferBlock) {
            $this->_View->end();
        }
    }

    /**
     * Flush captured html buffer to pdf as HTML block
     */
    public function flush()
    {
        // read html buffer from view block
        $this->end();
        $content = $this->_View->fetch($this->_bufferBlock);

        // write html buffer to pdf
        if ($content) {
            $this->engine()->writeHTML($content, true, 0, true, 0);
            $this->engine()->rendered = true;
        }

        // reset buffer
        $this->_View->assign($this->_bufferBlock, '');
    }

    /**
     * Add new page
     * Flushes buffered contents, if any
     */
    public function addPage()
    {
        $this->flush();
        $this->engine()->AddPage();
    }
}
