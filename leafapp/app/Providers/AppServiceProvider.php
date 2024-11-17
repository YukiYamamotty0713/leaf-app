<?php
namespace App\Providers;

use App\Repositories\RegisterWordsRepositoryInterface;
use App\Repositories\RegisterWordsRepository;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     *　アプリの
     */
    public function register()
    {
        $this->app->bind(RegisterWordsRepositoryInterface::class, RegisterWordsRepository::class);
    }

    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
};
