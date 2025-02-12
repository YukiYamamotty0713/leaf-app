<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

/**
 * Class MakeServiceControllerTest
 * 
 * 'make:service-controller' Artisanコマンドのテストクラスです。
 * このテストは、サービスコントローラーが期待通りに作成されるかを確認します。
 *
 * @package Tests\Feature
 */
class MakeServiceControllerTest extends TestCase
{
    protected $controllerPath;
    protected $controllerName = 'Test'; 
    protected $dir = 'TestPageDir';  //pageのディレクトリを返すInertiaが生成されるため
    /**
     * 各テストの前に実行される準備処理。
     * コントローラーパスを初期化し、既存のコントローラーがあれば削除します。
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->controllerPath = app_path("Http/Controllers/{$this->controllerName}Controller.php");
        if (File::exists($this->controllerPath)) {
            File::delete($this->controllerPath);
        }
    }

    /**
     * 各テスト後の後処理。
     * 作成されたコントローラーファイルがあれば削除してクリーンアップします。
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        // 作成されたコントローラーがあれば削除
        if (File::exists($this->controllerPath)) {
            File::delete($this->controllerPath);
        }
    }

    /**
     * サービスコントローラーが正常に作成されることをテスト。
     * 'make:service-controller' コマンドを実行し、コントローラーが作成されることを確認します。
     * @return void
     */
    public function test_service_controller_is_created()
    {
        $result = Artisan::call('make:service-controller', [
            'name' => $this->controllerName,
            '--dir' => $this->dir,
        ]);
        $this->assertEquals(0, $result);
        $this->assertTrue(File::exists($this->controllerPath));
        $controllerContent = File::get($this->controllerPath);
        $this->assertStringContainsString("use App\Services\\{$this->controllerName}Service;", $controllerContent);
        $this->assertStringContainsString("class {$this->controllerName}Controller", $controllerContent);
    }

    /**
     * コントローラーがすでに存在する場合にエラーメッセージが表示されることをテスト。
     * すでにコントローラーが存在する場合、適切なエラーメッセージが表示されるかを確認します。
     * @return void
     */
    public function test_controller_returns_error_if_already_exists()
    {
        // 中身が空のコントローラーファイルを作成して、入力されたコントローラーが既にある状態をシミュレート
        File::put($this->controllerPath, ''); 
        $result = Artisan::call('make:service-controller', [
            'name' => $this->controllerName,
        ]);
        \Log::debug($result);
        $this->assertNotEquals(0, $result);
    }
}
