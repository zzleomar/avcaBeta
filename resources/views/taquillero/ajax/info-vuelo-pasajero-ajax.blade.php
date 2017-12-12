<input type="hidden" name="boleto_id" value="{{ $boleto_id }}">
<input type="hidden" name="boleto_id2" value="{{ $boleto_id2 }}">

@if(!isset($pasajero))
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputNombre">Nombre del pasajero:</label>
        <div class="input-group mb-2 mb-sm-0">
        <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
          <input type="Nombre" class="form-control" id="inputNombre4" placeholder="Ingrese el nombre" name="nombres" required>
                  </div>
          </div>
          <div class="form-group col-md-6">
                <label for="inputApellido">Apellido del pasajero:</label>
              <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                <input type="text" class="form-control" id="inputApellido4" placeholder="Ingrese el Apellidos" name="apellidos" required>
              </div>
          </div>
          
      </div>


    <div class="form-group">
            <label for="inputAddress">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="inputAddress" placeholder="Direccion de l pasajero" required>
      </div>


    <div class="form-row">
      
        <div class="form-group col-md-6">
                <label for="inputNombre"> Telefono Movil</label>
            <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"> <i class="fa fa-mobile" aria-hidden="true"></i> </div>
                  <input type="text" class="form-control" id="inputNombre4" placeholder="0414 098 1234" name="tlf_movil" required>
                  </div>
          </div>                            
        <div class="form-group col-md-6">
                <label for="inputNombre">Telefono Fijo</label>

                <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                  <input type="text" class="form-control" id="inputNombre4" placeholder="" placeholder="0293 098 1234" name="tlf_casa" required>
                </div>
          </div> 
      </div>      


    <div class="form-group row">
        <label for="inputCosto" class="col-sm-3 col-form-label" style="text-align: right;
font-weight: 800;">Costo total: </label>
        <div class="col-sm-6">
          <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
         <input type="text" readonly class="form-control-plaintext" id="staticEmail2" name="costo" value="{{ $costo }}">
          </div>
        </div>
        </div>
  
  <button type="button" value="Reservar" class="btn btn-lg btn-outline-primary" onclick="formOperativo('/taquilla/accion/Reservar')">Reservar</button>
  <button type="button" value="Pagar" class="btn btn-lg btn-outline-secondary" onclick="formOperativo('/taquilla/accion/Pagar')">Pagar</button>

@else

  <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputNombre">Nombre del pasajero:</label>
        <div class="input-group mb-2 mb-sm-0">
        <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
          <input type="Nombre" class="form-control" id="inputNombre4" placeholder="Ingrese el nombre" name="nombres" value="{{ $pasajero->nombres }}" required>
                  </div>
          </div>
          <div class="form-group col-md-6">
                <label for="inputApellido">Apellido del pasajero:</label>
              <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                <input type="text" class="form-control" id="inputApellido4" placeholder="Ingrese el Apellidos" name="apellidos" value="{{ $pasajero->apellidos }}" required>
              </div>
          </div>
          
      </div>

  @if(isset($estado))
      @include('notifications::flash')
  @endif
  <!-- Si existe algun boleto con algun estado y es distinto de pagado-->
  @if((isset($estado))and($estado=='Pagado'))
      <button type="button" value="Cancelar" class="btn btn-lg btn-outline-secondary" onclick="formOperativo('/taquilla/accion/Cancelar')">Cancelar Boleto</button>
  @else
    <div class="form-group">
            <label for="inputAddress">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="inputAddress" placeholder="Direccion de l pasajero" value="{{ $pasajero->direccion }}" required>
    </div>


    <div class="form-row">
      
        <div class="form-group col-md-6">
                <label for="inputNombre"> Telefono Movil</label>
            <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"> <i class="fa fa-mobile" aria-hidden="true"></i> </div>
                  <input type="text" class="form-control" id="inputNombre4" placeholder="0414 098 1234" name="tlf_movil" value="{{ $pasajero->tlf_movil }}" required>
            </div>
        </div>                            
        <div class="form-group col-md-6">
                <label for="inputNombre">Telefono Fijo</label>

                <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                  <input type="text" class="form-control" id="inputNombre4" placeholder="0293 098 1234" name="tlf_casa" value="{{ $pasajero->tlf_casa }}" required>
                </div>
        </div> 
      </div>      


      <div class="form-group row">
        <label for="inputCosto" class="col-sm-3 col-form-label" style="text-align: right; font-weight: 800;">Costo total: </label>
          <div class="col-sm-6">
            <div class="input-group mb-2 mb-sm-0">
                <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" name="costo" value="{{ $costo }}">
            </div>
        </div>
    </div>

    @if((isset($estado))and($estado=='Reservado'))
      <button type="button" class="btn btn-lg btn-outline-success" value="Pagar" onclick="formOperativo('/taquilla/accion/Pagar')">Pagar</button>
      <button type="button" class="btn btn-lg btn-outline-secondary" value="Liberar" onclick="formOperativo('/taquilla/accion/Liberar')">Cancelar Reservacion</button>
    @elseif((isset($estado))and($estado=='Cancelado'))
        <button type="button" class="btn btn-lg btn-outline-secondary" value="Renovar" onclick="formOperativo('/taquilla/accion/Renovar')">Renovar</button>
        @else
          <button type="button" class="btn btn-lg btn-outline-primary" value="Reservar" onclick="formOperativo('/taquilla/accion/Reservar')">Reservar</button>
          <button type="button" class="btn btn-lg btn-outline-secondary" value="Pagar" onclick="formOperativo('/taquilla/accion/Pagar')">Pagar</button>
        @endif
    @endif
  @endif
