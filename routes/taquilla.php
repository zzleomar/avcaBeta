<?php 
Route::group(['prefix' => 'taquilla','middleware' => ['auth', 'CheckRoleOperador']],function(){
	Route::get('/','TaquillaController@index');
	Route::get('inicio','TaquillaController@index');


	Route::get('confirmar-boleto', function() {
	    return view('taquillero/confirmacionBoleto');
	});	

	Route::get('vuelo/disponibilidad/{a}', 'TaquillaController@ajaxVueloDisp');
	Route::get('/vuelo/{origen}/{destino}', 'TaquillaController@ajaxVuelo');
	Route::get('/vuelo/pasajero/{b}/{n}/{id}', 'TaquillaController@ajaxVueloPasajero');

	Route::post('confirmar-boleto','TaquillaController@ChequiarBoleto');


	Route::post('/accion/{a}','TaquillaController@Accion');


});


 ?>