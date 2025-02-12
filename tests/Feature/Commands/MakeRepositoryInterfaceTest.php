<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class MakeRepositoryInterfaceTest extends TestCase
{
    protected $repositoryName;
    protected $repositoryPath;
    protected $expectedContent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryName = 'TestEntity';
        $this->repositoryPath = app_path("Repositories/{$this->repositoryName}RepositoryInterface.php");

        // 作成されるべきインターフェースファイルの期待する内容を定義
        $this->expectedContent = <<<EOF
        <?php

        namespace App\Repositories;

        interface {$this->repositoryName}RepositoryInterface
        {
            public function get();
        }
        EOF;
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        if (File::exists($this->repositoryPath)) {
            File::delete($this->repositoryPath);
        }
    }

    public function testRepositoryInterfaceIsCreatedWhenNotExists()
    {
        // コマンドを実行してリポジトリインターフェースを作成
        
        Artisan::call('make:repository-interface', ['name' => $this->repositoryName]);
        $output = Artisan::output();
        $fileContent = File::get($this->repositoryPath);

        $this->assertStringContainsString("Creating repository interface for {$this->repositoryName}", $output);
        $this->assertStringContainsString("Repository Interface created: {$this->repositoryPath}", $output);
        $this->assertTrue(File::exists($this->repositoryPath), "Failed asserting that file '{$this->repositoryPath}' exists.");
        $this->assertStringContainsString("<?php", $fileContent);
        $this->assertStringContainsString("interface", $fileContent);
        $this->assertStringContainsString("function", $fileContent);


    }

    public function testRepositoryInterfaceAlreadyExists()
    {
        //重複環境を作成
        File::put($this->repositoryPath, $this->expectedContent);
        Artisan::call('make:repository-interface', ['name' => $this->repositoryName]);
        $output = Artisan::output();
        $this->assertStringContainsString("Repository Interface {$this->repositoryPath} already exists.", $output);
    }
}
