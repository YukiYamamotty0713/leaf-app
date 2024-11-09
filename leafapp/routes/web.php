<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyWordsController;
use App\Http\Controllers\WordsQuestionController;
use Illuminate\Foundation\Application;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
    Route::get('sample', [SampleController::class, 'index'])->name('sample.index');
    });


Route::middleware('auth')->group(function () {
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('my-words', [MyWordsController::class, 'index'])->name('mywords.index');
    Route::get('words-question', [WordsQuestionController::class, 'index'])->name('words-question.index'); //tests
});


require __DIR__.'/auth.php';