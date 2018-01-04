<div class="subtituloM" style="margin-bottom: 20px;">   
  <h4>ASIGNACIÓN DE PERSONAL Y AERONAVE</h4>
</div>
<hr>  

<div id="AccordionProgVuelo" data-children=".item">

    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProgVuelo" href="#AccordionProgVuelo1" aria-expanded="true" aria-controls="AccordionProgVuelo1">
      Seleción de Piloto
    </a>
 

    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProgVuelo" href="#AccordionProgVuelo2" aria-expanded="false" aria-controls="AccordionProgVuelo2">
      Selección de Copiloto
    </a>

    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProgVuelo" href="#AccordionProgVuelo3" aria-expanded="false" aria-controls="AccordionProgVuelo3">
      Selección de Jefe de Cabina
    </a>
 
    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProgVuelo" href="#AccordionProgVuelo4" aria-expanded="false" aria-controls="AccordionProgVuelo4">
      Selección de Sobrecargos
    </a>

    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProgVuelo" href="#AccordionProgVuelo5" aria-expanded="false" aria-controls="AccordionProgVuelo5">
      Seleción de Aeronave
    </a>


      <div class="item">
       
        <div id="AccordionProgVuelo1" class="collapse show" role="tabpanel">
         <div class="card card-body">
        
         <div class="table-responsive divtablaAux"> 
      <table class="table table-hover text-center tablaAux">
        <thead class="thead-light">
          <tr>
            <th>Pilotos</th>
            <th>Horas de Experiencia</th>
            <th>Horas de Quincena</th>
            <th>Asignar</th>
          </tr>
        </thead>
        <?php 
            $size=sizeof($pilotos);
            for ($i=0; $i < $size; $i++) { 
             
         ?>

        <tbody>
          <td>{{ $pilotos[$i]->nombres." ".$pilotos[$i]->apellidos }}</td>
            <td id="pihe{{ $pilotos[$i]->id }}"></td>
            <td id="pihp{{ $pilotos[$i]->id }}"></td>
           <td>
              <label class="custom-control custom-radio">
                  <input id="piloto{{ $pilotos[$i]->id }}" type="radio" class="custom-control-input pilotoRadio" name="piloto" value="{{ $pilotos[$i]->id }}">
                  <span class="custom-control-indicator"></span>
                </label>    
           </td>
        </tbody>
        <?php } ?>

      </table>
      </div>
        </div>
      </div>
      </div>


      <div class="item">
        <div id="AccordionProgVuelo2" class="collapse" role="tabpanel">
          <div class="card card-body">
        
            <div class="table-responsive divtablaAux"> 
               <table class="table table-hover text-center tablaAux">
                   <thead class="thead-light">
                        <tr>
                         <th>Copilotos</th>
                         <th>Horas de Experiencia</th>
                         <th>Horas de Quincena</th>
                         <th>Asignar</th>
                       </tr>
                   </thead>
        <?php 
            $size=sizeof($copilotos);
            for ($i=0; $i < $size; $i++) { 
             
         ?>

          <tbody>
          <td>{{ $copilotos[$i]->nombres." ".$copilotos[$i]->apellidos }}</td>
            <td id="copihe{{ $copilotos[$i]->id }}"></td>
            <td id="copihp{{ $copilotos[$i]->id }}"></td>
           <td>
                <label class="custom-control custom-radio">
                    <input id="copiloto{{ $copilotos[$i]->id }}"  type="radio" class="custom-control-input" name="copiloto" value="{{ $copilotos[$i]->id }}">
                    <span class="custom-control-indicator"></span>
          
                  </label>      
           </td>
           </tbody> 
        <?php } ?>

               </table>
            </div>
          </div>
         </div>
      </div>
  
     <div class="item">
       <div id="AccordionProgVuelo3" class="collapse" role="tabpanel">
      <div class="card card-body">
        
        <div class="table-responsive divtablaAux"> 
      <table class="table table-hover text-center tablaAux">
        <thead class="thead-light">
          <tr>
            <th>Jefa de Cabina</th>
            <th>Horas de Experiencia</th>
            <th>Horas de Quincena</th>
            <th>Asignar</th>
          </tr>
        </thead>
        <?php 
            $size=sizeof($jefacs);
            for ($i=0; $i < $size; $i++) { 
             
         ?>
          <tbody>
          <th scope="row">{{ $jefacs[$i]->nombres." ".$jefacs[$i]->apellidos }}</th>
            <td id="jche{{ $jefacs[$i]->id }}"></td>
            <td id="jchp{{ $jefacs[$i]->id }}"></td>
           <td>
          <label class="custom-control custom-radio">
              <input id="jefac{{ $jefacs[$i]->id }}"  type="radio" class="custom-control-input" name="jefac" value="{{ $jefacs[$i]->id }}">
              <span class="custom-control-indicator"></span>
            </label>
           </td>
           </tbody> <?php } ?>
        
      </table>
      </div>
      </div>
    </div>
      </div>


     <div class="item">
       
        <div id="AccordionProgVuelo4" class="collapse" role="tabpanel">
         
         <div class="card card-body">
        
          <div class="table-responsive divtablaAux"> 
      <table class="table table-hover text-center tablaAux">
        <thead class="thead-light">
          <tr>
            <th>Sobrecargos</th>
            <th>Horas de Experiencia</th>
            <th>Horas de Quincena</th>
            <th>Asignar</th>
          </tr>
        </thead>

        <?php 
            $size=sizeof($sobrecargos);
            for ($i=0; $i < $size; $i++) { 
             
         ?>
        <tbody>
         
          <th scope="row">{{ $sobrecargos[$i]->nombres." ".$sobrecargos[$i]->apellidos }}</th>
            <td id="sohe{{ $sobrecargos[$i]->id }}"></td>
            <td id="sohp{{ $sobrecargos[$i]->id }}"></td>
            <td>
              <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="t{{ $sobrecargos[$i]->id }}" name="sobrecargos[]" onclick="doIt(this)" value="{{ $sobrecargos[$i]->id }}">
                <span class="custom-control-indicator"></span>
              </label>
           </td>
        </tbody><?php } ?>
        </table>
      </div>
      </div>
    </div>
    </div>

  <div class="item">
     
      <div id="AccordionProgVuelo5" class="collapse" role="tabpanel">
       <div class="card card-body">
      
       <div class="table-responsive divtablaAux"> 
    <table class="table table-hover text-center tablaAux">
      <thead class="thead-light">
        <tr>
          <th>Aeronave</th>
          <th>Modelo</th>
          <th>Horas de Vuelo Post-Mantenimiento</th>
          <th>Asignar</th>
        </tr>
      </thead>

      <?php 
          $size=sizeof($aeronaves);
          for ($i=0; $i < $size; $i++) { 
           
       ?>

      <tbody>
        <td>{{ $aeronaves[$i]->matricula }}</td>
        <td>{{ $aeronaves[$i]->modelo }}</td>
        <td id="aehm{{ $aeronaves[$i]->id }}"></td>
         <td>
            <label class="custom-control custom-radio">
                <input id="aeronave{{ $aeronaves[$i]->id }}" type="radio" class="custom-control-input" name="aeronave" value="{{ $aeronaves[$i]->id }}">
                <span class="custom-control-indicator"></span>
              </label>    
         </td>
      </tbody>
      <?php } ?>
    </table>
    </div>
      </div>
    </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

