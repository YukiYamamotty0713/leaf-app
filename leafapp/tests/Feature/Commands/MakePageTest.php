<?php
namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class MakePageTest extends TestCase
{
    protected $argPage = "Tests";  // 拡張子なしのファイル名
    protected $argPath;
    protected $fullpath;

    protected function setUp(): void
    {
        parent::setUp();
        $this->argPath = resource_path('js/Pages/User/');
        $this->fullpath = $this->argPath . $this->argPage . '.vue';  // 一貫して.vueを付与
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        if (File::exists($this->fullpath)) {  // 正しいパスをチェック
            File::delete($this->fullpath);
        }
    }

    public function test_page_is_created_correctly(): void
    {
        // make:page コマンド実行
        Artisan::call('make:page', [
            'name' => $this->argPage,  // 拡張子なしで渡す
        ]);

        // アサーション
        $this->assertFileExists($this->fullpath); // 正しいパスをチェック
        $this->assertFileIsReadable($this->fullpath); // 正しいパスをチェック

        // ファイルの内容を検証
        $fileContent = File::get($this->fullpath);
        $this->assertStringContainsString('template', $fileContent);
    }
}