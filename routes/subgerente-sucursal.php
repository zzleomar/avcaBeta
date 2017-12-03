<?php 


Route::group(['prefix' => 'sucursal','middleware' => ['auth', 'CheckRoleSubgerenteSucursal']],function(){
	Route::get('/', function () {
	    return view('administrador-sucursal.index');
	});





});

 ?>