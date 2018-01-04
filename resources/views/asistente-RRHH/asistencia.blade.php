@extends('layouts.app')

@section('content')
@include('notifications::flash')

<form method="post" id="FormRegistrarAsistencia">
                        {{ csrf_field() }}
     <div class="card-body " id="targetL">
        <h4 class="card-title">Control de Asistencias</h4>
      <br>
       <div class="form-inline align-items-center">          
            <div class="form-group col-md-6">
                <label for="inputIdentificacion4">Identificación:</label>
               <div class="input-group">  
                  <div class="input-group-addon">
                      <select name="nacionalidad" id="nacionalidad" class="nationality">
                          <option value="V">V</option>
                          <option value="E">E</option>
                          <option value="E">N</option>
                      </select>
                  </div>  
                <input type="text" class="form-control" placeholder="Identificación" name="cedula" id="cedula" onkeypress="return soloNumDec(event)">
                <button type="button" class="btn btn-primary" onclick="ajaxPersoAsist()">Buscar</button>
              </div>
            </div> 
            <div class="form-group col-md-6" style="height: 10px;">
                <label for="inputIdentificacion4" style="font-weight: 600; margin-right: 10px;" id="labelReg">REGISTRAR</label>
               <div class="input-group">  

              <button type="button" class="btn btn-lg btn-outline-primary" id="botonEntradaA" style="margin-right: 10px;" onclick="RegistrarAsistencia('/RRHH/asistencia/registrar/entrada')">ENTRADA</button> 
                  <button type="button" class="btn btn-lg btn-outline-success" id="botonSalidaA" onclick="RegistrarAsistencia('/RRHH/asistencia/registrar/salida')">SALIDA</button>
              </div>
            </div>
          </div> 
         <br>          
        <div id="ajaxPerso">
          
        </div>     
      </div>
</form>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
     $("#botonEntradaA").css("display", "none");
     $("#botonSalidaA").css("display", "none");
     $("#labelReg").css("display", "none");
});

  function ajaxPersoAsist(){

     $("#botonEntradaA").css("display", "none");
     $("#botonSalidaA").css("display", "none");
     $("#labelReg").css("display", "none");
    var targetL = $('#targetL');
    targetL.loadingOverlay();
    var nacionalidad=document.getElementById("nacionalidad").value;
    var id=document.getElementById("cedula").value;
    var url="{{ URL::to('/RRHH/asistencia/ajax-asistencia') }}/"+nacionalidad+"/"+id;
    //alert(url);
    $.get(url,function(data){ 
        $('#ajaxPerso').empty().html(data);
        targetL.loadingOverlay('remove');
      });
  }

  function RegistrarAsistencia(action){
        document.getElementById('FormRegistrarAsistencia').action = action;
        document.getElementById('FormRegistrarAsistencia').submit();
  }
  

</script>
@endsection