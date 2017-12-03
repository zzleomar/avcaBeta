<?php 


Route::group(['prefix' => 'gerente-sucursales','middleware' => ['auth', 'CheckRoleGerenteSucursales']],function(){
	Route::get('/', function () {
	    return view('gerente-sucursales.index');
	});





});

 ?>