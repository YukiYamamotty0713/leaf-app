<?php
namespace App\Repositories;
use App\Repositories\MyWordsRepositoryInterface;
use App\Models\MWord;

class MyWordsRepository implements MyWordsRepositoryInterface
{

    public function get()
    {
        $words = MWord::all();
        return $words;
    }

    public function first()
    {
        return "実装予定";
    }

}