<?php 

Route::group(['prefix' => 'RRHH','middleware' => ['auth', 'CheckRoleAsistenteRRHH','CheckRoleSucursal']],function(){
	Route::get('/', function () {
	    return view('asistente-RRHH.index');
	});

	Route::get('/asistencia','AsistenciaController@index');
	Route::get('/asistencia/ajax-asistencia/{nacionalidad}/{id}','AsistenciaController@ajaxPerso');


	Route::post('/asistencia/registrar/{asistencia}','AsistenciaController@nueva');






});


 ?>