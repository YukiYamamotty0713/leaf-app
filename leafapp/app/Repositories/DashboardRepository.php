<?php
namespace App\Repositories;

use App\Repositories\DashboardRepositoryInterface;
use App\Models\UserWord;
use Illuminate\Support\Facades\Auth; // 修正: Authクラスを正しくインポート
use App\Enums\MPartOfSpeech;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function get()
    {
        // 実装内容
        return "データ取得処理をここに追加";
    }

    public function getAll()
    {   
        $userId = Auth::id();
        $words = UserWord::where('user_id', $userId)->get();
        return $words;
    }

    public function count(MPartOfSpeech $partOfSpeech): int
    {
        return UserWord::where('part_of_speech_id', $partOfSpeech->value)->count();
    }
}