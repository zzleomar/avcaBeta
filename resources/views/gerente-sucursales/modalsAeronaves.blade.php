

<!-- Modal Nueva Aeronave -->
    <form action="{{ URL::to('/gerente-sucursales/administracion-aeronaves/nueva') }}" method="POST" id="nuevaAeronaveForm" name="nuevaAeronaveForm">   
                        {{ csrf_field() }}

    <div class="modal fade bd-example-modal-lg" id="NuevaAeronaveModal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Aeronave</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body">
        <div class="container" style="padding-left: 15px; padding-right: 15px;  ">
            <div class="form-row">


              <div class="form-group col-sm-12 col-md-6">
                <input type="text" class="form-control" id="matriculaN" name="matricula" placeholder="matricula" required>
              </div>
                                                               
              <div class="form-group col-sm-12 col-md-6">
                <input type="text" class="form-control" id="modeloN" name="modelo" placeholder="modelo" required>
              </div>

              <div class="form-group col-sm-12 col-md-6">
                <input type="text" class="form-control" id="capacidadN" name="capacidad" placeholder="capacidad" onkeypress="return soloNumDec(event)" required>
              </div>


              <div class="form-group col-sm-12 col-md-6">
                <select class="form-control" name="estado">
                  <option value="activo" selected>activo</option>
                  <option value="inactivo">inactivo</option>
                  <option value="mantenimento">mantenimento</option>
                </select>
              </div>

          </div>
  </div></div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-lg btn-primary" id="BotonGuardarAeronave" onclick="formAeronaves()">Registrar</button>
                </div>
        
     </div>
  </div></div>
  </form>


  <!--MODAL ELIMINAR Aeronave---->

  <form action="{{ URL::to('/gerente-sucursales/administracion-aeronaves/eliminar') }}" method="post" id="EliminarAeronaveForm" name="EliminarAeronaveForm" onkeypress = "return pulsar(event)">   
                        {{ csrf_field() }}
<input type="hidden" name="aeronave_id" id="aeronave_id" value="">


    <div class="modal fade bd-example-modal-lg" id="ModalEliminarAeronave" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="card-title" id="tituloModalEliAeronave" style="font-size: 25px;
font-weight: 700;"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body">
        <H2 id="notification">¿Esta seguro que desea eliminar esta Aeronave?</H2>
        <button type="button" class="btn btn-lg btn-outline-secondary" onclick="EliminarAeronave('/gerente-sucursales/administracion-aeronaves/eliminar')">Eliminar</button>
      </div>
                <div class="modal-footer">
                </div>
        
     </div>
  </div></div>
  </form>



<!-- Modal Modificar Aeronave -->
    <form action="{{ URL::to('/gerente-sucursales/administracion-aeronaves/modificar') }}" method="post" id="ModificarAeronaveForm" name="ModificarAeronaveForm">   
                        {{ csrf_field() }}

    <div class="modal fade bd-example-modal-lg" id="ModalModificarAeronave" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="TituloModalModificarAeronave"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body" id="cargandoAux">
        <div class="container" id="ModalAjaxModificarAeronave" style="padding-left: 15px; padding-right: 15px;  ">
            
  </div></div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-lg btn-primary" id="BotonGuardarAeronave">Actualizar</button>
                </div>
        
     </div>
  </div></div>
  </form>