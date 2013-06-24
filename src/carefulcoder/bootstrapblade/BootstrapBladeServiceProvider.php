<?php

namespace carefulcoder\bootstrapblade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\CompilerEngine;

/**
 * Class BootstrapBladeServiceProvider
 * @package carefulcoder\bootstrapblade
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

        //Tell Laravel how to find and what to compile the files with
        $environment->getFinder()->addExtension('boot.php');
        $environment->addExtension('boot.php', 'boot');

        //Register our new compiler engine with the 'boot' tag.
        $engineResolver->register('boot', function() use($app)
        {
            $cache = $app['path.storage'].'/views';
            return new CompilerEngine(new BootstrapBladeCompiler($app['files'], $cache), $app['files']);
        });
    }
}