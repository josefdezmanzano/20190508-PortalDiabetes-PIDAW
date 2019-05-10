<?php

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

Route::get('/', function () {
    return view('index');
});

Route::resource('usuario','HiloController');//esto lo ponemos nosotros para que funcionen las vistas
Route::resource('usuario','MedicionController');//esto lo ponemos nosotros para que funcionen las vistas
Route::resource('usuario','RecomendacionController');//esto lo ponemos nosotros para que funcionen las vistas
Route::resource('usuario','RolController');//esto lo ponemos nosotros para que funcionen las vistas
Route::resource('usuario','TemaController');//esto lo ponemos nosotros para que funcionen las vistas
Route::resource('usuario','UsuarioController');//esto lo ponemos nosotros para que funcionen las vistas
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
