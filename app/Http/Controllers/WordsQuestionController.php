<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class WordsQuestionController extends Controller
{
    public function index()
    {
        return Inertia::render('User/WordsQuestion/Index');
    }

}
