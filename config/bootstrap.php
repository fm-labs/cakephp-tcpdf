<?php
use Cake\Core\Configure;
use Cake\Log\Log;
/*
 * Autoload TCPDF configuration
 */
try {
    Configure::load('tcpdf');

} catch (\Exception $ex) {
    Log::warning("Tcpdf: Failed to load configuration: " . $ex->getMessage());

    if (Configure::read('debug')) {
        throw $ex;
    }
}