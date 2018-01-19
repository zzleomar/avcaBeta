<?php 


Route::group(['prefix' => 'gerente-sucursales','middleware' => ['auth', 'CheckRoleGerenteSucursales']],function(){
	/*Route::get('/', function () {
	    return view('gerente-sucursales.index');
	});*/
	Route::get('/administracion-aeronaves','GerenciaSucursalesController@aeronaves');

	Route::get('/administracion-rutas','GerenciaSucursalesController@rutas');
	Route::get('/administracion-rutas/modificar/{id}','GerenciaSucursalesController@rutasAjax');

	Route::get('/','GerenciaSucursalesController@index');

	Route::get('/destinos/{id}','GerenciaSucursalesController@destinos');
	Route::get('/vuelos/{origen}/{destino}','GerenciaSucursalesController@vuelos');
	Route::get('/vuelo/{id}','GerenciaSucursalesController@vuelo');
	
	Route::get('/consultar/disponibilidad/{salida}/{origen}/{destino}','GerenciaSucursalesController@consultarDisponibilidad');


	Route::post('/cancelar','GerenciaSucursalesController@CancelarVuelo');
	Route::post('/planificar','GerenciaSucursalesController@PlanificarVuelo');
	Route::post('/administracion-rutas/nueva','GerenciaSucursalesController@NuevaRuta');
	Route::post('/administracion-rutas/eliminar','GerenciaSucursalesController@EliminarRuta');

	Route::post('/administracion-rutas/habilitar','GerenciaSucursalesController@habilitarRuta');

	Route::post('/administracion-rutas/modificar','GerenciaSucursalesController@ModificarRuta');

	Route::post('/administracion-aeronaves/nueva','GerenciaSucursalesController@NuevaAeronave');
	Route::post('/administracion-aeronaves/eliminar','GerenciaSucursalesController@EliminarAeronave');
	Route::post('/administracion-aeronaves/modificar','GerenciaSucursalesController@ModificarAeronave');

	Route::get('/administracion-aeronaves/modificar/{id}','GerenciaSucursalesController@AeronavesAjax');





});

 ?>