<?php

namespace Tests\Unit;

use App\Adapters\Gemini;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class GeminiTest extends TestCase
{
    /**
     * @var GeminiClient
     */
    protected $geminiClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->geminiClient = new Gemini();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @group integration
     */
    public function test_generate_text_returns_array_of_strings()
    {
        // プロンプトを設定
        $prompt = "Translate 'hello' to Japanese";

        try {
            // GeminiClientのgenerateTextメソッドを実行
            $results = $this->geminiClient->generateText($prompt);
            // 結果が配列であることをアサート
            $this->assertIsArray($results);
            $this->assertNotEmpty($results);
            //こんにちはが含まれているか
            $this->assertContains('こんにちは', $results);
            // 結果が空でない場合、各要素が文字列であることをアサート
            if (!empty($results)) {
                foreach ($results as $result) {
                    $this->assertIsString($result);
                }
            }
        } catch (\Exception $e) {
            // API呼び出しが失敗した場合、テストを失敗させる
            $this->fail('API call failed: ' . $e->getMessage());
        }
    }

}