<?php
declare(strict_types=1);

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
    protected string $_bufferBlock = 'pdf';

    /**
     * @var \Tcpdf\View\PdfView
     */
    protected View $_View;

    /**
     * @param \Tcpdf\View\PdfView $View
     * @param array $settings
     * @see View::__constructor()
     */
    public function __construct(PdfView $View, array $settings = [])
    {
        parent::__construct($View, $settings);
    }

    /**
     * Direct access to pdf engine
     *
     * @return \Tcpdf\Lib\CakeTcpdf
     */
    public function engine(): CakeTcpdf
    {
        return $this->_View->engine();
    }

    /**
     * Pass all method calls to pdf engine
     *
     * @param string $method
     * @param mixed $params
     * @return mixed|false
     */
    public function __call(string $method, mixed $params): mixed
    {
        return call_user_func_array([$this->engine(), $method], $params);
    }

    /**
     * Start capturing html
     *
     * @return $this
     */
    public function start()
    {
        $this->_View->start($this->_bufferBlock);

        return $this;
    }

    /**
     * Stop capturing html
     *
     * @return $this
     */
    public function end()
    {
        if ($this->_View->Blocks->active() === $this->_bufferBlock) {
            $this->_View->end();
        }

        return $this;
    }

    /**
     * Flush captured html buffer to pdf as HTML block
     *
     * @return $this
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

        return $this;
    }

    /**
     * Add new page
     * Flushes buffered contents, if any
     *
     * @return $this
     */
    public function addPage()
    {
        $this->flush();
        $this->engine()->AddPage();

        return $this;
    }
}
