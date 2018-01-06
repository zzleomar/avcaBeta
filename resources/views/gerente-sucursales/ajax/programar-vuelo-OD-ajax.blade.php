<input type="hidden" name="ruta[]" value="{{ $piernas['ruta1']->id }}">
<input type="hidden" name="ruta[]" value="{{ $piernas['ruta2']->id }}">
<input type="hidden" name="ruta[]" value="{{ $piernas['ruta3']->id }}">
 @include('gerente-sucursales.programar-vuelo')

<div class="subtituloM" style="margin-bottom: 20px;">   
  <h4>HORAS DE SALIDAS DE IDA Y VUELTA</h4></div>
<hr> 
<div class="piernas"> 
    <p><strong>
      {{ $piernas['ruta1']->origen->nombre.' ---> '.$piernas['ruta1']->destino->nombre }}</strong></p>
    <div class="input-group" style="display: ruby;">
      <div class="text-center marginLeft" style="display: inline-block;">
        <label class="labelPierna">Hora: </label>
        </div>
      <div class="text-center marginLeft" style="display: inline-block;">
          <input type="time" placeholder="introduzca hora 12:00 AM" name="hora[]"  id="hora1" min="{{ DATE('H:i:s',strtotime($primero['despues'])) }}" max="{{ DATE('H:i:s',strtotime($primero['antes'])) }}" value="{{ DATE('H:i:s',strtotime($primero['despues'])) }}" oninvalid="setCustomValidity('Seleccione una hora valida')"
            oninput="setCustomValidity('')" /><br>
      </div>
      
  </div><small id="salidaHelpBlock" style="margin-bottom: 30px;" class="form-text text-muted">
        La hora para esta salida debe estar despues de {{ DATE('H:i:s',strtotime($primero['despues'])) }} y antes de {{ DATE('H:i:s',strtotime($primero['antes'])) }}
      </small>
<hr>
    <p><strong>
      {{ $piernas['ruta2']->origen->nombre.' ---> '.$piernas['ruta2']->destino->nombre }}</strong></p>
  <div class="input-group" style="display: ruby;">
      <div class="text-center marginLeft" style="display: inline-block;">
        <label class="labelPierna">Hora: </label>
        </div>
      <div class="text-center marginLeft" style="display: inline-block; margin-bottom: 30px;">
          <input type="text" placeholder="introduzca hora 12:00 AM" name="hora[]"  id="hora2" value="{{ DATE('H:i:s',strtotime($segundo)) }}" readonly class="form-control-plaintext" style="width: 66px;" /><br>
      </div>
      
  </div>
<hr>
    <p><strong>
      {{ $piernas['ruta3']->origen->nombre.' ---> '.$piernas['ruta3']->destino->nombre }}</strong></p>
  <div class="input-group" style="display: ruby;">
      <div class="text-center marginLeft" style="display: inline-block;">
        <label class="labelPierna">Hora: </label>
        </div>
      <div class="text-center marginLeft" style="display: inline-block;">
          <input type="time" placeholder="introduzca hora 12:00 AM" name="hora[]"  id="hora1" min="{{ DATE('H:i:s',strtotime($tercero['despues'])) }}" max="{{ DATE('H:i:s',strtotime($tercero['antes'])) }}" value="{{ DATE('H:i:s',strtotime($tercero['despues'])) }}" oninvalid="setCustomValidity('Seleccione una hora valida')"
            oninput="setCustomValidity('')" /><br>
      </div>
      
  </div><small id="salidaHelpBlock" style="margin-bottom: 30px;" class="form-text text-muted">
        La hora para esta salida debe estar despues de {{ DATE('H:i:s',strtotime($tercero['despues'])) }} y antes de {{ DATE('H:i:s',strtotime($tercero['antes'])) }}
      </small>
</div>
        
<button type="submit" class="btn btn-lg btn-primary" onclick="planificarVuelo('/gerente-sucursales/planificar')" style="margin: auto;" id="BotonPlanificarVuelo">Guardar</button>