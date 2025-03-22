<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyWordsController;
use App\Http\Controllers\WordsQuestionController;
use App\Http\Controllers\RegisterWordsController;
use App\Http\Controllers\AccomplishedWordsController;
use Illuminate\Http\Request;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('my-words', [MyWordsController::class, 'index'])->name('mywords.index');
    Route::get('download_csv', [MyWordsController::class, 'download_csv'])->name('my_words.download_csv');

    Route::get('words-question', [WordsQuestionController::class, 'index'])->name('words-question.index'); 
    Route::get('register-words', [RegisterWordsController::class, 'index'])->name('register-words.index');
    Route::post('register-words', [RegisterWordsController::class, 'store'])->name('register-words.store');

    Route::post('api/accomplish/{id}', [MyWordsController::class, 'accomplish'])->name('mywords.accomplish');
    Route::delete('api/words/{id}', [MyWordsController::class, 'delete'])->name('mywords.delete');
    Route::post('api/extract-definitions', [RegisterWordsController::class, 'extractDefinitions'])->name('register-words.extract-definitions');
    Route::post('api/suggest', [RegisterWordsController::class, 'suggest'])->name('register-words.suggest');

    Route::get('accomplished-words', [AccomplishedWordsController::class, 'index'])->name('accomplished-words.index');
});

require __DIR__.'/auth.php';