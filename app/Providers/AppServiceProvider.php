<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\ElectricityNordPriceService;
use App\Services\ElectricityPriceSeviceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->bind(ElectricityPriceSeviceInterface::class, ElectricityNordPriceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
