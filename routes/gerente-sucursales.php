<?php 


Route::group(['prefix' => 'gerente-sucursales','middleware' => ['auth', 'CheckRoleGerenteSucursales']],function(){
	/*Route::get('/', function () {
	    return view('gerente-sucursales.index');
	});*/

	Route::get('/administracion-rutas','GerenciaSucursalesController@rutas');

	Route::get('/','GerenciaSucursalesController@index');

	Route::get('/destinos/{id}','GerenciaSucursalesController@destinos');
	Route::get('/vuelos/{origen}/{destino}','GerenciaSucursalesController@vuelos');
	Route::get('/vuelo/{id}','GerenciaSucursalesController@vuelo');
	
	Route::get('/consultar/disponibilidad/{salida}/{origen}/{destino}','GerenciaSucursalesController@consultarDisponibilidad');


	Route::post('/cancelar','GerenciaSucursalesController@CancelarVuelo');
	Route::post('/planificar','GerenciaSucursalesController@PlanificarVuelo');







});

 ?>