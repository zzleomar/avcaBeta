

<!-- Modal Nueva Empleado -->
    <form action="{{ URL::to('/RRHH/administracion-empleados/nueva') }}" method="post" id="nuevaEmpleadoForm" name="nuevaEmpleadoForm">   
                        {{ csrf_field() }}

    <div class="modal fade bd-example-modal-lg" id="NuevaEmpleadoModal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Empleado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body">
        <div class="container" style="padding-left: 15px; padding-right: 15px;  ">
          <h1>NUEVOO</h1>
            </div>
          </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-lg btn-primary" id="BotonGuardarEmpleado" onclick="formempleados()">Registrar</button>
                </div>
        
     </div>
  </div></div>
  </form>


  <!--MODAL ELIMINAR Empleado---->

  <form action="{{ URL::to('/RRHH/administracion-empleados/eliminar') }}" method="post" id="EliminarEmpleadoForm" name="EliminarEmpleadoForm" onkeypress = "return pulsar(event)">   
                        {{ csrf_field() }}
<input type="hidden" name="empleado_id" id="empleado_id" value="">


    <div class="modal fade bd-example-modal-lg" id="ModalEliminarEmpleado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h4 class="card-title" id="tituloModalEliEmpleado" style="font-size: 25px;
font-weight: 700;"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body">
        <H2 id="notification">¿Esta seguro que desea eliminar esta empleado?</H2>
        <button type="button" class="btn btn-lg btn-outline-secondary" onclick="EliminarEmpleado('/RRHH/administracion-empleados/eliminar')">Eliminar</button>
      </div>
                <div class="modal-footer">
                </div>
        
     </div>
  </div></div>
  </form>



<!-- Modal Modificar Empleado -->
    <form action="{{ URL::to('/RRHH/administracion-empleados/modificar') }}" method="post" id="ModificarEmpleadoForm" name="ModificarEmpleadoForm">   
                        {{ csrf_field() }}

    <div class="modal fade bd-example-modal-lg" id="ModalModificarEmpleado" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="TituloModalModificarEmpleado"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
      
      <div class="modal-body" id="cargandoAux">
        <div class="container" id="ModalAjaxModificarEmpleado" style="padding-left: 15px; padding-right: 15px;  ">
            
  </div></div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-lg btn-primary" id="BotonGuardarEmpleado">Actualizar</button>
                </div>
        
     </div>
  </div></div>
  </form>