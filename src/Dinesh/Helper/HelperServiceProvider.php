<?php

namespace Dinesh\Helper;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('dinesh/helper');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
        $this->app['DNS'] = $this->app->share(function($app) {
                    return new DNS;
                });
        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function() {
                    $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                    $loader->alias('DNS', 'Dinesh\Helper\Facades\DNS');
                });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array("DNS");
    }

}