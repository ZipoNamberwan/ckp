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

    Route::get('/monitoring', [App\Http\Controllers\MonitoringController::class, 'index']);

    Route::group(['middleware' => ['role:supervisor']], function () {
        Route::resources(['ratings' => 'App\Http\Controllers\RatingController']);
    });

    Route::get('/ckps/{ckp}', [App\Http\Controllers\CkpController::class, 'show'])->middleware(['role:admin|supervisor|user']);

    Route::group(['middleware' => ['role:supervisor|user']], function () {
        Route::get('/ckps/year/{year}', [App\Http\Controllers\CkpController::class, 'ckpByYear']);
        Route::post('/ckps/deleteallactivities', [App\Http\Controllers\CkpController::class, 'deleteAllActivities']);
        //Route::resources(['ckps' => 'App\Http\Controllers\CkpController']);

        Route::get('/ckps', [App\Http\Controllers\CkpController::class, 'index']);
        Route::patch('/ckps/{type}/{ckp}/', [App\Http\Controllers\CkpController::class, 'update']);
        Route::get('/ckps/{type}/{ckp}/edit', [App\Http\Controllers\CkpController::class, 'edit']);
        Route::get('/download', [App\Http\Controllers\DownloadController::class, 'index']);
        Route::post('/download', [App\Http\Controllers\DownloadController::class, 'download']);
    });
});
