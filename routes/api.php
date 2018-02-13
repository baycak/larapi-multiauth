<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'ApiController@login');
Route::middleware(['auth:api', 'jwt.auth'])->group(function(){
    Route::get('auth/user', 'ApiController@user');
    Route::post('auth/logout', 'ApiController@logout');
});

Route::namespace('Admin')->prefix('admin')->group(function(){
    Route::post('login', 'AuthController@login');
    Route::middleware(['auth:admin-api', 'jwt.auth'])->group(function(){
        Route::get('auth/user', 'AuthController@user');
        Route::post('auth/logout', 'AuthController@logout');
    });
});

Route::middleware('jwt.refresh')->get('token/refresh', 'ApiController@refresh');
