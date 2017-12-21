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
               <div class="form-row marginLeft margenInferior">
                    <label for="codigo" class="col-5" style="text-align: left; margin-top: 10px;">Cantidad de Equipaje</label>
                    <div class="form-row marginLeft col-4">
                        <input type="text" name="cantidad-equipaje" class="form-control" id="cantidad-equipaje" placeholder="" value="{{ old('cantidad-equipaje') }}" required style="margin-left: 6px;" onkeypress="return soloNum(event)")>
                    </div>
                </div>
                <div class="form-row marginLeft input-group margenInferior">
                    <label for="codigo" class="col-5" style="text-align: left; margin-top: 10px;">Peso Total</label>
                    <div class="form-row marginLeft col-5">
                        <input type="text" step="any" name="peso-equipaje" class="form-control" id="peso" placeholder="" value="{{ old('peso-equipaje') }}" required onkeypress="return soloNumDec(event)" onKeyUp="calcular()"><div class="input-group-addon">Kg</div>
                    </div>
                </div>
                <div class="form-row marginLeft input-group margenInferior">
                    <label for="codigo" class="col-5" style="text-align: left; margin-top: 10px;">Costo del sobrepeso</label>
                    <div class="form-row marginLeft col-5">
                            <input type="text" name="costo" class="form-control" id="costo" placeholder=""  value="{{ old('costo') }}" readonly>
                            <div class="input-group-addon">Bs</div>
                    </div>
                </div>
                

            </div>
    
            <div class="row mx-4">
                <input type="submit" class="btn btn-primary btn-lg btn-block my-2 " value="CONFIRMAR">
            </div>

