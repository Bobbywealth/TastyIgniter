<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');

            if (!$this->app->runningInConsole()) {
                if (empty(config('session.domain'))) {
                    config(['session.domain' => request()->getHost()]);
                }

                config([
                    'session.secure' => true,
                    'session.same_site' => 'lax',
                ]);
            }
        }
    }
}
