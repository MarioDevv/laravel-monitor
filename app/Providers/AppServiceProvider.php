<?php

namespace App\Providers;

use App\Doctrine\Repository\Monitor\Repository\DoctrineMonitorRepository;
use Illuminate\Support\Facades\Blade;
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
        Blade::anonymousComponentNamespace('icons', 'icon');
        Blade::anonymousComponentNamespace('web.admin.components', 'admin');
    }
}
