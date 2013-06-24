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

        //Register our new compiler engine with the 'boot' tag.
        $engineResolver->register('blade', function() use($app)
        {
            $cache = $app['path.storage'].'/views';
            return new CompilerEngine(new BootstrapBladeCompiler($app['files'], $cache), $app['files']);
        });
    }
}