<?php

namespace App\Providers;

use App\Doctrine\Repository\Monitor\DoctrineMonitorRepository;
use Illuminate\Support\ServiceProvider;
use MarioDevv\Uptime\Monitor\Domain\MonitorRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            MonitorRepository::class,
            DoctrineMonitorRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
