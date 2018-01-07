@extends('layouts.app')

@section('content')
@include('notifications::flash')

<div id="targetL" class="py-3">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>Administración de Personal</th>
        </tr>
      </thead>
    </table>

 


<div class="divtablaAux">
<table class="table table-responsive-md table-hover text-center tablaAux">

    <thead class="thead-light">
      <tr>
        <th class="ThCenter">.</th>
        <th class="ThCenter">Empleado</th>
        <th class="ThCenter">
        	<div class="text-center" style="display: flex;">
		        <div class="input-group-btn" style="margin: auto;">
		          <button type="button" class="btn btn-secondary dropdown-toggle"
		                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Cargo
		          </button>
		          <div class="dropdown-menu">
                @foreach($cargos as $cargo)
		            <a class="dropdown-item" href="{{ (URL::to('/RRHH')).'?cargo='.$cargo->cargo }}">{{ $cargo->cargo }}</a>
                @endforeach
		          </div>
		        </div>
		    </div>
        </th>
        <th class="ThCenter">
        	<div class="text-center" style="display: flex;">
		        <div class="input-group-btn" style="margin: auto;">
		          <button type="button" class="btn btn-secondary dropdown-toggle"
		                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown">Sucursal
		          </button>
		          <div class="dropdown-menu">
                @foreach($sucursales as $sucursal)
		            <a class="dropdown-item" href="{{ (URL::to('/RRHH')).'?sucursal='.$sucursal->id }}">{{ $sucursal->nombre }}</a>
                @endforeach
		          </div>
		        </div>
		    </div>
        </th>
        
        <th></th>
        
      </tr>
    </thead>
    @php

		$size=sizeof($empleados);
		for($i=0;$i<$size; $i++){
    @endphp
    <tbody>
        <td>{{ $empleados[$i]->cedula }}</td>     
        <td>{{ $empleados[$i]->apellidos." ".$empleados[$i]->nombres }}</td>
        @if(is_null($empleados[$i]->cargo))
        	<td>{{ $empleados[$i]->rango }}</td>
          <td>Central</td>
            @php
            $titulo=$empleados[$i]->rango." ".$empleados[$i]->apellidos." ".$empleados[$i]->nombres;
            @endphp
        @else
          @php
            $titulo=$empleados[$i]->cargo." ".$empleados[$i]->apellidos." ".$empleados[$i]->nombres;
            @endphp
        	<td>{{ $empleados[$i]->cargo }}</td>
          <td>{{ $empleados[$i]->sucursal }}</td>
        @endif
        
       <td>
                      <div class="d-flex flex-row">
              <div class="p-2"><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#ModalModificarEmpleado">Modificar</button></div>
              <div class="p-2"><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminarEmpleado" onclick="ConfirmarEliminarEmpleado('{{ $empleados[$i]->id }}','{{ $titulo }}')">Eliminar</button></div>
            </div>
       </td>
   
    </tbody>
    @php }
    @endphp
  </table>
</div><br>

<!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NuevaEmpleadoModal">
              Agregar Empleado
            </button>
    
  <!----- MODALS ----------------------------------------->
<!------------------------ MODALS ---------------------->
 
			@include('asistente-RRHH.modalsPersonal')

<!------------------------------------- MODALS --------->
<!-------------- MODALS -------------------------------->
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
  var altura = $(document).height();
  altura=altura-380;
  altura=altura+"px";
  $(".divtablaAux").css("min-height",altura);
});

  function ConfirmarEliminarEmpleado(id,nombre){
        document.getElementById('empleado_id').value=id;
        document.getElementById('tituloModalEliEmpleado').innerHTML=nombre;
  }


  
</script>
@endsection