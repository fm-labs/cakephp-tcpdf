<?php
namespace Tcpdf;

use Cake\Core\BasePlugin;
use Cake\Core\Configure;
use Cake\Core\PluginApplicationInterface;

class Plugin extends BasePlugin
{
    /**
     * @var bool
     */
    public $routesEnabled = false;

    /**
     * @var bool
     */
    public $bootstrapEnabled = true;

    public function bootstrap(PluginApplicationInterface $app): void
    {
        Configure::load('Tcpdf.tcpdf');
        if (\Cake\Core\Plugin::isLoaded('Settings')) {
            Configure::load('Tcpdf', 'settings');
        }
    }
}