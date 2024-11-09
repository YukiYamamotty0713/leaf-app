<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
/**
 * リポジトリインターフェースから、コントローラーまで一貫して作成
 * --dir レンダリングするページのディレクトリを指定できる
 * --without-interface インターフェースは作成しない
 */
class MakeLayer extends Command
{
    protected $signature = 'make:layer {name} {--dir=default} {--without-interface}';
    protected $description = 'Generate a complete layer for a given entity: repository interface, repository, service, and controller';

    public function handle()
    {
        $name = $this->argument('name');
        $dir = $this->option('dir');  // Optional directory for Vue components
        $withoutInterface = $this->option('without-interface'); // Option to skip repository interface creation

        $this->info("Creating complete layer for {$name}");

        // 1. Repository Interface 作成 (オプションでスキップ)
        if (!$withoutInterface) {
            $this->call('make:repository-interface', ['name' => $name]);
        } else {
            $this->info("Skipping repository interface creation for {$name}");
        }

        // 2. Repository 作成
        $this->call('make:repository', [
            'name' => $name,
            '--interface' => !$withoutInterface ? "{$name}RepositoryInterface" : null,
        ]);

        // 3. Service 作成
        $this->call('make:service', ['name' => $name]);

        // 4. Controller 作成
        $this->call('make:service-controller', [
            'name' => $name,
            '--dir' => $dir
        ]);


        // 5. バインド登録（インターフェースがある場合のみ）
        if (!$withoutInterface) {
            $this->call('make:register-repository', ['name' => $name]);
        }

        
        $this->info("Complete layer created for {$name}");
    }
}
