<?php

namespace Tcpdf\View;

use Cake\Core\Configure;
use Cake\Event\EventManager;
use Cake\Http\ServerRequest as Request;
use Cake\Http\Response;
use Cake\View\View;
use Tcpdf\Lib\CakeTcpdf;

/**
 * Class PdfView
 *
 * @package Tcpdf\View
 */
class PdfView extends View
{
    /**
     * @var array Default configuration
     */
    protected $_config = [
        'download' => false,
        'filename' => '',
        'raw' => true,
    ];

    /**
     * @var CakeTcpdf Rendering engine
     */
    protected $_engine;

    public function __construct(
        Request $request = null,
        Response $response = null,
        EventManager $eventManager = null,
        array $viewOptions = []
    ) {
        parent::__construct($request, $response, $eventManager, $viewOptions);

        //$this->_engine = new CakeTcpdf();
        //$this->_engine->setupDefaults();

        // @todo set response type before rendering not on construct
        //$this->response->type('pdf');

        /*
        // set pdf layout path
        if ($this->layoutPath === null) {
            $this->layoutPath = 'pdf';
        }

        // set pdf subdir for views
        if ($this->subDir === null) {
            $this->subDir = 'pdf';
        }
        */

        // autoload PdfHelper
        //$this->helpers()->load('Tcpdf.Pdf');
    }

    /**
     * @return CakeTcpdf
     * @throws \Exception
     */
    public function engine()
    {
        if (!$this->_engine) {
            $className = $this->get('pdfEngine', 'Tcpdf\Lib\CakeTcpdf');

            if (!class_exists($className)) {
                throw new \RuntimeException("Class $className does not exist");
            }

            $engine = new $className();

            if (!is_a($engine, 'Tcpdf\Lib\CakeTcpdf')) {
                throw new \RuntimeException('The given pdf engine does not extend CakeTcpdf');
            }
            $this->_engine = $engine;
        }

        return $this->_engine;
    }

    public function render($view = null, $layout = null)
    {
        // !IMPORTANT: Render view before initializing CakeTcpdf, because TCPDF sets the encoding to ASCII
        $content = parent::render($view, $layout);

        $pdfParams = $this->get('pdf');

        $this->engine()->SetTitle($pdfParams['title']);
        $this->engine()->SetSubject($pdfParams['subject']);
        $this->engine()->SetKeywords($pdfParams['keywords']);

        //Configure::write('debug', false);
        $this->engine()->AddPage();
        $this->engine()->writeHTML($content, true, 0, true, 0);

        $filedir = (isset($pdfParams['filedir'])) ? $pdfParams['filedir'] : TMP;

        $filename = (isset($pdfParams['filename'])) ? $pdfParams['filename'] : 'document.pdf';
        $filename = (!preg_match('/\.pdf$/i', $filename)) ? $filename . '.pdf' : $filename;
        $output = (isset($pdfParams['output'])) ? $pdfParams['output'] : 'S';

        switch (strtoupper($output)) {
            case "D":
            case "DOWNLOAD":
                // force download
                return $this->engine()->Output($filename, 'D');

            case "I":
            case "BROWSER":
                // send to browser
                return $this->engine()->Output('', 'I');

            case "F":
            case "FILE":
                // save to disk
                $this->engine()->Output($filedir . $filename, 'F');

                return $content;

            case "FD":
            case "FILEDOWNLOAD":
                // save to disk and force download
                return $this->engine()->Output($filedir . $filename, 'FD');

            case "S":
            default:
                // send as application/pdf response
                $this->response->type('pdf');
                $this->response->header('Content-Disposition: inline; filename="' . $filename . '"');

                return $this->engine()->Output('', 'S');
        }
    }

    /**
     * Pass method calls to pdf engine
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->engine(), $method], $args);
    }
}
