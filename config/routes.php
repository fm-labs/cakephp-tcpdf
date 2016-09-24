<?php
use Cake\Routing\Router;

Router::plugin('Tcpdf', function ($routes) {
    $routes->fallbacks('DashedRoute');
});
