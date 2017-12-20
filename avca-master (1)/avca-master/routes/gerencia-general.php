<?php 



Route::group(['prefix' => 'gerencia-general','middleware' => ['auth', 'CheckRoleGerenteGeneral']],function(){
	Route::get('/', function () {
	    return view('gerente-general.index');
	});







});


 ?>