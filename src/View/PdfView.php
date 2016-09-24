<?php

namespace Tcpdf\View;


use Cake\Core\Configure;
use Cake\Event\EventManager;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\View\View;
use Tcpdf\Lib\CakeTcpdf;

class PdfView extends View
{
    /**
     * @var array Default configuration
     */
    protected $_config = array(
        'download' => false,
        'filename' => '',
        'raw' => true,
    );

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
            $engine = new $className();

            if (!is_a($engine, 'Tcpdf\Lib\CakeTcpdf')) {
                throw new \Exception('The given pdf engine does not extend CakeTcpdf');
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

        Configure::write('debug', false);
        $this->engine()->AddPage();
        $this->engine()->writeHTML($content, true, 0, true, 0);


        $filename = (isset($pdfParams['filename'])) ? $pdfParams['filename'] : 'document.pdf';
        $output = (isset($pdfParams['output'])) ? $pdfParams['output'] : 'S';

        switch (strtoupper($output)) {
            case "D":
                // force download
                return $this->engine()->Output($filename, 'D');

            case "I":
                // send to browser
                return $this->engine()->Output('', 'I');

            case "F":
                // save to disk
                return $this->engine()->Output(TMP . $filename, 'F');

            case "FD":
                // save to disk and force download
                return $this->engine()->Output(TMP . $filename, 'FD');

            case "S":
            default:
                // send as application/pdf response
                $this->response->type('pdf');
                $this->response->header('Content-Disposition: inline; filename="' . $filename . '"');
                return $this->engine()->Output('', 'S');
        }

    }

}