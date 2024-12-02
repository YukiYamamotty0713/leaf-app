<?php
namespace App\Repositories;
use App\Repositories\MyWordsRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\UserWord;
use Illuminate\Http\JsonResponse;

class MyWordsRepository implements MyWordsRepositoryInterface
{
    /**
     * UserWordを全て取得する。
     * @param void
     * @return Collection<UserWord>
     * @throws \RuntimeException
     */
    public function get() : ?Collection
    {
            $words = UserWord::with('mPartOfSpeech')->get();
            return $words;

    }

    /**
     * 指定したIDのUserWordを取得する。
     * @param int $id
     * @return UserWord|null
     */
    public function find(int $id) : ?UserWord 
    {
        $word = UserWord::find($id);
        return $word;
    }

    /**
     * 指定したIDのUserWordを削除する。
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $word = UserWord::findOrFail($id);
        $word->delete();
    }
}