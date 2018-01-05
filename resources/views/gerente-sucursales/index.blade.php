@extends('layouts.app')

@section('content')
@include('notifications::flash')
<div id="targetL">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>Administración de Vuelos</th>
        </tr>
      </thead>
    </table>
  
<div class="row centradoM">
    <div class="centradoM">
      <div class="form-group">
         <div class="text-center">
            Origen
        </div>
        <select class="custom-select" id="item-origen" onchange="origenAjax()">
          <option selected value="{{ $central->id }}">{{ $central->nombre }}</option>
              @foreach($origenes as $origen)

                <option value="{{ $origen->id }}" >{{ $origen->nombre }}</option>

              @endforeach
        </select>
      </div>
    </div>
    <div class="centradoM">
      <div class="form-group" id="ajax-destino">
         <div class="text-center">
            Seleccione el Destino
        </div>
        <select class="custom-select" id="item-destino" onchange="vuelosAjax()">
            <option selected>Sucursal-Destino</option>
              @foreach($destinos as $destino)

                <option value="{{ $destino->destino->id }}" >{{ $destino->destino->nombre }}</option>

              @endforeach
        </select>
      </div>
    </div>
</div>

    <div id="ajax-vuelos">
      
            <div id="exampleAccordion" data-children=".item">
         <div class="opcionesAccordion">
          <a class="btn btn2 btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosAbiertos" aria-expanded="true" aria-controls="VuelosAbiertos">
            Vuelos Abiertos
          </a>

          <a class="btn btn2 btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosRetrasados" aria-expanded="false" aria-controls="VuelosRetrasados">
            Vuelos Retrasados
          </a>
          

          <a class="btn btn2 btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosCancelados" aria-expanded="false" aria-controls="VuelosCancelados">
            Vuelos Cancelados
          </a>

          <a class="btn btn2 btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosEjecutados" aria-expanded="false" aria-controls="VuelosEjecutados">
            Vuelos Ejecutados
          </a>
       </div>



        <div class="item">
         
          <div id="VuelosRetrasados" class="collapse" role="tabpanel">
           <div class="row">
                <div class="col-md-12 col-sm-12">
      @if((sizeof($retrasados))==0)
                      <h5>No existen vuelos Retrasados</h5>
                    @else 
               <div class=" container card">  
                  <div class="table-responsive divtablaAux">  
                    <table class="table table-hover text-center tablaAux">
                      <thead class="thead-light">
                        <tr>
                          <th>#Vuelo</th>
                          <th>Ruta</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                          <th>Estatus</th>
                          <th>Modificar</th>
                        </tr>
                      </thead>

                         <?php 
                            $retrasados->each(function($retrasados){

                     ?>

                      <tbody>
                       
                        <th scope="row">{{ $retrasados->id }}</th>
                           <!-- <td>{{ $retrasados->pierna->ruta->origen->nombre."--".$retrasados->pierna->ruta->destino->nombre }}
                          </td> -->
                          <td>{{ $retrasados->pierna->ruta->siglas }}
                          </td>
                          <td>{{ DATE('d/m/Y',strtotime($retrasados->salida)) }}</td>
                          <td>{{ DATE('H:i:s',strtotime($retrasados->salida)) }}</td>
                          <td>{{ $retrasados->estado }}</td>
                         <td>
                          <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $retrasados->id }}','{{ $retrasados->pierna->ruta->siglas }}','{{ $retrasados->pierna->ruta->origen->nombre }}','{{ $retrasados->pierna->ruta->destino->nombre }}')">Ver</button>
                      </td>
                     
                      </tbody>
                     <?php }); ?>
                    </table>
                    </div>      
                  
              </div>
      @endif

      </div></div>
        </div>
        </div>


        <div class="item">
          <div id="VuelosAbiertos" class="collapse show" role="tabpanel">
            <div class="row">
                <div class="col-md-12 col-sm-12">
       @if((sizeof($abiertos))==0)
                      <h5>No existen vuelos abiertos</h5>
                    @else     
               <div class=" container card"> 
                  <div class="table-responsive divtablaAux">  
                    <table class="table table-hover text-center tablaAux">
                      <thead class="thead-light">
                        <tr>
                          <th>#Vuelo</th>
                          <th>Ruta</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                          <th>Estatus</th>
                          <th>Modificar</th>
                        </tr>
                      </thead>

                        <?php 
                            $abiertos->each(function($abiertos){

                     ?>
                      <tbody>
                       
                        <th scope="row">{{ $abiertos->id }}</th>
                          <!-- <td>{{ $abiertos->pierna->ruta->origen->nombre."--".$abiertos->pierna->ruta->destino->nombre }}
                          </td> -->
                          <td>{{ $abiertos->pierna->ruta->siglas }}
                          </td>
                          <td>{{ DATE('d/m/Y',strtotime($abiertos->salida)) }}</td>
                          <td>{{ DATE('H:i:s',strtotime($abiertos->salida)) }}</td>
                          <td>{{ $abiertos->estado }}</td>
                         <td>
                          <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#ModalCancelarVuelo" onclick="cancelar('{{ $abiertos->id  }}')">Cancelar</button>
                          <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $abiertos->id }}','{{ $abiertos->pierna->ruta->siglas }}','{{ $abiertos->pierna->ruta->origen->nombre }}','{{ $abiertos->pierna->ruta->destino->nombre }}')">Ver</button>
                      </td>
                     
                      </tbody>
                     <?php }); ?>
                    </table>
                    </div>  
              </div>
      @endif
      </div></div>
           </div>
        </div>
        
       <div class="item">
         <div id="VuelosCancelados" class="collapse" role="tabpanel">
            <div class="row">
                <div class="col-md-12 col-sm-12">
      @if((sizeof($cancelados))==0)
                      <h5>No existen vuelos cancelados</h5>
                    @else  
               <div class=" container card">
                  <div class="table-responsive divtablaAux">  
                    <table class="table table-hover text-center tablaAux">
                      <thead class="thead-light">
                        <tr>
                          <th>#Vuelo</th>
                          <th>Ruta</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                          <th>Estatus</th>
                          <th>Modificar</th>
                        </tr>
                      </thead>
                       <?php 
                            $cancelados->each(function($cancelados){

                     ?>

                      <tbody>
                       
                        <th scope="row">{{ $cancelados->id }}</th>

                          <!-- <td>{{ $cancelados->pierna->ruta->origen->nombre."--".$cancelados->pierna->ruta->destino->nombre }}
                          </td> -->
                          <td>{{ $cancelados->pierna->ruta->siglas }}
                          <td>{{ DATE('d/m/Y',strtotime($cancelados->salida)) }}</td>
                          <td>{{ DATE('H:i:s',strtotime($cancelados->salida)) }}</td>
                          <td>{{ $cancelados->estado }}</td>
                         <td>
                          <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $cancelados->id }}','{{ $cancelados->pierna->ruta->siglas }}','{{ $cancelados->pierna->ruta->origen->nombre }}','{{ $cancelados->pierna->ruta->destino->nombre }}')">Ver</button>
                      </td>
                     
                      </tbody>
                      <?php }); ?>
                    </table>
                    </div>    
              </div>
              @endif
      </div></div>
      </div>
        </div>
        <div class="item">
         <div id="VuelosEjecutados" class="collapse" role="tabpanel">
            <div class="row">
                <div class="col-md-12 col-sm-12">
      @if((sizeof($ejecutados))==0)
                      <h5>No existen vuelos Ejecutados</h5>
                    @else  
               <div class=" container card">
                  <div class="table-responsive divtablaAux">  
                    <table class="table table-hover text-center tablaAux">
                      <thead class="thead-light">
                        <tr>
                          <th>#Vuelo</th>
                          <th>Ruta</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                          <th>Estatus</th>
                          <th>Modificar</th>
                        </tr>
                      </thead>
                       <?php 
                            $ejecutados->each(function($ejecutados){

                     ?>

                      <tbody>
                       
                        <th scope="row">{{ $ejecutados->id }}</th>
                          <!-- <td>{{ $ejecutados->pierna->ruta->origen->nombre."--".$ejecutados->pierna->ruta->destino->nombre }}
                          </td> -->
                          <td>{{ $ejecutados->pierna->ruta->siglas }}
                          <td>{{ DATE('d/m/Y',strtotime($ejecutados->salida)) }}</td>
                          <td>{{ DATE('H:i:s',strtotime($ejecutados->salida)) }}</td>
                          <td>{{ $ejecutados->estado }}</td>
                         <td>
                            <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $ejecutados->id }}','{{ $ejecutados->pierna->ruta->siglas }}','{{ $ejecutados->pierna->ruta->origen->nombre }}','{{ $ejecutados->pierna->ruta->destino->nombre }}')">Ver</button>
                        </td>
                     
                      </tbody>
                      <?php }); ?>
                    </table>
                    </div>    
              </div>
              @endif
      </div></div>
      </div>
        </div>

      </div>


    </div>



