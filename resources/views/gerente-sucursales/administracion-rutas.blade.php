@extends('layouts.app')

@section('content')
@include('notifications::flash')

<div id="targetL" class="py-3">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>Administración de Rutas</th>
        </tr>
      </thead>
    </table>
        
<button type="button" class="btn btn2 btn-success" data-toggle="modal" data-target="#NuevaRutaModal" style="margin-bottom: 20px;  float: left;">
  Agregar Ruta
</button>
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
        <th class="ThCenter">Duración Hrs.</th>
        <th class="ThCenter">Tarifa Bs.</th>
        <th class="ThCenter">Estado</th>
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
	        <td>{{ $ruta->estado }}</td>

	       <td>
	                      <div class="d-flex flex-row">
	              <div class="p-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalModificarRuta" onclick="AjaxModificarRuta('{{ $ruta->id  }}','{{ $ruta->siglas }}')">Modificar</button></div>
                @if($ruta->estado=='inactiva')
                    <div class="p-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalHabilitarRuta" onclick="ConfirmarHabilitarRuta('{{ $ruta->id  }}','{{ $ruta->siglas }}')">Habilitar</button></div>
                @else
                    <div class="p-2"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminarRuta" onclick="ConfirmarEliminarRuta('{{ $ruta->id  }}','{{ $ruta->siglas }}')">Inhabilitar</button></div>
                @endif
	              
	            </div>
	       
	      
	    </td>
	   
	    </tbody>
    @endforeach
  </table>
</div>
  <br>
<!-- Button trigger modal -->


  <!----- MODALS ----------------------------------------->
<!------------------------ MODALS ---------------------->
 
        @include('gerente-sucursales.modalsRutas')

<!------------------------------------- MODALS --------->
<!-------------- MODALS -------------------------------->
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
  var altura = $(document).height();
  altura=altura-380;
  altura=altura+"px";
  $(".divtablaAux").css("min-height",altura);
    $("#horasD").keyup(function(){
      if(($('#horasD').val()>0)&&($('#horasD').val()<10)){
          var auxD=parseInt($('#horasD').val());
          auxD2='0'+auxD;
          $('#horasD').val(auxD2);
        }
        else{
          if($('#horasD').val()>100){
            alert("Valor invalido");
            $('#horasD').val(99);
          }
          else{
            if($('#horasD').val()==''){
              $('#horasD').val('00');
            }
            else{
              var auxD=parseInt($('#horasD').val());
              $('#horasD').val(auxD);
            }
          }
        }
      });
    $("#minutosD").keyup(function(){
      if(($('#minutosD').val()>0)&&($('#minutosD').val()<10)){
          var auxD=parseInt($('#minutosD').val());
          auxD2='0'+auxD;
          $('#minutosD').val(auxD2);
        }
        else{
          if($('#minutosD').val()>60){
            alert("Valor invalido");
            $('#minutosD').val(59);
          }
          else{
            if($('#minutosD').val()==''){
              $('#minutosD').val('00');
            }
            else{
              var auxD=parseInt($('#minutosD').val());
              $('#minutosD').val(auxD);
            }
          }
        }
      });

});



  function ConfirmarEliminarRuta(id,siglas){
        document.getElementById('ruta_id').value=id;
        
        document.getElementById('tituloModalEliRuta').innerHTML="RUTA "+siglas;
  }

  function ConfirmarHabilitarRuta(id,siglas){
    //alert(id);
        document.getElementById('ruta_idH').value=id;
        
        document.getElementById('tituloModalHabRuta').innerHTML="RUTA "+siglas;
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
