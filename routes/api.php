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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();



});*/
Route::apiResource('empresas','EmpresaController');
Route::apiResource('categorias','CategoriaController');
Route::apiResource('usuarios','UsuarioController');


/*listado de manera gerarquica*/

Route::get('emp/{id?}','OtroController@items')->name('Items.items');
Route::get('emp/{id?}/usuarios/{pk?}','OtroController@itemsdos')->name('test');