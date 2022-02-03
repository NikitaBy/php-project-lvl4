<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use App\Mail\InitMailtrapNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    Log::debug('Test debug message' . Carbon::now()->toAtomString());
    return view('welcome');
});

Route::resource('taskStatus', TaskStatusController::class);
Route::resource('task', TaskController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/send-mail', function () {

    Mail::to('newuser@example.com')->send(new InitMailtrapNotification());

    return 'A message has been sent to Mailtrap!';

});

require __DIR__.'/auth.php';
