<?php

namespace App\Repositories;

use App\Models\UserWord;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;

interface MyWordsRepositoryInterface
{
    /**
     * UserWordを全て取得する。
     * @param void
     * @return UserWord
     * @throws \RuntimeException
     */
    public function get();

    /**
     * 指定したIDのUserWordを取得する。
     * 
     * @param int $id
     * @return UserWord|null
     */
    public function find(int $id) : ?UserWord;

    /**
     * 指定したIDのUserWordを削除する。
     * 
     * @param int $id
     * @return　JSONResponse
     */
    public function delete(int $id): void;
}