@php
  if(sizeof($asistencia)){//si posee una asistencia registrada sin salida
    echo "<input type='hidden' name='Datoasistencia' id='Datoasistencia' value='$asistencia->id'>";
  }
  else{
    echo "<input type='hidden' name='Datoasistencia' id='Datoasistencia' value='0'>";
}
@endphp
<div class="form-row">
    <div class="form-group col-md-6">    
      <label for="inputEmail4">Nombre y apellido:</label>
       <i class="fa fa-user-o" aria-hidden="true"></i>   
      <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $personal->nombres.' '.$personal->apellido }}" > 
     </div>
     
    <div class="form-group col-md-6">      
      <label for="inputPassword4">Cargo del empleado:</label>  
       <i class="fa fa-user-o" aria-hidden="true"></i>       
       <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $personal->empleado->cargo }}" >
    </div>
  </div>

  <br>         

 <div class="form-row">
    <div class="form-group col-md-6">    
     <label for="inputNombre">Telefono movil: </label> 
      <i class="fa fa-mobile" aria-hidden="true"></i>
      <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $personal->tlf_movil }}" > 
     </div>
     
    <div class="form-group col-md-6">      
       <label for="inputNombre">Telefono fijo: </label> 
       <i class="fa fa-phone" aria-hidden="true"></i>    
       <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $personal->tlf_casa }}" >
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

