@extends('layouts.app')

@section('content')
@include('notifications::flash')

<div id="targetL">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>Administración de Rutas</th>
        </tr>
      </thead>
    </table>



<section>
    <div class="text-center">
        <div class="text-center">
        

<div class="divtablaAux">
<table class="table table-responsive-md table-hover text-center tablaAux">

    <thead class="thead-light">
      <tr>
        <th><div class="text-center" style="display: flex;">
        <div class="input-group-btn" style="margin: auto;">
          <button type="button" class="btn btn-secondary dropdown-toggle"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Origen
          </button>
          <div class="dropdown-menu dropAux">
    @foreach($sucursales as $sucursal)
            <a class="dropdown-item" href="{{ (URL::to('/gerente-sucursales/administracion-rutas')).'?origen='.$sucursal->id }}">{{ $sucursal->nombre }}</a>
        @endforeach
          </div>
        </div>
    </div></th>
        <th><div class="text-center" style="display: flex;">
        <div class="input-group-btn" style="margin: auto;">
          <button type="button" class="btn btn-secondary dropdown-toggle"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Destino
          </button>
          <div class="dropdown-menu dropAux">
    @foreach($sucursales as $sucursal)
            <a class="dropdown-item" href="{{ (URL::to('/gerente-sucursales/administracion-rutas')).'?destino='.$sucursal->id }}">{{ $sucursal->nombre }}</a>
        @endforeach
          </div>
        </div>
    </div></th>
        <th class="ThCenter">Distancia Mls.</th>
        <th class="ThCenter">Duracion Hrs.</th>
        <th class="ThCenter">Tarifa Vuelo Bs.</th>
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
	              <div class="p-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalModificarRuta" onclick="AjaxModificarRuta('{{ $ruta->id  }}','{{ $ruta->siglas }}')">Modificar</button></div>
	              <div class="p-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminarRuta" onclick="ConfirmarEliminarRuta('{{ $ruta->id  }}','{{ $ruta->siglas }}')">Eliminar</button></div>
	            </div>
	       
	      
	    </td>
	   
	    </tbody>
    @endforeach
  </table>
</div>
  <br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NuevaRutaModal" style="margin-bottom: 20px;">
  Agregar Ruta
</button>


  <!----- MODALS ----------------------------------------->
<!------------------------ MODALS ---------------------->
 
        @include('gerente-sucursales.modalsRutas')

<!------------------------------------- MODALS --------->
<!-------------- MODALS -------------------------------->
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
  var altura = $(document).height();
  altura=altura-470;
  altura=altura+"px";
  $(".divtablaAux").css("min-height",altura);

});

  function ConfirmarEliminarRuta(id,siglas){
        document.getElementById('ruta_id').value=id;
        
        document.getElementById('tituloModalEliRuta').innerHTML="RUTA "+siglas;
  }

  function AjaxModificarRuta(ruta_id,siglas){

      document.getElementById('TituloModalModificarRuta').innerHTML="RUTA "+siglas;
    var targetL = $('#cargandoAux');
    targetL.loadingOverlay();
    var url="{{ URL::to('/gerente-sucursales/administracion-rutas/modificar') }}/"+ruta_id; 
      //alert(url);
        $.get(url,function(data){ 
          $('#ModalAjaxModificarRuta').empty().html(data);
          targetL.loadingOverlay('remove');
        }); 
  }

</script>
@endsection
