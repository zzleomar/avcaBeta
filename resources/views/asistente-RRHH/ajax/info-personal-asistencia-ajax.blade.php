@php
  if(sizeof($asistencia)){//si posee una asistencia registrada sin salida
    echo "<input type='hidden' name='Datoasistencia' id='Datoasistencia' value='$asistencia->id'>";
  }
  else{
    echo "<input type='hidden' name='Datoasistencia' id='Datoasistencia' value='0'>";
}
@endphp
<div class="form-row">
          <div class="form-group col-md-4">
                    <label for="inputPuesto"> Nombre:</label>
                    <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                      <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $personal->nombres }}" >
                      </div>
              </div>
              <div class="form-group col-md-4">
                    <label for="inputApellido"> Apellido:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $personal->apellidos }}">
                  </div>
              </div>


              <div class="form-group col-md-4">
                    <label for="inputApellido"> Cargo del empleado:</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-user-o" aria-hidden="true"></i> </div> 
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $personal->empleado->cargo }}">
                  </div> 
              </div>              
          </div>
  
            <br>

        <div class="form-row center">
          
            <div class="form-group col-md-6">
                    <label for="inputNombre"> Teléfono movil</label>
                <div class="input-group col-md-6 mb-4 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-mobile" aria-hidden="true"></i> </div>
                      <input type="Nombre" readonly=""  class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="inputNombre4" value="{{ $personal->tlf_movil }}">
                      </div>
              </div>                            
            <div class="form-group col-md-6">
                    <label for="inputNombre">Teléfono fijo</label>

                    <div class="input-group col-md-6 mb-4 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                      <input type="Nombre" readonly=""  class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="inputNombre4" value="{{ $personal->tlf_casa }}">
                    </div>
              </div> 
          </div> 

<script type="text/javascript">

  $(document).ready(function(){
     $("#labelReg").css("display", "initial");
      if((document.getElementById("Datoasistencia").value)!=0){
         $("#botonSalidaA").css("display", "initial");
      }
      else {
        $("#botonEntradaA").css("display", "initial");
      }

  });  

</script>

