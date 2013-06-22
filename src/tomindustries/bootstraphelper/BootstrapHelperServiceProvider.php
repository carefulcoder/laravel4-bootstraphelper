<?php
/**
 * HelloServiceProvider.php
 * @author Tom
 * @since 18/06/13
 */

namespace tomindustries\bootstraphelper;
use Illuminate\Support\ServiceProvider;
/**
 * Class HelloServiceProvider
 * @package tomindustries\psr0lib
 */
class BootstrapHelperServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app['bootstraphelper'] = new BootstrapHelper();
    }
}