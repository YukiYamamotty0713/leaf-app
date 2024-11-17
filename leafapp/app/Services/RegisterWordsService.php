<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Repositories\RegisterWordsRepositoryInterface;

class RegisterWordsService
{
    protected $RegisterWordsRepositoryInterface;

    public function __construct(RegisterWordsRepositoryInterface $RegisterWordsRepositoryInterface)
    {
        $this->RegisterWordsRepositoryInterface = $RegisterWordsRepositoryInterface;
    }

    public function get()
    {
        return $this->RegisterWordsRepositoryInterface->get();
    }

    public function store(Request $request)
    {
        $posts = $this->RegisterWordsRepositoryInterface->create([
           "word" => $request->word,
           "definition"=> $request->definition,
           "part_of_speech" => "名詞(テスト)",
        ]);

        return $posts;
    }
}