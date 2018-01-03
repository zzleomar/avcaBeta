<?php 



Route::group(['prefix' => 'gerente-RRHH','middleware' => ['auth', 'CheckRoleGerenteRRHH']],function(){
	Route::get('/', function () {
	    return view('gerente-RRHH.index');
	});







});


 ?>