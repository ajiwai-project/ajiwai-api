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

Route::get('test', 'Ajiwai\Application\Controllers\HelloController@index');

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('users/me', 'Ajiwai\Application\Controllers\UserController@self');
});

Route::post('users', 'Ajiwai\Application\Controllers\UserController@create');
Route::post('login', 'Ajiwai\Application\Controllers\Auth\AuthController@login');
