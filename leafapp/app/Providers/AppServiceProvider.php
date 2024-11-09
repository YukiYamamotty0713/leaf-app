<?php
namespace App\Providers;
use App\Repositories\SampleRepositoryInterface;
use App\Repositories\SampleRepository;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TestRepositoryInterface;
use App\Repositories\TestRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(SampleRepositoryInterface::class, SampleRepository::class);
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
