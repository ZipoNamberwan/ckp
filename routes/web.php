<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    //
});

Route::group(['middleware' => ['role:coordinator|subcoordinator']], function () {
    Route::get('/ratings', [App\Http\Controllers\RatingController::class, 'index'])->name('ratings');
});

Route::resources(['ckps' => 'App\Http\Controllers\CkpController']);
Route::post('/ckps/deleteallactivities', [App\Http\Controllers\CkpController::class, 'deleteAllActivities']);


