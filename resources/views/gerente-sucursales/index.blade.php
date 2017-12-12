@extends('layouts.app')

@section('content')
@include('notifications::flash')

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
            <option selected>Sucursal-Origen</option>
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
    <form name="CancelarVuelo" id="CancelarVuelo" method="POST">
                        {{ csrf_field() }}
    <input type="hidden" name="vuelo_id" id="vuelo_id" value="">

    <div id="ajax-vuelos"></div>

 

  <div class="row">
      <div class="col mt-3">
        <div class="text-center">
            <input type="date" placeholder="introduzca fecha" /><br>
        </div>  
      </div>
      
      <div class="col mt-3">
        <div class="text-center">
          <select class="custom-select">
            <option value="1">Introduzca hora</option>
              <option value="2">7:00 AM</option>
              <option value="3">2:00 PM</option>
          </select>
        </div>
      </div>
    
      <div class="col mt-3">
        <div class="text-center">
          <select class="custom-select">
            <option selected>Seleccione Aeronave</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </div>
    
      <div class="col mt-3">
        <div class="text-center">
              <tbody>
                <td>
                    <h1 align="center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Seleccionar Tripulacion</button>         
                </h1>
              </td>
              </tbody>  
        </div>
      </div>        
  </div>





<!----- MODALS ----------------------------------------->
<!------------------------ MODALS ---------------------->
 
        @include('gerente-sucursales.modals')

<!------------------------------------- MODALS --------->
<!-------------- MODALS -------------------------------->

                    </form>


@endsection
@section('scripts')
<script type="text/javascript">
  function origenAjax()
  {
    var id=document.getElementById('item-origen').value; 
    var url="{{ URL::to('/gerente-sucursales/destinos') }}/"+id;
    //alert(url);
    $.get(url,function(data){ 
        $('#ajax-destino').empty().html(data);
      });
  }
  function vuelosAjax()
  {
    var origen=document.getElementById('item-origen').value; 
    var destino=document.getElementById('item-destino').value; 
    var url="{{ URL::to('/gerente-sucursales/vuelos') }}/"+origen+"/"+destino;
   // alert(url);
    $.get(url,function(data){ 
        $('#ajax-vuelos').empty().html(data);
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
    var hora=document.getElementById('horaSalida').value; 
    var fecha=document.getElementById('fechaSalida').value; 
    var salida=fecha+" "+hora+":00";
      var url="{{ URL::to('/gerente-sucursales/consultar/disponibilidad') }}/"+salida; 
      alert(url);
       $.get(url,function(data){ 
          $('#ajax-reprogramar-vuelo').empty().html(data);
        }); 
  }
  

</script>
@endsection

