<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//middleware auth:api 已經在config下的auth設定api的驗證方式走jwt (原本是用web驗證)

Route::middleware('auth:api')->group(function(){
    //Route::apiResource 可以把PostController裡面所有的規則一次建立起來
    Route::apiResource('posts','App\Http\Controllers\Api\PostController');
});

Route::group(['prefix'=>'auth','namespace'=>'App\Http\Controllers\Api'],function(){
    Route::get('/','AuthController@me')->name('me');
    Route::post('login','AuthController@login')->name('login');
    Route::post('logout','AuthController@logout')->name('logout');
});

