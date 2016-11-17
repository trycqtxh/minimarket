<?php

namespace App\Providers;

use App\Helpers\Navigation\Navigation;
use Illuminate\Support\ServiceProvider;

class NavigationProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Navigation\Contract\NavigationContract', function(){
            return new Navigation();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Helpers\Navigation\Contract\NavigationContract'];
    }

}
