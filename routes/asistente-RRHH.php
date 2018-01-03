<?php 

Route::group(['prefix' => 'RRHH','middleware' => ['auth', 'CheckRoleAsistenteRRHH','CheckRoleSucursal']],function(){
	Route::get('/', function () {
	    return view('asistente-RRHH.index');
	});
	Route::get('/asistencia', function () {
	    return view('asistente-RRHH.asistencia');
	});







});


 ?>