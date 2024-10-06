<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenAIController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/chat', function () {
    // Session::flush();
    return view('chat');
});

Route::get('/start-questionnaire', [OpenAIController::class, 'startQuestionnaire']);
Route::get('/nextQuestion/{id}', [OpenAIController::class, 'nextQuestion']);

Route::get('/readExcel', [OpenAIController::class, 'readExcel']);
Route::get('/chatting', [OpenAIController::class, 'chat']);
//New routing
Route::post('/submitAnswer', [OpenAIController::class, 'submitAnswer']);
Route::post('/removeAnswer', [OpenAIController::class, 'removeAnswer']);
Route::get('/saveQuestions', [OpenAIController::class, 'saveQuestions']);
Route::post('/saveMarks', [OpenAIController::class, 'saveMarks']);
Route::get('/result', [OpenAIController::class, 'result']);
Route::post('/saveResult', [OpenAIController::class, 'saveResult']);
Route::post('/chatResponse', [OpenAIController::class, 'chatResponse']);
//End routing
// Route::get('/start-test', [OpenAIController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';