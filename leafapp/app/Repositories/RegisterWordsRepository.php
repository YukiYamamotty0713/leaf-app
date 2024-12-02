<?php

namespace App\Repositories;

use App\Repositories\RegisterWordsRepositoryInterface;
use App\Models\UserWord;

class RegisterWordsRepository implements RegisterWordsRepositoryInterface
{
    /**
     * 英単語の一覧を取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        return UserWord::with('m_part_of_speech')->all();
    }
    /**
     * 新しい英単語を作成
     * @param array $data 英単語のデータ（例: ['word' => 'apple', 'description' => 'りんご']）
     * @return UserWord 作成されたMWordモデルインスタンス
     */
    public function create(array $data) :UserWord
    {
        $user_word = UserWord::with('m_part_of_speech')->create($data);
        return $user_word;
    }
}
