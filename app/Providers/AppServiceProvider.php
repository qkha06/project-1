<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{   
    public $bindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Services\Admin\Interfaces\DashboardServiceInterface' => 'App\Services\Admin\DashboardService',
        'App\Services\Admin\Interfaces\UserServiceInterface' => 'App\Services\Admin\UserService',
        'App\Services\Admin\Interfaces\STUServiceInterface' => 'App\Services\Admin\STUService',
        
        'App\Services\Interfaces\WithdrawServiceInterface' => 'App\Services\WithdrawService',
        'App\Services\Interfaces\StatisticsServiceInterface' => 'App\Services\StatisticsService',
        'App\Services\Interfaces\SettingServiceInterface' => 'App\Services\SettingService',
        'App\Services\Interfaces\DashboardServiceInterface' => 'App\Services\DashboardService',
        'App\Services\Interfaces\PayoutRateServiceInterface' => 'App\Services\PayoutRateService',
        'App\Services\Member\Interfaces\STUServiceInterface' => 'App\Services\Member\STUService',
        'App\Services\Interfaces\NOTEServiceInterface' => 'App\Services\NOTEService',

        'App\Services\Interfaces\BlogServiceInterface' => 'App\Services\BlogService',

        'App\Services\Interfaces\CategoryServiceInterface' => 'App\Services\CategoryService',
        'App\Services\Interfaces\PostServiceInterface' => 'App\Services\PostService',
        'App\Services\Interfaces\AccessServiceInterface' => 'App\Services\AccessService',
        'App\Services\Interfaces\InvoiceServiceInterface' => 'App\Services\InvoiceService',
        'App\Services\Home\Interfaces\STUServiceInterface' => 'App\Services\Home\STUService',
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach($this->bindings as $key => $val)
        {
            $this->app->bind($key, $val);
        }

        $this->app->register(RepositoryServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
