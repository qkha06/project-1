<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RevenueServiceProvider extends ServiceProvider
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
        view()->composer(
            ['backend.member.*', 'backend.tabler.layout', 'clients.landing-page'], 
            'App\Http\ViewComposers\RevenueComposer'
        );
    }
}
