<?php

namespace App\Http\Controllers;

use Inertia\Inertia; 
use App\Services\MyWordsService;

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
}
