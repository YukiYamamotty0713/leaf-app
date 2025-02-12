<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyWordsController;
use App\Http\Controllers\WordsQuestionController;
use App\Http\Controllers\RegisterWordsController;
use App\Http\Controllers\WebSocketController;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('my-words', [MyWordsController::class, 'index'])->name('mywords.index');
    Route::get('download_csv', [MyWordsController::class, 'download_csv'])->name('my_words.download_csv');
    Route::delete('api/words/{id}', [MyWordsController::class, 'delete'])->name('mywords.delete');

    Route::get('websocket', function () {
        return Inertia::render('User/WebSocket/Index');
    });

    Route::post('/send-message', function (Request $request) {
        $socketId = $request->input('socket_id'); // フロントエンドから送信された socket_id を受け取る
        broadcast(new MessageSent($request->message, $socketId));
        return response()->json(['status' => 'Message sent!']);
    });

    Route::get('words-question', [WordsQuestionController::class, 'index'])->name('words-question.index'); 
    Route::get('register-words', [RegisterWordsController::class, 'index'])->name('register-words.index');
    Route::post('register-words', [RegisterWordsController::class, 'store'])->name('register-words.store');
});

require __DIR__.'/auth.php';