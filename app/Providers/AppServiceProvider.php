<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Implementations\ProjectRepository;
//use App\Services\ProjectService;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Repositories\Implementations\TaskRepository;
use App\Services\LoggingService;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
            $this->app->bind(ProjectRepositoryInterface::class,ProjectRepository::class);
            $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
            $this->app->bind(LoggingService::class, function ($app) {
            return new LoggingService($app->make(LoggerInterface::class));
        });
            

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
