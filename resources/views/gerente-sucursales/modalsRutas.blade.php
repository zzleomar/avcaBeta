

<!-- Modal Nueva Ruta -->
    <form action="{{ URL::to('/gerente-sucursales/administracion-rutas/nueva') }}" method="post" id="nuevaRutaForm" name="nuevaRutaForm">   
                        {{ csrf_field() }}

    <div class="modal fade bd-example-modal-lg" id="NuevaRutaModal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Ruta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body">
        <div class="container" style="padding-left: 15px; padding-right: 15px;  ">
            <div class="row">
                    <div class="col col-sm-12 col-md-12 btn-aux-magin">
                            <div class="input-group">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Origen
                              </button>
                              <div class="dropdown-menu dropAux">
                        @foreach($sucursales as $sucursal)
                                <a class="dropdown-item" id="suO{{ $sucursal->id }}" onclick="capturarO('{{ $sucursal->id }}','A')">{{ $sucursal->nombre }}</a>
                            @endforeach
                              </div>
                            </div>
                             <input type="text" class="form-control" aria-label="Text input with dropdown button" id="origenNRA" placeholder="Seleccione Sucursal de Origen" value="" readonly required>
                             <input type="hidden" name="origenid" id="origenidA" value="">
                            <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>


                            </div>
                    </div>
                    <div class="col col-sm-12 col-md-12 btn-aux-magin">
                            <div class="input-group">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Destino
                              </button>
                              <div class="dropdown-menu dropAux">
                        @foreach($sucursales as $sucursal)
                                <a class="dropdown-item" id="suD{{ $sucursal->id }}" onclick="capturarD('{{ $sucursal->id }}','A')">{{ $sucursal->nombre }}</a>
                            @endforeach
                              </div>
                            </div>
                             <input type="text" class="form-control" aria-label="Text input with dropdown button" id="destinoNRA" placeholder="Seleccione Sucursal de Destino" value="" readonly required>
                             <input type="hidden" name="destinoid" id="destinoidA" value="">
                            <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>


                            </div>
                    </div>
          

                        <div class="row">

                            <div class="form-group col-sm-12 col-md-4"> 
                              <label for="inputEmail4">Distancia Mls.</label>
                              <input type="text" class="form-control" placeholder="Distancia" id="distanciaNR" name="distancia" onkeypress="return soloNumDec(event)" required>
                            </div>

                            <div class="form-group col-sm-12 col-md-4">
                              <label for="inputEmail4">Duración Hrs.</label>
                              <input type="time" class="form-control" id="inputEmail4" placeholder="Duración" id="duracionNR" name="duracion" required>
                            </div>
                            

                            <div class="form-group col-sm-12 col-md-4">
                              <label for="inputEmail4">Tarifa Vuelo Bs.</label>
                              <input type="text" class="form-control" placeholder="Precio" id="precioNR" name="precio" onkeypress="return soloNumDec(event)" required>
                            </div>
                       </div>
    </div>
  </div></div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-lg btn-primary" id="BotonGuardarRuta" onclick="formrutas()">Registrar</button>
                </div>
        
     </div>
  </div></div>
  </form>


  <!--MODAL ELIMINAR RUTA---->

  <form action="{{ URL::to('/gerente-sucursales/administracion-rutas/eliminar') }}" method="post" id="EliminarRutaForm" name="EliminarRutaForm" onkeypress = "return pulsar(event)">   
                        {{ csrf_field() }}
<input type="hidden" name="ruta_id" id="ruta_id" value="">


    <div class="modal fade bd-example-modal-lg" id="ModalEliminarRuta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="card-title" id="tituloModalEliRuta" style="font-size: 25px;
font-weight: 700;"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body">
        <H2 id="notification">¿Esta seguro que desea eliminar esta ruta?</H2>
        <button type="button" class="btn btn-lg btn-outline-secondary" onclick="EliminarRuta('/gerente-sucursales/administracion-rutas/eliminar')">Eliminar</button>
      </div>
                <div class="modal-footer">
                </div>
        
     </div>
  </div></div>
  </form>



<!-- Modal Nueva Ruta -->
    <form action="{{ URL::to('/gerente-sucursales/administracion-rutas/modificar') }}" method="post" id="ModificarRutaForm" name="ModificarRutaForm">   
                        {{ csrf_field() }}

    <div class="modal fade bd-example-modal-lg" id="ModalModificarRuta" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="TituloModalModificarRuta"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body" id="cargandoAux">
        <div class="container" id="ModalAjaxModificarRuta" style="padding-left: 15px; padding-right: 15px;  ">
            
  </div></div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-lg btn-primary" id="BotonGuardarRuta">Actualizar</button>
                </div>
        
     </div>
  </div></div>
  </form>