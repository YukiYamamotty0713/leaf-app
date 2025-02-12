<?php

namespace App\Http\Controllers;

use Inertia\Inertia; 
use Illuminate\Http\JsonResponse;
use App\Services\MyWordsService;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * 自分の単語リストページを返すためのコントローラー
 * index() : 全リストを返す。
 * 
 */
class MyWordsController extends Controller
{

    protected $service;

    /**
     * to generate service class
     */
    public function __construct(MyWordsService $service){
        $this->service = $service;
    }

    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        $my_words = $this->service->get();
        return Inertia::render('User/MyWords/Index', [
            'data' => $my_words, //単語リスト
        ]);
    }

    public function delete($id) : JsonResponse
    {
        $response = $this->service->delete($id);
        return $response;
    }

    public function download_csv() :StreamedResponse
    {
        $response = $this->service->download_csv();
        return $response;
    }
}