<?php 
        $size=sizeof($pilotos);
        for ($i=0; $i < $size; $i++) { 
         
     ?>
          var acumulado=parseInt('<?php if(!(is_null($pihe[$i]->horas))){echo $pihe[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='pihe'+'<?php echo $pilotos[$i]->id; ?>';
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";

          var acumulado=parseInt('<?php if(!(is_null($pihp[$i]->horas))){echo $pihp[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='pihp'+'<?php echo $pilotos[$i]->id; ?>';
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";

<?php } ?>

<?php 
        $size=sizeof($copilotos);
        for ($i=0; $i < $size; $i++) { 
         
     ?>
          var acumulado=parseInt('<?php if(!(is_null($copihe[$i]->horas))){echo $copihe[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='copihe'+'<?php echo $copilotos[$i]->id; ?>';
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";

          var acumulado=parseInt('<?php if(!(is_null($copihp[$i]->horas))){echo $copihp[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='copihp'+'<?php echo $copilotos[$i]->id; ?>';
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";

<?php } ?>

<?php 
        $size=sizeof($jefacs);
        for ($i=0; $i < $size; $i++) { 
         
     ?>
          var acumulado=parseInt('<?php if(!(is_null($jche[$i]->horas))){echo $jche[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='jche'+'<?php echo $jefacs[$i]->id; ?>';
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";

          var acumulado=parseInt('<?php if(!(is_null($jchp[$i]->horas))){echo $jchp[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='jchp'+'<?php echo $jefacs[$i]->id; ?>';
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";

<?php } ?>

<?php 
        $size=sizeof($sobrecargos);
        for ($i=0; $i < $size; $i++) { 
         
     ?>
          var acumulado=parseInt('<?php if(!(is_null($sohe[$i]->horas))){echo $sohe[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='sohe'+'<?php echo $sobrecargos[$i]->id; ?>';
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";

          var acumulado=parseInt('<?php if(!(is_null($sohp[$i]->horas))){echo $sohp[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='sohp'+'<?php echo $sobrecargos[$i]->id; ?>';
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";

<?php } ?>


<?php 
        $size=sizeof($aeronaves);
        for ($i=0; $i < $size; $i++) { 
         
     ?>
          var acumulado=parseInt('<?php if(!(is_null($aehm[$i]->horas))){echo $aehm[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
          var acumulado=acumulado/100;  //elimino los segundos
          var Auxhoras=acumulado/60; //saco las horas con posibles decimales
          var horas=Math.trunc(Auxhoras); //saco las horas
          var min=((Auxhoras-horas)*60).toFixed(2); //saco los minutos
          if(parseInt(min)==0){
            min='00';
          } 
          else {
            min=parseInt(min);
          }
          var idpi='aehm'+'<?php echo $aeronaves[$i]->id; ?>';
          document.getElementById(idpi).innerHTML=horas+":"+min+":00 Hrs";


<?php } ?>
        
});
  
</script>