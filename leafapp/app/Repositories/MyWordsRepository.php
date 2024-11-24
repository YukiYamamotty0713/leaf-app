<?php
namespace App\Repositories;
use App\Repositories\MyWordsRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\MWord;
use Illuminate\Http\JsonResponse;

class MyWordsRepository implements MyWordsRepositoryInterface
{
    /**
     * MWordを全て取得する。
     * @param void
     * @return Collection<MWord>
     * @throws \RuntimeException
     */
    public function get() : ?Collection
    {
        try { 
            $words = MWord::all();
            return $words;

        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to fetch words.', 0, $e);
        }
    }

    /**
     * 指定したIDのMWordを取得する。
     * @param int $id
     * @return MWord|null
     */
    public function find(int $id) : ?MWord 
    {
        $word = MWord::find($id);
        return $word;
    }

    /**
     * 指定したIDのMWordを削除する。
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $word = MWord::findOrFail($id);
        $word->delete();
    }
}