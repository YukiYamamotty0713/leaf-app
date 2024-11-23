<?php
namespace App\Providers;

use App\Repositories\RegisterWordsRepositoryInterface;
use App\Repositories\RegisterWordsRepository;
use App\Repositories\MyWordsRepositoryInterface;
use App\Repositories\MyWordsRepository;


use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションのグローバル設定
     * リポジトリインターフェースと具象リポジトリを紐づける
     */
    public function register()
    {
        $this->app->bind(RegisterWordsRepositoryInterface::class, RegisterWordsRepository::class);
        $this->app->bind(MyWordsRepositoryInterface::class, MyWordsRepository::class);
    }

    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
};
