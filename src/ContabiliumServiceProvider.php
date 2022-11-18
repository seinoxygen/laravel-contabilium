<?php

namespace SeinOxygen\Contabilium;

use Illuminate\Support\ServiceProvider;

class ContabiliumServiceProvider extends ServiceProvider
{
    /**
     * Register the Swift Transport instance.
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Contabilium', function () {
            return new Contabilium();
        });
    }

    public function boot()
    {
 
    }
}
