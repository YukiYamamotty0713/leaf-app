<?php

namespace Tests\Unit;

use App\Adapters\Gemini;
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
            $this->assertIsString($results);
            $this->assertNotEmpty($results);
            //こんにちはが含まれているか
            $this->assertStringContainsString('こんにちは', $results);

        } catch (\Exception $e) {
            // API呼び出しが失敗した場合、テストを失敗させる
            $this->fail('API call failed: ' . $e->getMessage());
        }
    }

}