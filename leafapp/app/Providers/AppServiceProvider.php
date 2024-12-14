<?php
namespace App\Providers;

use App\Repositories\RegisterWordsRepositoryInterface;
use App\Repositories\RegisterWordsRepository;
use App\Repositories\MyWordsRepositoryInterface;
use App\Repositories\MyWordsRepository;
use App\Repositories\MPartOfSpeechRepository;
use App\Repositories\MPartOfSpeechRepositoryInterface;
use App\Repositories\DashboardRepository;
use App\Repositories\DashboardRepositoryInterface;

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
        $this->app->bind(MPartOfSpeechRepositoryInterface::class, MPartOfSpeechRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
    }

    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
};
