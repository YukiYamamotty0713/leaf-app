<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name} {--interface=}';
    protected $description = 'Generate a repository for a given entity with an optional interface';

    public function handle()
    {
        $name = $this->argument('name');
        $interfaceOption = $this->option('interface');
        
        $this->info("Creating repository for {$name}");

        // インターフェースの指定がある場合
        if ($interfaceOption) {
            // インターフェース名の末尾を確認し、不足していれば `RepositoryInterface` を付加
            if (!str_ends_with($interfaceOption, 'RepositoryInterface')) {
                $interfaceOption .= 'RepositoryInterface';
            }

            // インターフェースファイルのパスを設定
            $repositoryInterfacePath = app_path("Repositories/{$interfaceOption}.php");

            // インターフェースが存在しなければ、`make:repository-interface` コマンドで作成
            if (!File::exists($repositoryInterfacePath)) {
                $process = new Process(['php', 'artisan', 'make:repository-interface', $name]);
                $process->run();

                if (!$process->isSuccessful()) {
                    $this->error('Failed to create repository interface.');
                    return Command::FAILURE;
                }

                $this->info("Interface created: {$interfaceOption}");
            } else {
                $this->info("Interface already exists: {$interfaceOption}");
            }
        }

        // リポジトリファイルのパスを設定
        $repositoryPath = app_path("Repositories/{$name}Repository.php");

        // リポジトリが存在しなければ、リポジトリファイルを生成
        if (!File::exists($repositoryPath)) {
            $repositoryContent = <<<EOF
            <?php
            namespace App\Repositories;\n
            EOF;

            // インターフェース指定があれば `use` 宣言と実装を追加
            if ($interfaceOption) {
                $repositoryContent .= "use App\Repositories\\{$interfaceOption};\n\n";
                $repositoryContent .= "class {$name}Repository implements {$interfaceOption}\n";
            } else {
                $repositoryContent .= "class {$name}Repository\n";
            }

            $repositoryContent .= <<<EOF
            {
                public function get()
                {
                    // 実装内容
                    return "データ取得処理をここに追加";
                }
            }
            EOF;

            File::put($repositoryPath, $repositoryContent);
            $this->info("Repository created: {$repositoryPath}");
        } else {
            $this->error("Repository {$repositoryPath} already exists.");
        }

        return Command::SUCCESS;
    }
}
