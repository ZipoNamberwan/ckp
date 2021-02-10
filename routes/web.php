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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resources(['settings' => 'App\Http\Controllers\SettingController']);
    });

    Route::group(['middleware' => ['role:coordinator|subcoordinator']], function () {
        Route::resources(['ratings' => 'App\Http\Controllers\RatingController']);
        Route::resources(['users' => 'App\Http\Controllers\UserController']);
        Route::get('/monitoring', [App\Http\Controllers\MonitoringController::class, 'index']);
    });

    Route::group(['middleware' => ['role:coordinator|subcoordinator|staf']], function () {
        Route::get('/ckps/year/{year}', [App\Http\Controllers\CkpController::class, 'ckpByYear']);
        Route::post('/ckps/deleteallactivities', [App\Http\Controllers\CkpController::class, 'deleteAllActivities']);
        Route::resources(['ckps' => 'App\Http\Controllers\CkpController']);
        Route::get('/download', [App\Http\Controllers\DownloadController::class, 'index']);
        Route::post('/download', [App\Http\Controllers\DownloadController::class, 'download']);
    });
});
