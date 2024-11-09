<?php

namespace App\Http\Controllers;

use App\Services\SampleService;
use Inertia\Inertia;

class SampleController extends Controller
{
    protected $SampleService;

    public function __construct(SampleService $SampleService)
    {
        $this->SampleService = $SampleService;
    }

    public function index()
    {
        // サービスメソッドの利用例
        $data = $this->SampleService->get();

        // InertiaでVueコンポーネントをレンダリング
        return Inertia::render('User/Sample', [
            'data' => $data,
        ]);
    }
}