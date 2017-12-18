@extends('layouts.app')

@section('content')
@include('notifications::flash')
<div id="targetL">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>Gestionar Vuelos</th>
        </tr>
      </thead>
    </table>
  
<div class="row centradoM">
    <div class="centradoM">
      <div class="text-center">

        <div class="text-center">
            Seleccione el Origen
        </div>
        <select class="custom-select margenInferior" id="item-origen" onchange="origenAjax()">
            <option selected value="0">Sucursal-Origen</option>
              @foreach($origenes as $origen)

                <option value="{{ $origen->id }}" >{{ $origen->nombre }}</option>

              @endforeach
        </select>     
      </div>
    </div>
    <div class="centradoM">
      <div  id="ajax-destino">
      
      </div>
    </div>
</div>

    <div id="ajax-vuelos"></div>



<!----- MODALS ----------------------------------------->
<!------------------------ MODALS ---------------------->
 
        @include('gerente-sucursales.modals')

<!------------------------------------- MODALS --------->
<!-------------- MODALS -------------------------------->


</div>
@endsection
@section('scripts')
<script type="text/javascript">
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
   // alert(url);
    $.get(url,function(data){ 
        $('#ajax-vuelos').empty().html(data);
        targetL.loadingOverlay('remove');
      });
  }
  function detallesVuelo(id){
      var url="{{ URL::to('/gerente-sucursales/vuelo/') }}/"+id; 
      //alert(url);
        $.get(url,function(data){ 
          $('#ajax-ver-vuelo').empty().html(data);
        }); 
  }
  function programar(){
    var targetL = $('#cargandoAux');
    targetL.loadingOverlay();
    var origen=document.getElementById('origen_id').value; 
    var destino=document.getElementById('destino_id').value; 
    var hora=document.getElementById('horaSalida').value; 
    var fecha=document.getElementById('fechaSalida').value; 
    if((hora=="")||(fecha=="")){
      alert("Introdusca los datos completos de la salida");
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

