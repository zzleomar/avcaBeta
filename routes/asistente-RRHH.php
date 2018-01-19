<?php 
Route::group(['prefix' => 'gerencia','middleware' => ['auth', 'RoleRRHH']],function(){

	Route::get('/RRHH','PersonalController@index');
	Route::get('/RRHH/nomina/generar/{tipo}/{opc}/{nomina}','NominaController@generar');


	Route::post('/RRHH/administracion-empleados/eliminar','PersonalController@eliminar');
	Route::post('/RRHH/administracion-empleados/nueva','PersonalController@nuevo');
	Route::post('/RRHH/administracion-empleados/modificar','PersonalController@modificar');

	Route::get('/RRHH/administracion-empleados/ajaxModificar/{id}','PersonalController@ajaxDatosModificar');

});

Route::group(['prefix' => 'RRHH','middleware' => ['auth', 'CheckRoleAsistenteRRHH','CheckRoleSucursal']],function(){

	Route::get('/asistencia','AsistenciaController@index');
	Route::get('/asistencia/ajax-asistencia/{nacionalidad}/{id}','AsistenciaController@ajaxPerso');


	Route::post('/asistencia/registrar/{asistencia}','AsistenciaController@nueva');


});


 ?>