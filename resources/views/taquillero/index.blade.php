@extends('layouts.app')

@section('content')
@include('notifications::flash')
<div class="container">
  <div class="container py-3  avcaColor">

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>

    <div class="card-body">
    <h4 class="card-title centrarAux">Venta Registro y Reserbacion de boletos</h4>

    <div class="card text-center border-info mb-3 centrarAux" style="width: auto;">
     <div class="card-body ">
        <h4 class="card-title">Vuelo</h4>
      <br>

                    
                <div class="form-group">
                          <label for="inputvuelos">Seleccion de Vuelos</label>
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
    var datos;
    var id2="yv"+id;
    datos=document.getElementById(id2).innerHTML; 
    document.getElementById("vuelo").value = document.getElementById("origen").value+datos; 
    var url="{{ URL::to('/taquilla/vuelo') }}/"+"{{ $sucursal->id }}"+"/"+id;
    $.get(url,function(data){ 
        $('#info-vuelo').empty().html(data);
      });
  } 

  function capturarFechas(id){
    var fc = "fc" + id;
    datos=document.getElementById(fc).innerHTML; 
      document.getElementById("fc").value = datos;
    //ajax
    //AJAX disponibilidad
    var url="{{ URL::to('/taquilla/vuelo/disponibilidad') }}/"+id;  
      $.get(url,function(data){ 
        $('#info-vuelo-dispo').empty().html(data);
      }); 
      var altura = $(document).height();
 
      $("html, body").animate({scrollTop:altura+"px"});
  }
  function buscarPasajero(id){
    //AJAX pasajero
    var nacionalidad=document.getElementById("nacionalidad").value;
    var idboleto=document.getElementById("idboleto").value;
    var url="{{ URL::to('/taquilla/vuelo/pasajero') }}/"+idboleto+"/"+nacionalidad+"/"+id;
   // alert(url);
      $.get(url,function(data){ 
        $('#info-vuelo-pasajero').empty().html(data);
      });
  }   

 
</script>
@endsection