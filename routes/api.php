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
Route::post("register", "API\AuthController@register");
Route::get("listtypeuser", "API\AuthController@getTipoUsuario");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', 'API\AuthController@login');

Route::get('cliente', 'ClienteController@index');
Route::get('cliente/{id}', 'ClienteController@listOne');
Route::post('cliente', 'ClienteController@store');
Route::put('cliente', 'ClienteController@update');
Route::delete('cliente/{id}', 'ClienteController@destroy');

//Route::middleware('auth:api')->post('/logout', 'API\AuthController@logout');