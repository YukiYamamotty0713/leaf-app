<?php

namespace App\Http\Controllers;

use App\Services\TestService;
use Inertia\Inertia;

class TestController extends Controller
{
    protected $TestService;

    public function __construct(TestService $TestService)
    {
        $this->TestService = $TestService;
    }

    public function index()
    {
        // サービスメソッドの利用例
        $data = $this->TestService->get();

        // InertiaでVueコンポーネントをレンダリング
        return Inertia::render('User/Test', [
            'data' => $data,
        ]);
    }
}