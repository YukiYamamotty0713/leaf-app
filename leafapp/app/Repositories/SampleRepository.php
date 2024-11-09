<?php
namespace App\Repositories;
use App\Repositories\SampleRepositoryInterface;

class SampleRepository implements SampleRepositoryInterface
{
    public function get()
    {
        // 実装内容
        return "Sampleのデータ取得処理をここに追加";
    }
}