<?php

namespace App\Services;

use App\Repositories\MPartOfSpeechRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\RegisterWordsRepositoryInterface;
use App\Repositories\DailyActivityRepositoryInterface;
use App\Services\CommonService\AuthService;

class RegisterWordsService
{
    protected $RegisterWordsRepositoryInterface;
    protected $MPartOfSpeechRepositoryInterface;
    protected $DailyActivityRepositoryInterface;
    protected $AuthService;

    public function __construct(RegisterWordsRepositoryInterface $RegisterWordsRepositoryInterface, 
                                MPartOfSpeechRepositoryInterface $MPartOfSpeechRepositoryInterface,
                                DailyActivityRepositoryInterface $DailyActivityRepositoryInterface)
    {
        $this->RegisterWordsRepositoryInterface = $RegisterWordsRepositoryInterface;
        $this->MPartOfSpeechRepositoryInterface = $MPartOfSpeechRepositoryInterface;
        $this->DailyActivityRepositoryInterface = $DailyActivityRepositoryInterface;
        $this->AuthService = new AuthService();
    }

    public function get()
    {   
        $title = "あなたの覚えたい英単語を登録してください。";
        $mPartOfSpeech = $this->MPartOfSpeechRepositoryInterface->get();
        $data = [
            "title" => $title,
            "mPartOfSpeech" => $mPartOfSpeech
        ];
        return $data;
    }


    public function store(Request $request)
    {
        $posts = $this->RegisterWordsRepositoryInterface->create([
           "word" => $request->word,
           "user_id" => $this->AuthService->get_id(),
           "definition"=> $request->definition,
           "part_of_speech_id" => $request->PartOfSpeech['id'],
            "example_sentence" => $request->exampleSentence,
            "note" => $request->note
        ]);


        //DailyActivityRepositoryInterfaceに登録
        $this->DailyActivityRepositoryInterface->register();
        return $posts;
    }
}