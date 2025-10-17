<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PerformanceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Optimize Eloquent
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());
        Model::preventAccessingMissingAttributes(!app()->isProduction());

        // Disable query logging in production
        if (app()->isProduction()) {
            DB::connection()->disableQueryLog();
        }

        // Share common data with all views to reduce database queries
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $view->with('currentUser', auth()->user());
                $view->with('currentCompany', auth()->user()->currentCompany);
            }
        });

        // Optimize image loading
        if (config('app.env') === 'production') {
            ini_set('memory_limit', '256M');
            ini_set('max_execution_time', '60');
        }
    }
}
