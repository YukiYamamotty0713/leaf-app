<?php

namespace App\Http\Controllers;

use App\Services\RegisterWordsService;
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
        $data = $this->RegisterWordsService->get();

        // InertiaでVueコンポーネントをレンダリング
        return Inertia::render('RegisterWords', [
            'data' => $data,
        ]);
    }
}