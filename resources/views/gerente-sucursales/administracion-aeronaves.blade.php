@extends('layouts.app')

@section('content')
@include('notifications::flash')

<div id="targetL">
<table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>
            
  Administración de Aeronaves

          </th>
        </tr>
      </thead>
    </table>


 


<div class="container divtablaAux">
<table class="table table-responsive-md table-hover text-center tablaAux">

    <thead class="thead-light">
      <tr>
        <th class="ThCenter">Matricula</th>
        <th class="ThCenter">Ultimo Matenimiento</th>
        <th class="ThCenter">Uso Planificado</th>
        <th>
        	<div class="text-center" style="display: flex;">
		        <div class="input-group-btn" style="margin: auto;">
		          <button type="button" class="btn btn-secondary dropdown-toggle"
		                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Modelo
		          </button>
		          <div class="dropdown-menu">
                @foreach($modelos as $modelo)
		            <a class="dropdown-item" href="{{ (URL::to('/gerente-sucursales/administracion-aeronaves')).'?modelo='.$modelo->modelo }}">{{ $modelo->modelo }}</a>
                @endforeach
		          </div>
		        </div>
		    </div>
		</th>
        <th>
        	
        	<div class="text-center" style="display: flex;">
		        <div class="input-group-btn" style="margin: auto;">
		          <button type="button" class="btn btn-secondary dropdown-toggle"
		                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Estado
		          </button>
		          <div class="dropdown-menu">
                @foreach($estados as $estado)
                <a class="dropdown-item" href="{{ (URL::to('/gerente-sucursales/administracion-aeronaves')).'?estado='.$estado->estado }}">{{ $estado->estado }}</a>
                @endforeach
		          </div>
		        </div>
		    </div>
        </th>
        
        <th></th>
        
      </tr>
    </thead>
    <?php 
        $size=sizeof($aeronaves);
        for ($i=0; $i < $size; $i++) {
     ?>
    <tbody>
        <td>{{ $aeronaves[$i]->matricula }}</td>     
        <td>{{ DATE('d/m/Y',strtotime($aeronaves[$i]->ultimo_mantenimiento)) }}</td>
        <td id="aehm{{ $aeronaves[$i]->id }}"></td>
        <td>{{ $aeronaves[$i]->modelo }}</td>
      <td>{{ $aeronaves[$i]->estado }}</td>
        
       <td>
                      <div class="d-flex flex-row">
              <div class="p-2"><button type="submit" class="btn btn-primary" onclick="AjaxModificarAeronave('{{ $aeronaves[$i]->id  }}','{{ $aeronaves[$i]->matricula }}')" data-toggle="modal" data-target="#ModalModificarAeronave">Modificar</button></div>
              <div class="p-2"><button type="submit" class="btn btn-primary" onclick="ConfirmarEliminarAerovane('{{ $aeronaves[$i]->id  }}','{{ $aeronaves[$i]->matricula }}')" data-toggle="modal" data-target="#ModalEliminarAeronave">Eliminar</button></div>
            </div>
       </td>
   
    </tbody>
    <?php } ?>
  </table>
</div>

<!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NuevaAeronaveModal">
              Agregar Aeronave
            </button>
    
  <!----- MODALS ----------------------------------------->
<!------------------------ MODALS ---------------------->
 
        @include('gerente-sucursales.modalsAeronaves')

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

  <?php 
        $size=sizeof($aeronaves);
        for ($i=0; $i < $size; $i++) { 
         
     ?>
          var acumulado=parseInt('<?php if(!(is_null($aehm[$i]->horas))){echo $aehm[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='aehm'+'<?php echo $aeronaves[$i]->id; ?>';
          <?php if(($aeronaves[$i]->estado!='mantenimiento')&&($aeronaves[$i]->estado!='inactivo')){ ?>
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";
          <?php }else{ ?>
          document.getElementById(idpi).innerHTML="NO APLICA";
            <?php } ?>


<?php } ?>

});

  function ConfirmarEliminarAerovane(id,matricula){
        document.getElementById('aeronave_id').value=id;
        alert(id);
        document.getElementById('tituloModalEliAeronave').innerHTML="AERONAVE "+matricula;
  }

  function AjaxModificarAeronave(aeronave_id,matricula){

      document.getElementById('TituloModalModificarAeronave').innerHTML="AERONAVE "+matricula;
    var targetL = $('#cargandoAux');
    targetL.loadingOverlay();
    var url="{{ URL::to('/gerente-sucursales/administracion-aeronaves/modificar') }}/"+aeronave_id; 
      //alert(url);
        $.get(url,function(data){ 
          $('#ModalAjaxModificarAeronave').empty().html(data);
          targetL.loadingOverlay('remove');
        }); 
  }

</script>
@endsection