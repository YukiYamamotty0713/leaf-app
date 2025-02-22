<?php

namespace App\Services;

use App\Repositories\MPartOfSpeechRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\RegisterWordsRepositoryInterface;
use App\Repositories\DailyActivityRepositoryInterface;
use App\Services\CommonService\AuthService;
use App\Adapters\Gemini;
use App\Utils\Prompt;
use Illuminate\Support\Facades\Log;
//品詞を取得したい
class RegisterWordsService
{
    protected $RegisterWordsRepositoryInterface;
    protected $MPartOfSpeechRepositoryInterface;
    protected $DailyActivityRepositoryInterface;
    protected $AuthService;
    protected $geminiClient;

    public function __construct(RegisterWordsRepositoryInterface $RegisterWordsRepositoryInterface, 
                                MPartOfSpeechRepositoryInterface $MPartOfSpeechRepositoryInterface,
                                DailyActivityRepositoryInterface $DailyActivityRepositoryInterface,
                                Gemini $geminiClient)
    {
        $this->RegisterWordsRepositoryInterface = $RegisterWordsRepositoryInterface;
        $this->MPartOfSpeechRepositoryInterface = $MPartOfSpeechRepositoryInterface;
        $this->DailyActivityRepositoryInterface = $DailyActivityRepositoryInterface;
        $this->geminiClient = $geminiClient;
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


        $this->DailyActivityRepositoryInterface->register();
        return $posts;
    }

    /**
     * ワードから例文を提案
     */
    public function suggestExampleSentence(Request $request) :array
    {

        $prompt = Prompt::suggestExamplePrompt(
            $request->word,
            $request->definition,
            $request->partOfSpeech
        );

        //GeminiAPIを利用して例文を提案
        $results = $this->geminiClient->generateText($prompt);

        //デコードを取り出す
        preg_match('/```json\n(.*)\n```/s', $results, $matches);
        $arrayString = trim($matches[1]);

        $decodedResult = json_decode($arrayString, true);
        return $decodedResult;
    }
}