<?php 


Route::group(['prefix' => 'sucursal','middleware' => ['auth', 'CheckRoleAdministradorSucursal']],function(){
	Route::get('/', function () {
	    return view('administrador-sucursal.index');
	});





});

 ?>