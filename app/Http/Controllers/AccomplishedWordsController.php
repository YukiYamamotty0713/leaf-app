<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AccomplishedWordsService;
use Inertia\Inertia;

class AccomplishedWordsController extends Controller
{
    protected $service;
    public function __construct(AccomplishedWordsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $words = $this->service->get();
        return Inertia::render('User/AccomplishedWords/Index', [
            'words' => $words,
        ]);
    }
}
