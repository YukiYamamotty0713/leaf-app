<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 *$signature: make:repository-interface {name} の形式で使用し、name はリポジトリインターフェースのエンティティ名です。
 * $description: コマンドの説明を設定します。
 * handle メソッド: コマンド実行時のメイン処理を行います。
 */

class MakeRepositoryInterface extends Command
{
    protected $signature = 'make:repository-interface {name}';
    protected $description = 'Generate a repository interface for a given entity';

    public function handle()
    {
        $name = $this->argument('name');
        $this->info("Creating repository interface for {$name}");

        // Repository Interface creation
        $repositoryInterfacePath = app_path("Repositories/{$name}RepositoryInterface.php");
        if (!File::exists($repositoryInterfacePath)) {
            $repositoryInterfaceContent = <<<EOF
            <?php

            namespace App\Repositories;

            interface {$name}RepositoryInterface
            {
                public function get();
            }
            EOF;
            File::put($repositoryInterfacePath, $repositoryInterfaceContent);
            $this->info("Repository Interface created: {$repositoryInterfacePath}");
        } else {
            $this->error("Repository Interface {$repositoryInterfacePath} already exists.");
        }
    }
}
