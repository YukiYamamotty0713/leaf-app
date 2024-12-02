<?php

namespace App\Repositories;

use Illuminate\Support\Collection; // コレクション型を使用する場合
use App\Models\UserWord; // Wordモデルを使用する場合

interface RegisterWordsRepositoryInterface
{
    /**
     * @return Collection Wordの一覧
     */
    public function get();

    /**
     * 新しい英単語を作成
     *
     * @param array $data 作成する英単語のデータ（例: ['word' => 'apple', 'definition' => 'りんご']）
     * @return Word 作成されたWordモデル
     */
    public function create(array $data): UserWord;
}
