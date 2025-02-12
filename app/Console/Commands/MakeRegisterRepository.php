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
            // use 文を追加
            $appServiceProviderContent = preg_replace(
                '/namespace App\\\Providers;/',
                "namespace App\\\Providers;\n\nuse App\\Repositories\\{$interface};\nuse App\\Repositories\\{$repository};",
                $appServiceProviderContent
            );
            $this->info("Added use statements for {$interface} and {$repository}.");
        } else {
            $this->info("Use statements for {$interface} and {$repository} already exist.");
        }

        // register メソッド内にバインディングを追加するためのパターン
        $registerMethodPattern = '/public function register\(\)\n\s*\{/';
        $bindingLine = "\$this->app->bind({$interface}::class, {$repository}::class);";

        // もし register() メソッドが存在すれば
        if (preg_match($registerMethodPattern, $appServiceProviderContent)) {
            // "XXX" が登録メソッド内に存在すれば
            $insertPattern = '/\bXXX\b/';

            if (preg_match($insertPattern, $appServiceProviderContent)) {
                // "XXX" の場所にバインディング行を挿入
                $appServiceProviderContent = preg_replace(
                    $insertPattern,
                    $bindingLine,
                    $appServiceProviderContent
                );
                $this->info("Added binding for {$interface} and {$repository} at the XXX placeholder.");
            } else {
                // "XXX" が見つからない場合、バインディングを register() メソッド内に追加
                $appServiceProviderContent = preg_replace(
                    $registerMethodPattern,
                    "public function register()\n    {\n        {$bindingLine}\n    }",
                    $appServiceProviderContent
                );
                $this->info("No placeholder 'XXX' found. Added binding for {$interface} and {$repository} at the end of register method.");
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
