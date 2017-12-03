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
    return view('auth/login');
});


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['prefix' => 'inicio','middleware' => ['auth', 'CheckRole']],function(){
		Route::get('/', function () {
		    return view('home');
		});
});

require 'gerencia-general.php';
require 'gerente-sucursales.php';
require 'taquilla.php';
require 'subgerente-sucursal.php';

Route::get('/p', function () {
    return view('prueba');
});
Route::post('/p','ControllerP@guardar');