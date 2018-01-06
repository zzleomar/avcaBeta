<!--MODAL CANCELAR VUELO---->
<form name="CancelarVuelo" id="FormEstadoVuelo" method="POST" onkeypress = "return pulsar(event)">
                    {{ csrf_field() }}
<input type="hidden" name="vuelo_id" id="vuelo_id" value="">
<div class="modal fade bd-example-modal-lg" id="ModalCancelarVuelo" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="card-title" id="tituloModal" style="font-size: 25px;
font-weight: 700;"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <H2 id="notification">¿Esta seguro que desea cancelar el vuelo?</H2>
        <button type="button" class="btn btn-lg btn-outline-secondary" onclick="estadoVuelo('/gerente-sucursales/cancelar')">Cancelar Vuelo</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
</form>

<!--MODAL VER---->
<div class="modal fade bd-example-modal-lg" id="VerVuelo" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="card-title" style="font-size: 25px;
font-weight: 700;" id="rutaStringV"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cargandoAux">
        <div id="ajax-ver-vuelo"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>


<!--MODAL PROGRAMAR---->
<form name="FormProgramarVuelo" id="FormProgramarVuelo" method="POST" onsubmit="return planificarVuelo('/gerente-sucursales/planificar')">
                    {{ csrf_field() }}

<div class="modal fade bd-example-modal-lg" id="ProgramarVuelo" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="card-title" style="font-size: 25px;
font-weight: 700;">Programar vuelo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cargandoAuxP">
        <div class="col col-sm-12 col-md-12 btn-aux-magin" id="rutaAux">
                <div class="input-group">

                <div class="input-group-btn">
                  <button type="button" class="btn btn-secondary dropdown-toggle"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Origen
                  </button>
                  <div class="dropdown-menu dropAux">
            @foreach($origenes as $sucursal)
                    <a class="dropdown-item" id="suO{{ $sucursal->id }}" onclick="capturarO('{{ $sucursal->id }}','X')">{{ $sucursal->nombre }}</a>
                @endforeach
                  </div>
                </div>
                 <input type="text" class="form-control" aria-label="Text input with dropdown button" id="origenNRX" placeholder="Seleccione Sucursal de Origen" value="{{ $central->nombre }}" readonly required>
                 <input type="hidden" name="origenid" id="origenidX" value="{{ $central->id }}">
                <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>


                </div>
        </div>
        <div class="col col-sm-12 col-md-12 btn-aux-magin" id="rutaAux">
                <div class="input-group">

                <div class="input-group-btn">
                  <button type="button" class="btn btn-secondary dropdown-toggle"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Destino
                  </button>
                  <div class="dropdown-menu dropAux">
            @foreach($origenes as $sucursal)
                    <a class="dropdown-item" id="suD{{ $sucursal->id }}" onclick="capturarD('{{ $sucursal->id }}','X')">{{ $sucursal->nombre }}</a>
                @endforeach
                  </div>
                </div>
                 <input type="text" class="form-control" aria-label="Text input with dropdown button" id="destinoNRX" placeholder="Seleccione Sucursal de Destino" value="" readonly required>
                 <input type="hidden" name="destinoid" id="destinoidX" value="">
                <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>


                </div>
        </div>
         <div class="row">
            <div class="col mt-6">
              <div class="input-group">
                  <div class="text-center marginLeft">
                    <label class="infoTitulo">Fecha del Vuelo: </label>
                    </div>
                    <div class="text-center marginLeft">
                      <input type="date" placeholder="introduzca fecha mm/dd/yyyy" name="fechaSalida" id="fechaSalida" class="form-perso-help" value="" required /><br>
                  </div> 
                  <div class="text-center marginLeft">
                    <label class="infoTitulo">Hora: </label>
                    </div>
                  <div class="text-center marginLeft">
                      <input type="time" placeholder="introduzca hora 12:00 AM" name="horaSalida" id="horaSalida" class="form-perso-help" value="" required oninvalid="setCustomValidity('Seleccione una hora valida')" oninput="setCustomValidity('')" /><br>
                  </div> 
                  <button type="button" class="btn btn-primary" onclick="programar()">Programar</button>
              </div>
            </div>    
        </div>
        
        <div id="ajax-reprogramar-vuelo" style="margin-top: 20px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
</form>