<?php

namespace App\Repositories;

use App\Models\MWord;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;

interface MyWordsRepositoryInterface
{
    /**
     * MWordを全て取得する。
     * @param void
     * @return MWord
     * @throws \RuntimeException
     */
    public function get();

    /**
     * 指定したIDのMWordを取得する。
     * 
     * @param int $id
     * @return MWord|null
     */
    public function find(int $id) : ?MWord;

    /**
     * 指定したIDのMWordを削除する。
     * 
     * @param int $id
     * @return　JSONResponse
     */
    public function delete(int $id): void;
}