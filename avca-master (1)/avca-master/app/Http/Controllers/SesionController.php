<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SesionController extends Controller
{
    public function index(){
    	if(Auth::user()){
	    	if(Auth::user()->role=='Operador'){
	    		return view('operador.index');
	    	}
	    	else{
	    		Auth::logout(); //para cerrar sesión
	    		return redirect('/home');
	    	}
    	}
	    return redirect('/login');

    }
}
