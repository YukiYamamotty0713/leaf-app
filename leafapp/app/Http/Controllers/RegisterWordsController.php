<?php

namespace App\Http\Controllers;

use App\Services\RegisterWordsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        //$data = $this->RegisterWordsService->get();
        return Inertia::render('User/MyWords/RegisterWords', [
        ]);
    }
    /**
     * ワードをポストするときに発動する関数
     * リダイレクト先は、"/register-words"/
     * 
     */
    public function store(Request $request)
    {
        //リクエストで受け取った値をポスト
        $post_data = $this->RegisterWordsService->store($request);
        return Inertia::render('User/MyWords/RegisterWords', [
        ]);      
    }
}