<!----- MODALS ----------------------------------------->
<!------------------------ MODALS ---------------------->
 
        @include('gerente-sucursales.modalsVuelos')

<!------------------------------------- MODALS --------->
<!-------------- MODALS -------------------------------->


</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
  var altura = $(document).height();
  altura=altura-510;
  altura=altura+"px";
  $(".divtablaAux").css("min-height",altura);

});

  function origenAjax()
  {
    var targetL = $('#targetL');
    targetL.loadingOverlay();
    var id=document.getElementById('item-origen').value; 
    var url="{{ URL::to('/gerente-sucursales/destinos') }}/"+id;
    //alert(url);
    $.get(url,function(data){ 
        $('#ajax-destino').empty().html(data);
        targetL.loadingOverlay('remove');
      });
  }
  function vuelosAjax()
  {
    var targetL = $('#targetL');
    targetL.loadingOverlay();
    var origen=document.getElementById('item-origen').value; 
    var destino=document.getElementById('item-destino').value; 
    var url="{{ URL::to('/gerente-sucursales/vuelos') }}/"+origen+"/"+destino;
   //alert(url);
    $.get(url,function(data){ 
        $('#ajax-vuelos').empty().html(data);
        targetL.loadingOverlay('remove');
      });
  }
  function detallesVuelo(id,siglas,origenN,destinoN){

    var targetL = $('#cargandoAux');
    targetL.loadingOverlay();
    document.getElementById("rutaStringV").innerHTML=origenN+"-->"+destinoN; 

      var url="{{ URL::to('/gerente-sucursales/vuelo/') }}/"+id; 
      //alert(url);
        $.get(url,function(data){ 
          $('#ajax-ver-vuelo').empty().html(data);
          targetL.loadingOverlay('remove');

        }); 
  }
  function programar(){
    var targetL = $('#cargandoAuxP');
    targetL.loadingOverlay();
    var origen=document.getElementById('origen_id').value; 
    var destino=document.getElementById('destino_id').value; 
    var hora=document.getElementById('horaSalida').value; 
    var fecha=document.getElementById('fechaSalida').value; 
    if((hora=="")||(fecha=="")){
      //alert("Introdusca los datos completos de la salida");
      targetL.loadingOverlay('remove');
    }
    else{
      var salida=fecha+" "+hora+":00";
      num=0;
      var url="{{ URL::to('/gerente-sucursales/consultar/disponibilidad') }}/"+salida+"/"+origen+"/"+destino; 
      //alert(url);
       $.get(url,function(data){ 
          $('#ajax-reprogramar-vuelo').empty().html(data);
          targetL.loadingOverlay('remove');
        });
    } 
  }
  

</script>
@endsection

