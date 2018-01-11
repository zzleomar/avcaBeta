<input type="hidden" name="boleto_id" value="{{ $boleto->id }}">

<div class="form-group row mx-2">
                <div class="col">
                  <label for="staticEmail" class="col col-form-label">{{ $pasajero->apellidos." ".$pasajero->nombres }}</label>
                </div>
              </div>
            <div id="datosBoleto">
                <div class="conteneauxLchex"><label for="staticEmail">Vuelo:</label>
                <label class="auxLchex" id="staticEmail" >{{ $vuelo->id }}</label></div>
                <div class="conteneauxLchex"><label for="staticEmail">Ruta:</label>
                <label class="auxLchex" id="staticEmail" >{{ $ruta['origen']." --> ".$ruta['destino'] }}</label></div>
               <div class="conteneauxLchex"> <label for="staticEmail">Nro. Boleto:</label>
                <label class="auxLchex">{{ $boleto->id }}</label></div>
               <div class="conteneauxLchex"> <label for="staticEmail">Asiento:</label>
                <label class="auxLchex">{{ $boleto->asiento }}</label></div>
               <div class="conteneauxLchex"> <label for="staticEmail">Salida:</label>
                <label class="auxLchex">{{ $vuelo->salida }}</label></div>

            </div>
            <br><hr>
                <h4 class="text-center subtituloM">Datos del Equipaje</h4><hr><br>
            <div class="contenerdorDE">
                    <div class="form-row">
                          <div class="form-group col-md-4">
                            <div class="input-group mb-2 mb-sm-0">
                                <label class="col-md-5" style="font-size: 0.8rem;"> Cantidad de Equipaje </label>
                                <input type="text" name="cantidad-equipaje" class="form-control" id="cantidad-equipaje" placeholder="" value="{{ old('cantidad-equipaje') }}" required style="margin-left: 6px;" onkeypress="return soloNum(event)")>
                              </div></div>
                              <div class="form-group col-md-4">
                                  <div class="input-group mb-2 mb-sm-0">
                                    <label class="col-md-5" style="font-size: 0.8rem;">Peso Total</label>
                                    <input type="text" step="any" name="peso-equipaje" class="form-control" id="peso" placeholder="" value="{{ old('peso-equipaje') }}" required onkeypress="return soloNumDec(event)" onKeyUp="calcular()"><div class="input-group-addon">Kg</div>
                                  </div>
                              </div>
                              <div class="form-group col-md-4">
                                  <div class="input-group mb-2 mb-sm-0">
                                    <label class="col-md-5" style="font-size: 0.8rem;">Costo del sobrepeso</label>
                                    <input type="text" name="costo" class="form-control" id="costo" placeholder=""  value="{{ old('costo') }}" readonly>
                                    <div class="input-group-addon">Bs</div>

                                  </div>
                              </div>
                              
                </div>
                

            </div>
    
            <div class="row mx-4">
                <input type="submit" class="btn btn-primary btn-lg btn-block my-2 " value="CONFIRMAR">
            </div>

<script type="text/javascript">
      function calcular(){
        var peso=$('input[name=peso-equipaje]').val();
          if(peso>23){
            var sobrepeso=peso-23;
            var costo=sobrepeso*(({{ $vuelo->pierna->ruta->tarifa_vuelo }}*10)/100); //la tasa de sobrepeso es el 10% de la tarifa del vuelo
            var costoT=costo.toFixed(2);
            $('input[name=costo]').val(costoT); 
          }else {
            $('input[name=costo]').val(0); 
          }
        }
        
</script>