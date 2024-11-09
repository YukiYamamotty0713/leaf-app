<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRegisterRepository extends Command
{
    protected $signature = 'make:register-repository {name}';
    protected $description = 'Register repository interface and implementation in AppServiceProvider';

    public function handle()
    {
        $name = $this->argument('name');
        $interface = "{$name}RepositoryInterface";
        $repository = "{$name}Repository";

        // AppServiceProvider のファイルパスを取得
        $appServiceProviderPath = app_path('Providers/AppServiceProvider.php');

        if (!File::exists($appServiceProviderPath)) {
            $this->error('AppServiceProvider.php not found.');
            return Command::FAILURE;
        }

        // AppServiceProvider を読み込む
        $appServiceProviderContent = File::get($appServiceProviderPath);

        // すでに use 文が追加されていないか確認
        if (strpos($appServiceProviderContent, "use App\Repositories\\{$interface};") === false) {
            $appServiceProviderContent = preg_replace(
                '/namespace App\\\Providers;/',
                "namespace App\\\Providers;\n\nuse App\\Repositories\\{$interface};\nuse App\\Repositories\\{$repository};",
                $appServiceProviderContent
            );
            $this->info("Added use statements for {$interface} and {$repository}.");
        }

        // register メソッド内にバインディングを追加
        $registerMethodPattern = '/public function register\(\)\s*\{\s*/';
        $registerBindLine = "\$this->app->bind({$interface}::class, {$repository}::class);";

        if (preg_match($registerMethodPattern, $appServiceProviderContent)) {
            // register() メソッドが見つかったらバインディング行を追加
            if (strpos($appServiceProviderContent, $registerBindLine) === false) {
                // register() メソッド内にインデントを考慮してバインディング行を追加
                $appServiceProviderContent = preg_replace(
                    $registerMethodPattern,
                    "public function register()\n    {\n        {$registerBindLine}\n    ",
                    $appServiceProviderContent
                );
                $this->info("Added binding for {$interface} and {$repository} in register method.");
            } else {
                $this->info("Binding for {$interface} and {$repository} already exists in register method.");
            }
        } else {
            $this->info("register() method not found in AppServiceProvider.");
        }

        // ファイルを書き戻す
        File::put($appServiceProviderPath, $appServiceProviderContent);
        $this->info("AppServiceProvider updated with repository bindings.");

        return Command::SUCCESS;
    }
}
