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
})->name('index');


Route::resource('mediciones','MedicionController');//esto lo ponemos nosotros para que funcionen las vistas
Route::resource('recomendaciones','RecomendacionController');//esto lo ponemos nosotros para que funcionen las vistas

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


