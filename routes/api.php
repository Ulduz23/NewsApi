<?php

use App\Http\Controllers\Api\v1\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('/news')->name('news.')->controller(NewsController::class)->group(function () {
    Route::get('/all','index');
    Route::get('/show/{news}','show');
    Route::post('/create','store');
    Route::put('/update/{news}','update');
    Route::delete('delete/{news}','destroy');
});
