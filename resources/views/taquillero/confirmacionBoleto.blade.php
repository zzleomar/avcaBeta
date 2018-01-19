@extends('layouts.app')

@section('content')
@include('notifications::flash')

    <div class="row">
        <div class="col-md-10 costo-center" id="targetL"> 
            <h4 style="font-weight: 600;">Sucursal {{ $sucursal->nombre }}</h4>
            <h4 class="subtituloM">CHEQUEO DE BOLETOS</h4>
            <div class="card">
                <div class="card-body">            
                    <form class="visible" action="/taquilla/confirmar-boleto" accept-charset="utf-8" method="POST" onkeypress = "return pulsar(event)">                     
                     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
                     <div class="form-group row">
                        <label for="cedula" class="col-sm-2 col-form-label">Pasajero:</label>
                        <div class="input-group col-sm-8">  
                          <div class="input-group-addon">
                              <select name="nacionalidad" id="nacionalidad" class="nationality form-control-lg">
                                  <option value="V">V</option>
                                  <option value="E">E</option>
                                  <option value="N">P</option>
                              </select>
                          </div>  
                        <input type="text" class="form-control" placeholder="Identificación" id="cedula" name="cedula" onkeypress="return soloNumDec(event)" onKeyUp="buscarPasajero(this.value)">
                      </div>
                      <div class="input-group costo-center">
                        <label for="cedula" class="col-sm-2 col-form-label">Vuelo:</label>
                        <div class="input-group col-sm-8">  
                              <select name="vuelos" id="vuelosAjax" class="nationality form-control-lg  col-sm-12">
                                <option value="0">Seleccione Vuelo</option>
                                @foreach($vuelos as $vuelo)
                                  <option value="{{ $vuelo->id }}">{{ $vuelo->nombre }}</option>
                                  @endforeach
                              </select>
                          </div>  </div>
                        <div class="centradoM">
                            <button type="button" class="btn btn-lg btn-primary" onclick="chequear()">BUSCAR</button>
                        </div>
                      </div>
        <div id="ajax-datos-boleto"> <!-- PARA EL AJAX-->
        

        </div>
            </form></div>  
    </div>
<div class="float-right" style="margin-top: 10px; margin-right: 5px;">
      <button type="button" class="btn btn-lg btn-outline-secondary " data-toggle="modal" data-target="#lista">Generar Lista de Chequeo</button>
    </div>
    @include('taquillero.auxlistachequeo')
  </div>
</div>

@endsection
@section('scripts')
    <script type="text/javascript">
      function chequear(){
          var ci=document.getElementById("cedula").value;
          var nacionalidad=document.getElementById("nacionalidad").value;
          var vuelo=document.getElementById("vuelosAjax").value;
          ci=nacionalidad+ci;
          var url="{{ URL::to('/taquilla/confirmar/boleto') }}/"+ci+"/"+vuelo;
          //alert(url);
          $.get(url,function(data){ 
              $('#ajax-datos-boleto').empty().html(data);
            });
          $.getScript("{{ asset('js/script.js') }}"); 
      }
      
      
  </script>
@endsection
