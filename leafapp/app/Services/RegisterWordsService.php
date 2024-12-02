<?php

namespace App\Services;

use App\Repositories\MPartOfSpeechRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\RegisterWordsRepositoryInterface;
use App\Services\CommonService\AuthService;
class RegisterWordsService
{
    protected $RegisterWordsRepositoryInterface;
    protected $MPartOfSpeechRepositoryInterface;
    protected $AuthService;

    public function __construct(RegisterWordsRepositoryInterface $RegisterWordsRepositoryInterface, 
                                MPartOfSpeechRepositoryInterface $MPartOfSpeechRepositoryInterface)
    {
        $this->RegisterWordsRepositoryInterface = $RegisterWordsRepositoryInterface;
        $this->MPartOfSpeechRepositoryInterface = $MPartOfSpeechRepositoryInterface;
        $this->AuthService = new AuthService();
    }

    public function get()
    {   
        $title = "ここでは自分の覚えたい英単語を登録できます";
        $m_part_of_speech = $this->MPartOfSpeechRepositoryInterface->get();
        $data = [
            "title" => $title,
            "m_part_of_speech" => $m_part_of_speech
        ];
        return $data;
    }


    public function store(Request $request)
    {
        $posts = $this->RegisterWordsRepositoryInterface->create([
           "word" => $request->word,
           "user_id" => $this->AuthService->get_id(),
           "definition"=> $request->definition,
           "part_of_speech_id" => $request->part_of_speech,
        ]);

        return $posts;
    }
}