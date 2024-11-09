<?php
namespace App\Repositories;
use App\Repositories\TestRepositoryInterface;

class TestRepository implements TestRepositoryInterface
{
    public function get()
    {
        // 実装内容
        return "データ取得処理をここに追加";
    }
}