@extends('layouts.app')

@section('content')
@include('notifications::flash')
<?php
  if(isset($_GET['page'])){
      $page=$_GET['page']; 
    if($page>$rutas->lastPage() or $page<1){
      $page=1;
      echo "<script type=\"text/javascript\">  location.href=\"../gerente-sucursales/administracion-rutas\";</script>";
    }
  }
  else{
    $page=1;
  }

?>
<div id="targetL">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>Administración de Rutas</th>
        </tr>
      </thead>
    </table>



<section>
  <div class="row">
  
    <div class="col-sm-12 col-md-6 mt-6 my-2">
      <div class="text-center">
      <select class="custom-select">
            <option value="0" selected>Origen</option>
            @foreach($sucursales as $sucursal)
              <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
            @endforeach
          </select>
    </div></div>
<br>

    <div class="col-sm-12 col-md-6 mt-6 my-2">
      <div class="text-center">
      <select class="custom-select">
            <option value="0" selected>Destino</option>
            @foreach($sucursales as $sucursal)
              <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
            @endforeach
      </select>
    </div></div>
  </div>
    <div class="card text-center">
        <div class="text-center">
        

<div class="container divtablaAux">
<table class="table table-responsive-md table-hover text-center tablaAux">

    <thead class="thead-light">
      <tr>
        <th>Origen</th>
        <th>Destino</th>
        <th>Distancia Mls.</th>
        <th>Duracion Hrs.</th>
        <th>Tarifa Vuelo Bs.</th>
        <th></th>
        
      </tr>
    </thead>
    @foreach($rutas as $ruta)
		<tbody>
	      <th scope="row">{{ $ruta->origen->nombre }}</th>
	      <th >{{ $ruta->destino->nombre }}</th>
	        <td>{{ $ruta->distancia }}</td>
	        <td>{{ $ruta->duracion }}</td>
	        <td>{{ $ruta->tarifa_vuelo }}</td>

	       <td>
	                      <div class="d-flex flex-row">
	              <div class="p-2"><button type="submit" class="btn btn-primary">Modificar</button></div>
	              <div class="p-2"><button type="submit" class="btn btn-primary">Eliminar</button></div>
	            </div>
	       
	      
	    </td>
	   
	    </tbody>
    @endforeach
  </table>
</div>
<nav aria-label="..." class="NavPage">
      <ul class="pagination">
        @if($page==1)
          <li class="page-item disabled">
            <span class="page-link">Previous</span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="/gerente-sucursales/administracion-rutas?page=<?php   $aux=$page-1; echo $aux;?>">Previous</a>
          </li>
        @endif

        @for($i=1; $i<=$rutas->lastPage(); $i++)
          @if($page==$i)
            <li class="page-item active">
              <span class="page-link">
                {{ $i }}
                <span class="sr-only">(current)</span>
              </span>
            </li>
        @else
            <li class="page-item"><a class="page-link" href="/gerente-sucursales/administracion-rutas?page={{ $i }}">{{ $i }}</a></li>
          @endif
        @endfor
        @if($page==$rutas->lastPage())
          <li class="page-item disabled">
            <span class="page-link">Next</span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="/gerente-sucursales/administracion-rutas?page=<?php  $aux=$page+1; echo $aux; ?>">Next</a>
          </li>
        @endif
      </ul>
  </nav>
  <br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Agregar Ruta
</button>


<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Ruta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body">
        <div class="container" style="padding-left: 15px; padding-right: 15px;  ">
            <div class="row">
    
                    <div class="col mt-3">
                      <div class="text-center">
                         <select class="custom-select">
                            <option value="1">Elija Origen</option>
                              <option value="2">Amazonas</option>
                              <option value="3">Anzoátegui</option>
                              <option value="2">Apure</option>
                              <option value="3">Aragua</option>
                              <option value="2">Barinas</option>
                              <option value="3">Bolivar</option>
                              <option value="2">Carabobo</option>
                              <option value="3">Cojedes</option>
                              <option value="2">Delta Amacuro</option>
                              <option value="3">Distrito Capital</option>
                              <option value="2">Falcon</option>
                              <option value="3">Guarico</option>
                              <option value="2">Lara</option>
                              <option value="3">Merida</option>
                              <option value="2">Miranda</option>
                              <option value="3">Monagas</option>
                              <option value="2">Nueva Esparta</option>
                              <option value="3">Portuguesa</option>
                              <option value="2">Sucre</option>
                              <option value="3">Táchira</option>
                              <option value="2">Trujillo</option>
                              <option value="3">Vargas</option>
                              <option value="2">Yaracuy</option>
                              <option value="3">Zulia</option>
                          </select>
                        </div>
                    </div>


                    <div class="col mt-3">
                      <div class="text-center">
                        <select class="custom-select">
                            <option value="1">Elija Destino</option>
                              <option value="2">Amazonas</option>
                              <option value="3">Anzoátegui</option>
                              <option value="2">Apure</option>
                              <option value="3">Aragua</option>
                              <option value="2">Barinas</option>
                              <option value="3">Bolivar</option>
                              <option value="2">Carabobo</option>
                              <option value="3">Cojedes</option>
                              <option value="2">Delta Amacuro</option>
                              <option value="3">Distrito Capital</option>
                              <option value="2">Falcon</option>
                              <option value="3">Guarico</option>
                              <option value="2">Lara</option>
                              <option value="3">Merida</option>
                              <option value="2">Miranda</option>
                              <option value="3">Monagas</option>
                              <option value="2">Nueva Esparta</option>
                              <option value="3">Portuguesa</option>
                              <option value="2">Sucre</option>
                              <option value="3">Táchira</option>
                              <option value="2">Trujillo</option>
                              <option value="3">Vargas</option>
                              <option value="2">Yaracuy</option>
                              <option value="3">Zulia</option>
                          </select>
                        </div>
                    </div>

          

                    <form>
                        <div class="form-row">

                            <div class="form-group col-sm-12 col-md-6"> 
                              <label for="inputEmail4">Distancia Mls.</label>
                              <input type="text" class="form-control" id="inputEmail4" placeholder="Distancia">
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                              <label for="inputEmail4">Duracion Hrs.</label>
                              <input type="text" class="form-control" id="inputEmail4" placeholder="Duracion">
                            </div>
                            

                            <div class="form-group col-sm-12 col-md-6">
                              <label for="inputEmail4">Tarifa Vuelo Bs.</label>
                              <input type="text" class="form-control" id="inputEmail4" placeholder="precio">
                            </div>

                            <div class="form-group col-sm-12 col-md-6">
                              <label for="inputEmail4">Tarifa Sobrepeso Bs.</label>
                              <input type="text" class="form-control" id="inputEmail4" placeholder="precio">
                            </div>
                       </div>
                    </form>

      </div>
    </div>
  </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary">Registrar</button>
                </div>
        
     </div>
  </div>
	

@endsection