<?php
declare(strict_types=1);

namespace Tcpdf\View;

use Cake\Event\EventManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest as Request;
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
     * @var \Tcpdf\Lib\CakeTcpdf Rendering engine
     */
    protected $_engine;

    /**
     * @inheritDoc
     */
    public function __construct(
        ?Request $request = null,
        ?Response $response = null,
        ?EventManager $eventManager = null,
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
     * @return \Tcpdf\Lib\CakeTcpdf
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

            if (!is_a($engine, CakeTcpdf::class)) {
                throw new \RuntimeException('The given pdf engine does not extend CakeTcpdf');
            }
            $this->_engine = $engine;
        }

        return $this->_engine;
    }

    /**
     * @param string|null $template Template name
     * @param string|false|null $layout Layout to use. False to disable.
     * @return string
     * @throws \Exception
     */
    public function render(?string $template = null, $layout = null): string
    {
        // !IMPORTANT: Render view before initializing CakeTcpdf, because TCPDF sets the encoding to ASCII
        $content = parent::render($template, $layout);

        $pdfParams = $this->get('pdf');

        $this->engine()->SetTitle($pdfParams['title']);
        $this->engine()->SetSubject($pdfParams['subject']);
        $this->engine()->SetKeywords($pdfParams['keywords']);

        //Configure::write('debug', false);
        $this->engine()->AddPage();
        $this->engine()->writeHTML($content, true, 0, true, 0);

        $filedir = $pdfParams['filedir'] ?? TMP;

        $filename = $pdfParams['filename'] ?? 'document.pdf';
        $filename = !preg_match('/\.pdf$/i', $filename) ? $filename . '.pdf' : $filename;
        $output = $pdfParams['output'] ?? 'S';

        switch (strtoupper($output)) {
            case 'D':
            case 'DOWNLOAD':
                // force download
                return $this->engine()->Output($filename, 'D');

            case 'I':
            case 'BROWSER':
                // send to browser
                return $this->engine()->Output('', 'I');

            case 'F':
            case 'FILE':
                // save to disk
                $this->engine()->Output($filedir . $filename, 'F');

                return $content;

            case 'FD':
            case 'FILEDOWNLOAD':
                // save to disk and force download
                return $this->engine()->Output($filedir . $filename, 'FD');

            case 'S':
            default:
                // send as application/pdf response
                $this->response = $this->response
                    ->withType('pdf')
                    ->withHeader('Content-Disposition', 'inline; filename="' . $filename . '"');

                return $this->engine()->Output('', 'S');
        }
    }

    /**
     * Pass method calls to pdf engine
     *
     * @param string $method Method name
     * @param mixed $args Method args
     * @return mixed
     * @throws \Exception
     */
    public function __call(string $method, $args)
    {
        return call_user_func_array([$this->engine(), $method], $args);
    }
}
