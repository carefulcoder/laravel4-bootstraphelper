<?php
/**
 * HelloServiceProvider.php
 * @author Tom
 * @since 18/06/13
 */

namespace tomindustries\bootstrapblade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\CompilerEngine;

/**
 * Class HelloServiceProvider
 * @package tomindustries\psr0lib
 */
class BootstrapBladeServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $environment = $this->app['view'];
        $engineResolver = $environment->getEngineResolver();
        $environment->addExtension('.boot.php', 'boot');

        $engineResolver->register('boot', function() use($app)
        {
            $cache = $app['path.storage'].'/views';
            return new CompilerEngine(BootstrapBladeCompiler($app['files'], $cache), $app['files']);
        });
    }
}