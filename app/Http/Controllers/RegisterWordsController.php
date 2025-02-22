<?php

namespace App\Http\Controllers;

use App\Services\RegisterWordsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\RegisterWordsRequest;
class RegisterWordsController extends Controller
{
    protected $RegisterWordsService;

    public function __construct(RegisterWordsService $RegisterWordsService)
    {
        $this->RegisterWordsService = $RegisterWordsService;
    }

    public function index()
    {
        // サービスメソッドの利用例
        $data = $this->RegisterWordsService->get();
        return Inertia::render('User/MyWords/RegisterWords', [
            "data" => $data
        ]);
    }

    /**
     * ワードをポストするときに発動する関数
     * リダイレクト先は、"/register-words"/
     */
    public function store(RegisterWordsRequest $request)
    {
        $this->RegisterWordsService->store($request);
        return Inertia::render('User/MyWords/RegisterWords', [
            "data" => $this->RegisterWordsService->get(),
        ]);      
    }

    /**
     * GeminiAPIよりワードから例文を提案
     */
    public function suggest(Request $request)
    {
       //$response = $this->getSuggestedMock();
       $response = $this->RegisterWordsService->suggestExampleSentence($request);
       return response()->json($response);
    }


    /**
     * 提案データが以下のとおりである
    *0:{example: 'The Gemini constellation is easily recognizable in the night sky during the winter months.'}
    *1:{example: "My astrological sign is Gemini, which means I'm said to be communicative and adaptable."}
    *2:{example: "NASA's Project Gemini helped pave the way for the Apollo moon landings."}
    */
    private function getSuggestedMock()
    {
        return [
            [
                "example" => "The Gemini constellation is easily recognizable in the night sky during the winter months."
            ],
            [
                "example" => "My astrological sign is Gemini, which means I'm said to be communicative and adaptable."
            ],
            [
                "example" => "NASA's Project Gemini helped pave the way for the Apollo moon landings."
            ]
        ];
    }
}