<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginFeatureTest extends TestCase
{
    use RefreshDatabase; // マイグレーションを実行し、テストごとにデータベースをリセット

    protected function setUp(): void
    {
        parent::setUp();

        // テストの前にユーザーテーブルをTruncate
        \DB::table('users')->truncate();

        // 必要に応じて新しいユーザーを作成
        $this->user = \App\Models\User::factory()->create([
            'name' => 'testaro',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_example()
    {
        // ログインなどのテストをここに書く
        $response = $this->actingAs($this->user)->get('/');

        $response->assertStatus(200);
    }
}