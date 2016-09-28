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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

/* Authenticate module */
Route::post('authenticate', 'AuthenticateController@authenticate');
Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');

Route::resource('khachhang', 'Admin\KhachHangController');

/* Khach hang dang ky thanh vien */
Route::post('user/register', 'AuthenticateController@register');

/* Khach hang dang ky server */
Route::post('serverrequest/create', 'ServerRequestController@create');
Route::get('serverrequest', 'ServerRequestController@index');