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
    protected $fileContent;

    public function handle()
    {
        $name = $this->argument('name');
        $fileContent =  <<<EOF
        <?php

        namespace App\Repositories;

        interface {$name}RepositoryInterface
        {
            public function get();
        }
        EOF;

        $this->info("Creating repository interface for {$name}");
        $repositoryInterfacePath = app_path("Repositories/{$name}RepositoryInterface.php");
        //ファイルがなければ作成し、インターフェースのコードを記述する。
        if (!File::exists($repositoryInterfacePath)) {
            File::put($repositoryInterfacePath, $fileContent);
            $this->info("Repository Interface created: {$repositoryInterfacePath}");
        } else {
            //ファイルパスがすでに存在する場合。
            $this->error("Repository Interface {$repositoryInterfacePath} already exists.");
        }
    }

}
