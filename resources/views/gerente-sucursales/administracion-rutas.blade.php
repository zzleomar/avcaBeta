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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Ruta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body">
    <form>   
        <div class="container" style="padding-left: 15px; padding-right: 15px;  ">
            <div class="row">
                    <div class="col col-sm-12 col-md-12">
                      <label for="origen">Elija Origen</label>
                            <div class="input-group">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Origen
                              </button>
                              <div class="dropdown-menu">
                        @foreach($sucursales as $sucursal)
                                <a class="dropdown-item" href="#info-vuelo" id="suO{{ $sucursal->id }}" >{{ $sucursal->nombre }}</a>
                            @endforeach
                              </div>
                            </div>
                             <input type="text" class="form-control" aria-label="Text input with dropdown button" id="origen" placeholder="Seleccione Sucursal de Origen" value="">
                            <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>


                            </div>
                    </div>
                    <div class="col col-sm-12 col-md-12">
                      <label for="inputvuelos">Elija Destino</label>
                            <div class="input-group">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Destino
                              </button>
                              <div class="dropdown-menu">
                        @foreach($sucursales as $sucursal)
                                <a class="dropdown-item" href="#info-vuelo" id="suD{{ $sucursal->id }}" >{{ $sucursal->nombre }}</a>
                            @endforeach
                              </div>
                            </div>
                             <input type="text" class="form-control" aria-label="Text input with dropdown button" id="origen" placeholder="Seleccione Sucursal de Destino" value="">
                            <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>


                            </div>
                    </div></div>
          

                        <div class="row">

                            <div class="form-group col-sm-12 col-md-4"> 
                              <label for="inputEmail4">Distancia Mls.</label>
                              <input type="text" class="form-control" id="inputEmail4" placeholder="Distancia" onkeypress="return soloNumDec(event)">
                            </div>

                            <div class="form-group col-sm-12 col-md-4">
                              <label for="inputEmail4">Duración Hrs.</label>
                              <input type="time" class="form-control" id="inputEmail4" placeholder="Duración">
                            </div>
                            

                            <div class="form-group col-sm-12 col-md-4">
                              <label for="inputEmail4">Tarifa Vuelo Bs.</label>
                              <input type="text" class="form-control" id="inputEmail4" placeholder="Precio">
                            </div>
                       </div>

    </div></form>
  </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary">Registrar</button>
                </div>
        
     </div>
  </div>
	

@endsection