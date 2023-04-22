<?php

use Illuminate\Http\Request;
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
Route::group(['prefix' => 'v1'], function() {
    Route::get('/getRate', \App\Http\Controllers\ConstantReferences\GetRateController::class);
    Route::get('/getTable', \App\Http\Controllers\ConstantReferences\GetTableController::class);
    Route::get('/getConstant', \App\Http\Controllers\Constant\IndexController::class);
});
