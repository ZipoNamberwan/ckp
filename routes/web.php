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

    Route::resources(['settings' => 'App\Http\Controllers\SettingController']);
    Route::resources(['users' => 'App\Http\Controllers\UserController']);
    Route::resources(['departments' => 'App\Http\Controllers\DepartmentController']);

    Route::delete('/years/{year}', [App\Http\Controllers\SettingController::class, 'destroyYear']);
    Route::patch('/years/{year}', [App\Http\Controllers\SettingController::class, 'updateYear']);
    Route::get('/years/create', [App\Http\Controllers\SettingController::class, 'createYear']);
    Route::get('/years/{year}/edit', [App\Http\Controllers\SettingController::class, 'editYear']);
    Route::post('/years', [App\Http\Controllers\SettingController::class, 'storeYear']);

    Route::group(['middleware' => ['role:coordinator|subcoordinator']], function () {
        Route::resources(['ratings' => 'App\Http\Controllers\RatingController']);
        Route::get('/monitoring', [App\Http\Controllers\MonitoringController::class, 'index']);
    });

    Route::group(['middleware' => ['role:coordinator|subcoordinator|staf']], function () {
        Route::get('/ckps/year/{year}', [App\Http\Controllers\CkpController::class, 'ckpByYear']);
        Route::post('/ckps/deleteallactivities', [App\Http\Controllers\CkpController::class, 'deleteAllActivities']);
        //Route::resources(['ckps' => 'App\Http\Controllers\CkpController']);

        Route::get('/ckps', [App\Http\Controllers\CkpController::class, 'index']);
        Route::get('/ckps/{ckp}', [App\Http\Controllers\CkpController::class, 'show']);
        Route::get('/ckps/ckpt/{ckp}/edit', [App\Http\Controllers\CkpController::class, 'editCkpT']);
        Route::get('/ckps/ckpr/{ckp}/edit', [App\Http\Controllers\CkpController::class, 'editCkpR']);
        Route::patch('/ckps/ckpt/{ckp}', [App\Http\Controllers\CkpController::class, 'updateCkpT']);
        Route::patch('/ckps/ckpr/{ckp}', [App\Http\Controllers\CkpController::class, 'updateCkpR']);
        Route::get('/download', [App\Http\Controllers\DownloadController::class, 'index']);
        Route::post('/download', [App\Http\Controllers\DownloadController::class, 'download']);
    });
});
