<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Disable debug mode in production
        if ($this->app->environment('production')) {
            $this->app['config']->set('app.debug', false);
            $this->app['config']->set('logging.channels.stack.level', 'error');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix for MySQL < 5.7.7 and MariaDB < 10.2.2
        Schema::defaultStringLength(191);

        // Disable all the property type hinting warnings
        error_reporting(E_ALL ^ E_DEPRECATED);
        
        // Improve performance by setting timezone in code
        date_default_timezone_set(config('app.timezone'));
    }
}
