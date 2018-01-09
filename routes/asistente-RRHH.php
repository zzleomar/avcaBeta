<?php 

Route::group(['prefix' => 'RRHH','middleware' => ['auth', 'CheckRoleAsistenteRRHH','CheckRoleSucursal']],function(){

	Route::get('/asistencia','AsistenciaController@index');
	Route::get('/asistencia/ajax-asistencia/{nacionalidad}/{id}','AsistenciaController@ajaxPerso');


	Route::post('/asistencia/registrar/{asistencia}','AsistenciaController@nueva');


	Route::get('/','PersonalController@index');

	Route::post('/administracion-empleados/eliminar','PersonalController@eliminar');
	Route::post('/administracion-empleados/nueva','PersonalController@nuevo');
	Route::post('/administracion-empleados/modificar','PersonalController@modificar');


	Route::get('/administracion-empleados/ajaxModificar/{id}','PersonalController@ajaxDatosModificar');
	








});


 ?>