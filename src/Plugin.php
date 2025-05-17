<?php
declare(strict_types=1);

namespace Tcpdf;

use Cake\Core\BasePlugin;
use Cake\Core\Configure;
use Cake\Core\Plugin as CakePlugin;
use Cake\Core\PluginApplicationInterface;

class Plugin extends BasePlugin
{
    protected bool $routesEnabled = false;

    protected bool $bootstrapEnabled = true;

    /**
     * @inheritDoc
     */
    public function bootstrap(PluginApplicationInterface $app): void
    {
        Configure::load('Tcpdf.tcpdf');

        if (CakePlugin::isLoaded('Settings')) {
            Configure::load('Tcpdf', 'settings');
        }
    }
}
