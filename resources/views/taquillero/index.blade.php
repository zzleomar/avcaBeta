@extends('layouts.app')

@section('content')
@include('notifications::flash')
    <div class="card-body" id="targetL">
    <h4 style="font-weight: 600;">Sucursal {{ $sucursal->nombre }}</h4>

    <h4 class="subtituloM">VENTA Y RESERVE DE BOLETOS</h4>

    <div class="card text-center border-info mb-3 centrarAux" style="width: auto;">
     <div class="card-body ">
        <h4 class="card-title">Vuelo</h4>

                    
                <div class="form-group">
                          <label for="inputvuelos">Selección de Vuelos</label>
                            <div class="input-group">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Vuelo
                              </button>
                              <div class="dropdown-menu">
                        @foreach($vuelos as $vuelo)
                                <a class="dropdown-item" href="#info-vuelo" id="yv{{ $vuelo->su }}" onclick="capturarV('{{ $vuelo->su }}')">{{ $vuelo->nombre }}</a>
                            @endforeach
                              </div>
                            </div>
                            <input type="hidden" id="origen" value="{{ $sucursal->nombre.' - ' }}">
                             <input type="text" class="form-control" aria-label="Text input with dropdown button" id="vuelo" value="{{ $sucursal->nombre.' - ' }}">
                            <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>


                            </div>
                </div>

            <div id="info-vuelo"> <!-- OJOOOOOO INFORMACION de AJAX -->
                </div> <!-- OJOOOOOO FIN INFORMcion de AJAX --><!-- OJOOOOOO FIN INFORMcion de AJAX -->
    
            <br>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
 <script>
  function capturarV(id)
  {
    
    var targetL = $('#targetL');
    targetL.loadingOverlay();
    var datos;
    var id2="yv"+id;
    datos=document.getElementById(id2).innerHTML; 
    document.getElementById("vuelo").value = document.getElementById("origen").value+datos; 
    var url="{{ URL::to('/taquilla/vuelo') }}/"+"{{ $sucursal->id }}"+"/"+id;
    $.get(url,function(data){ 
        $('#info-vuelo').empty().html(data);
        targetL.loadingOverlay('remove');
      });
  } 

  function capturarV2(id)
  {
    var targetL = $('#targetL');
    targetL.loadingOverlay();
    var datos;
    var id2="yv2"+id;
    datos=document.getElementById(id2).innerHTML; 
    var idsu=document.getElementById("origen2id").value; 
    document.getElementById("vuelo2").value = document.getElementById("origen2").value+datos; 
    var url="{{ URL::to('/taquilla/vuelo') }}/"+idsu+"/"+id;
   //alert(url);
    $.get(url,function(data){ 
        $('#info-vuelo2').empty().html(data);
        targetL.loadingOverlay('remove');
      });
  }

  function capturarFechas(id){
    var targetL = $('#targetL');
    targetL.loadingOverlay();
    var fc = "fc" + id;
    datos=document.getElementById(fc).innerHTML; 
      document.getElementById("fc").value = datos;
      document.getElementById("vueloid").value = id;
    //ajax
    //AJAX disponibilidad
    var n=0; //idenfica en la función que es la primera pierna
    var url="{{ URL::to('/taquilla/vuelo/disponibilidad') }}/"+id+"/"+n;
    //alert(url);  
      $.get(url,function(data){ 
        $('#info-vuelo-dispo').empty().html(data);
        targetL.loadingOverlay('remove');
      }); 
      var altura = $(document).height();
 
      $("html, body").animate({scrollTop:altura+"px"});
  }
  function capturarFechas2(id){
    var targetL = $('#targetL');
    targetL.loadingOverlay();
    var fc = "fc2" + id;
    datos=document.getElementById(fc).innerHTML; 
      var n=document.getElementById("vueloid").value;
      document.getElementById("fc2").value = datos;
    //ajax
    //AJAX disponibilidad
    var url="{{ URL::to('/taquilla/vuelo/disponibilidad') }}/"+id+"/"+n; 
      $.get(url,function(data){ 
        $('#info-vuelo-dispo2').empty().html(data);
        targetL.loadingOverlay('remove');
      }); 
      var altura = $(document).height();
 
      $("html, body").animate({scrollTop:altura+"px"});
  }
  function buscarPasajero(){
    //AJAX pasajero
    var id=document.getElementById("cedula").value;
    var nacionalidad=document.getElementById("nacionalidad").value;
    var idboleto=document.getElementById("idboleto").value;
    var boletoAux;
    if(document.getElementById("boletoAux")==null){
      boletoAux=0;
    }
    else {
      boletoAux=document.getElementById("boletoAux").value;
    }
    var url="{{ URL::to('/taquilla/vuelo/pasajero') }}/"+idboleto+"/"+nacionalidad+"/"+id+"/"+boletoAux;
    //alert(url);
      $.get(url,function(data){ 
        $('#info-vuelo-pasajero').empty().html(data);
      });
  }   

 
</script>
@endsection