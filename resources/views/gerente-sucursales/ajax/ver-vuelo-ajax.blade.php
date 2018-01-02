
<div id="AccordionProg" data-children=".item">
   

    <a class="btn btn-primary " data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg1" aria-expanded="true" aria-controls="AccordionProg1">
      Vuelo
    </a>
 

    <a class="btn btn-primary" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg2" aria-expanded="false" aria-controls="AccordionProg2">
      Tripulantes/Aeronave
    </a>

    <div class="item" style="margin-top: 10px;">
   
      <div id="AccordionProg1" class="collapse show" role="tabpanel">
          <div class="subtituloM"><h4>Datos del Vuelo</h4></div> <br>
          <div class="form-row">
            <div class="form-group col-md-5 centrarAux">
                  <label class="infoTitulo" for="inputPuesto">Fecha: {{ DATE('d/m/Y',strtotime($vuelo->salida)) }}</label>
            </div>
            <div class="form-group col-md-5 centrarAux">
                  <label class="infoTitulo" for="inputPuesto">Hora: 
            {{ DATE('H:i:s',strtotime($vuelo->salida)) }}</label>
            </div>
          </div><br><hr><br>
          @if(($vuelo->estado=='abierto')||($vuelo->estado=='cerrado'))
          <div class="form-row">
            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Boletos Vendidos</label>
                <div class="input-group mb-2 mb-sm-0">
                      <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Pagados'] }}">
                </div>
            </div>

                      
            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Boletos Reservados</label>
                <div class="input-group mb-2 mb-sm-0">
                      <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Reservados'] }}">
                </div>
            </div>
            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Boletos Chequeados</label>
                <div class="input-group mb-2 mb-sm-0">
                      <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Chequeados'] }}">
                </div>
            </div>

                      
            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Boletos Cancelados</label>
                <div class="input-group mb-2 mb-sm-0">
                      <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Cancelados'] }}">
                </div>
            </div>
        </div> 
        <div class="form-row">
            
        </div>  
        @elseif(($vuelo->estado=='retrasado')||($vuelo->estado=='ejecutado'))
          
          <div class="form-row">
            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Boletos Vendidos</label>
                <div class="input-group mb-2 mb-sm-0">
                      <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Pagados'] }}">
                </div>
            </div>
            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Boletos Chequeados</label>
                <div class="input-group mb-2 mb-sm-0">
                      <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Chequeados'] }}">
                </div>
            </div>
            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Boletos Cancelados</label>
                <div class="input-group mb-2 mb-sm-0">
                      <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Cancelados'] }}">
                </div>
            </div>
          </div>

        @else
            <div class="form-row-center">
            <div class="form-group col-md-5 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Boletos Cancelados</label>
                <div class="input-group mb-2 mb-sm-0">
                      <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Cancelados'] }}">
                </div>
            </div>
          </div>
        @endif
      </div>
      <div id="AccordionProg2" class="collapse" role="tabpanel">
          <div class="subtituloM"><h4>Tripulantes</h4></div> <hr> 
          <div class="table-responsive"> 
              <table class="table table-hover text-center">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Experiencia (Hrs Voladas)</th>
                    <th>Licencia</th>
                    <th></th>
                  </tr>
                </thead>
                <?php 
                    $tripulantes=$vuelo->tripulantes;
                    $size=sizeof($tripulantes);
                    for ($i=0; $i < $size; $i++) { 
                      $persona=$tripulantes[$i]->Persona();

                 ?>

                <tbody>
                  <th scope="row">{{ $tripulantes[$i]->rango }}</th>
                
                    <td>{{ $persona->apellidos." ".$persona->nombres }}</td>
                    <td id="he{{ $tripulantes[$i]->id }}"></td>
                    <td>{{ $tripulantes[$i]->licencia }}</td>
                    <td><button class="btn btn2 btn-primary">Sustituir</button></td>
                </tbody>
                <?php } ?>
              </table>
              </div>   
          <div class="subtituloM"><h4>Aeronave</h4></div> <hr>
          <div class="form-row">
            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Matricula: </label><label style="margin-left: 10px;">{{ $vuelo->pierna->aeronave->matricula }}</label>
            </div>
            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Modelo: </label><label style="margin-left: 10px;">{{ $vuelo->pierna->aeronave->modelo }}</label>
            </div>

            <div class="form-group col-md-3 centrarAux">
                <label class="infoTitulo" for="inputPuesto">Ultimo Matenimiento: </label><label style="margin-left: 10px;">{{ DATE('d/m/Y',strtotime($vuelo->pierna->aeronave->ultimo_mantenimiento)) }}</label>
            </div>
          </div>
      </div>
    </div>
</div>  
<script type="text/javascript">
$(document).ready(function(){

<?php 
        for ($i=0; $i < $size; $i++) { 
         
     ?>
          var acumulado=parseInt('<?php if(!(is_null($he[$i]->horas))){echo $he[$i]->horas;}else{ echo "000000";} ?>'); //tengo la cantidad en entero de horas, minutos y segundos
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
          var id='he'+'<?php echo $tripulantes[$i]->id; ?>';
          document.getElementById(id).innerHTML=horas+":"+min+":00 Hrs";

<?php } ?>
});

</script>