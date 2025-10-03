<?php

use App\Events\MyEvent;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;


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
    return view('welcome');
});

Route::get('event', [TestController::class, 'show']);

Route::get('fire', function () {
    event(new MyEvent('awsoem'));
});

Route::get('check', [TestController::class, 'index']);

Route::post('store', [TestController::class, 'store'])->name('store');

Route::resource('post', PostController::class);
