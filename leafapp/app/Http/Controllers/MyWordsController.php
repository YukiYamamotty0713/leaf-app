<?php

namespace App\Http\Controllers;

//use App\Models\MyWord;
use Inertia\Inertia; 

class MyWordsController extends Controller
{
    /**
     * Display a listing of the MyWords.
     * @return \Inertia\Response
     */
    public function index()
    {
        //$myWords = MyWord::all(); 

        // Inertiaで返す
        return Inertia::render('User/MyWords/Index', [
           // 'myWords' => $myWords  // Vueコンポーネントに渡す
        ]);
    }
}
