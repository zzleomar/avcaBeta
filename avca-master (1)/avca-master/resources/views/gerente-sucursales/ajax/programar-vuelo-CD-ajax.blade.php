<input type="hidden" name="ruta[]" value="{{ $piernas['ruta1']->id }}">
<input type="hidden" name="ruta[]" value="{{ $piernas['ruta2']->id }}">
               
 @include('gerente-sucursales.programar-vuelo')

<div class="subtituloM" style="margin-bottom: 20px;">   
  <h4>SALIDAS DE IDA Y VUELTA</h4></div>
<hr> 
<div class="piernas"> 
      <p><strong>
      {{ $piernas['ruta1']->origen->nombre.' ---> '.$piernas['ruta1']->destino->nombre }}</strong></p>
  <div class="input-group" style="display: ruby;">
      <div class="text-center marginLeft" style="display: inline-block;">
        <label class="labelPierna">Hora: </label>
        </div>
      <div class="text-center marginLeft" style="display: inline-block; margin-bottom: 30px;">
          <input type="text" placeholder="introduzca hora 12:00 AM" name="hora[]"  id="hora2" value="{{ DATE('H:i:s',strtotime($primero)) }}" readonly class="form-control-plaintext" style="width: 66px;" /><br>
      </div>
      
  </div>
<hr>
    <p><strong>
      {{ $piernas['ruta2']->origen->nombre.' ---> '.$piernas['ruta2']->destino->nombre }}</strong></p>
    <div class="input-group" style="display: ruby;">
      <div class="text-center marginLeft" style="display: inline-block;">
        <label class="labelPierna">Hora: </label>
        </div>
      <div class="text-center marginLeft" style="display: inline-block;">
          <input type="time" placeholder="introduzca hora 12:00 AM" name="hora[]"  id="hora1" min="{{ DATE('H:i:s',strtotime($segundo['despues'])) }}" max="{{ DATE('H:i:s',strtotime($segundo['antes'])) }}" value="{{ DATE('H:i:s',strtotime($segundo['despues'])) }}" oninvalid="setCustomValidity('Seleccione una hora valida')"
            oninput="setCustomValidity('')" /><br>
      </div>
      
  </div><small id="salidaHelpBlock" style="margin-bottom: 30px;" class="form-text text-muted">
        La hora para esta salida debe estar despues de {{ DATE('H:i:s',strtotime($segundo['despues'])) }} y antes de {{ DATE('H:i:s',strtotime($segundo['antes'])) }}
      </small>
</div>
        
<button type="submit" class="btn btn-lg btn-primary" style="margin: auto;" id="BotonPlanificarVuelo">Guardar</button>