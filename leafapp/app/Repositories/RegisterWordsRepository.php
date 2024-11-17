<?php

namespace App\Repositories;

use App\Repositories\RegisterWordsRepositoryInterface;
use App\Models\MWord;

class RegisterWordsRepository implements RegisterWordsRepositoryInterface
{
    /**
     * 英単語の一覧を取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        return MWord::all();
    }

    /**
     * 新しい英単語を作成
     * @param array $data 英単語のデータ（例: ['word' => 'apple', 'description' => 'りんご']）
     * @return MWord 作成されたMWordモデルインスタンス
     */
    public function create(array $data) :MWord
    {
        $m_word = MWord::create($data);
        return $m_word;
    }
}
