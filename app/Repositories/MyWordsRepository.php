<?php
namespace App\Repositories;
use App\Repositories\MyWordsRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\UserWord;
use Illuminate\Support\Facades\Auth;
class MyWordsRepository implements MyWordsRepositoryInterface
{
    /**
     * UserWordを全て取得する。
     * @param void
     * @return Collection<UserWord>
     * @throws \RuntimeException
     */
    public function get() : Collection | UserWord | null
    {
        $words = UserWord::with('mPartOfSpeech')
                 ->where('user_id', Auth::user()->id)
                 ->where('has_accomplished', false)
                 ->get();
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

    public function accomplish(int $id) : void
    {
        $word = UserWord::find($id);
        $word->has_accomplished = true;
        $word->save();
    }

    /**
     * 達成した単語をすべて取得する
     * @param void
     * @return Collection<UserWord>
     * @throws \RuntimeException
     */
    public function getAccomplishedWords() : Collection | UserWord | null
    {
        $words = UserWord::with('mPartOfSpeech')
                 ->where('user_id', Auth::user()->id)
                 ->where('has_accomplished', true)
                 ->get();
        return $words;
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