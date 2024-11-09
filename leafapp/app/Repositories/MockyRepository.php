<?php
namespace App\Repositories;
use App\Repositories\MockyRepositoryInterface;

class MockyRepository implements MockyRepositoryInterface
{
    public function get()
    {
        // 実装内容
        return "データ取得処理をここに追加";
    }
}