@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 costo-center">            
            <h4 class="text-center subtituloM">Chequeo de boleto</h4>
            <div class="card">
                <div class="card-body">            
                    <form class="visible" action="/taquilla/confirmar-boleto" accept-charset="utf-8" method="POST">                     
                     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
                     <div class="form-group row">
                        <label for="cedula" class="col-sm-2 col-form-label">Pasajero:</label>
                        <div class="input-group col-sm-8">  
                          <div class="input-group-addon">
                              <select name="nacionalidad" id="nacionalidad" class="nationality form-control-lg">
                                  <option value="V">V</option>
                                  <option value="E">E</option>
                              </select>
                          </div>  
                        <input type="text" class="form-control" placeholder="Identificación" id="cedula" name="cedula" onKeyUp="buscarPasajero(this.value)">
                      </div>
                      <div class="input-group costo-center">
                        <label for="cedula" class="col-sm-2 col-form-label">Destino:</label>
                        <div class="input-group col-sm-8">  
                              <select name="vuelos" id="vuelos" class="nationality form-control-lg  col-sm-12">
                                <option value="0">Seleccione el Destino</option>
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
    </div></div>
</div>

@endsection
@section('scripts')
    <script type="text/javascript">
      function calcular(){
                $('input[name=costo]').val(($('input[name=peso-equipaje]').val())*{{ $sucursal->tasa_sobrepeso }});
        }
        function chequear(){
            var ci=document.getElementById("cedula").value;
            var nacionalidad=document.getElementById("nacionalidad").value;
            var vuelo=document.getElementById("vuelos").value;
            ci=nacionalidad+ci;
            var url="{{ URL::to('/taquilla/confirmar/boleto') }}/"+ci+"/"+vuelo;
            //alert(url);
            $.get(url,function(data){ 
                $('#ajax-datos-boleto').empty().html(data);
              });
        }
        
    </script>
@endsection
