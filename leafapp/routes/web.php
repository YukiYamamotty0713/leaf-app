<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyWordsController;
use App\Http\Controllers\WordsQuestionController;

Route::middleware('auth')->group(function () {
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('my-words', [MyWordsController::class, 'index'])->name('mywords.index');
    Route::get('words-question', [WordsQuestionController::class, 'index'])->name('words-question.index'); //tests
});

require __DIR__.'/auth.php';