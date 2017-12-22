<!--MODAL CANCELAR VUELO---->
<form name="CancelarVuelo" id="CancelarVuelo" method="POST" onkeypress = "return pulsar(event)">
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
        <button type="button" class="btn btn-lg btn-outline-secondary" onclick="cancelarVuelo('/gerente-sucursales/cancelar')">Cancelar Vuelo</button>
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
font-weight: 700;">Datos del vuelo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
      <div class="modal-body" id="cargandoAux">
         <div class="row">
            <div class="col mt-6">
              <div class="input-group">
                  <div class="text-center marginLeft">
                    <label class="infoTitulo">Fecha del Vuelo: </label>
                    </div>
                    <div class="text-center marginLeft">
                      <input type="date" placeholder="introduzca fecha mm/dd/yyyy" name="fechaSalida" id="fechaSalida" value="" /><br>
                  </div> 
                  <div class="text-center marginLeft">
                    <label class="infoTitulo">Hora: </label>
                    </div>
                  <div class="text-center marginLeft">
                      <input type="time" placeholder="introduzca hora 12:00 AM" name="horaSalida" id="horaSalida" value="" /><br>
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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
   <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

        

 <div id="exampleAccordion" data-children=".item">
   
    <a class="btn btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion1" aria-expanded="true" aria-controls="exampleAccordion1">
      Selecion de piloto
    </a>
 

    <a class="btn btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion2" aria-expanded="false" aria-controls="exampleAccordion2">
      Seleccion de Copiloto
    </a>

    <a class="btn btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion3" aria-expanded="false" aria-controls="exampleAccordion3">
      Seleccion de Jefe de Cabina
    </a>
 
    <a class="btn btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion4" aria-expanded="false" aria-controls="exampleAccordion4">
      Seleccion de aeromosas
    </a>



  <div class="item">
   
    <div id="exampleAccordion1" class="collapse show" role="tabpanel">
     <div class="card card-body">
    
     <div class="table-responsive"> 
  <table class="table table-hover text-center">
    <thead class="thead-light">
      <tr>
        <th>Pilotos</th>
        <th>Horas_Parciales</th>
        <th>Horas_Percibidas</th>
        <th>Estatus</th>
        <th>Asignar</th>
      </tr>
    </thead>
    <tbody>
     
      <th scope="row">Pepitooo</th>
        <td>80 tiraderas</td>
        <td>20 sigaderas</td>
        <td>singando</td>
       <td>
          <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                  El propio
            </label>
         </div>      
       </td>
   
    </tbody>
    <tbody>
     
      <th scope="row">Juancito</th>
        <td>80 tiraderas</td>
        <td>20 sigaderas</td>
        <td>singando</td>
       <td>
          <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                  El propio
            </label>
         </div>      
       </td>
   
    </tbody>
  </table>
  </div>
    </div>
  </div>
  </div>


  <div class="item">
    <div id="exampleAccordion2" class="collapse" role="tabpanel">
      <div class="card card-body">
    
        <div class="table-responsive"> 
           <table class="table table-hover text-center">
               <thead class="thead-light">
                    <tr>
                     <th>Copilotos</th>
                     <th>Horas_Parciales</th>
                     <th>Horas_Percibidas</th>
                     <th>Estatus</th>
                     <th>Asignar</th>
                   </tr>
               </thead>
               <tbody>
     
      <th scope="row">Pepitooo</th>
        <td>80 tiraderas</td>
        <td>20 sigaderas</td>
        <td>singando</td>
        <td>
          <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                 mariguanero
            </label>
         </div>      
       </td>
              
                       </tbody>
                       <tbody>
     
      <th scope="row">Juancito</th>
        <td>80 tiraderas</td>
        <td>20 sigaderas</td>
        <td>singando</td>
       <td>
          <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                  El propio
            </label>
         </div>      
       </td>
              
                       </tbody>
           </table>
        </div>
      </div>
     </div>
  </div>
  
 <div class="item">
   <div id="exampleAccordion3" class="collapse" role="tabpanel">
  <div class="card card-body">
    
     <div class="table-responsive"> 
  <table class="table table-hover text-center">
    <thead class="thead-light">
      <tr>
        <th>Jefe_de_Cabina</th>
        <th>Horas_Parciales</th>
        <th>Horas_Percibidas</th>
        <th>Estatus</th>
        <th>Asignar</th>
      </tr>
    </thead>
    <tbody>
     
      <th scope="row">Pepitooo</th>
        <td>80 tiraderas</td>
        <td>20 sigaderas</td>
        <td>singando</td>
        <td>
          <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                 mariguanero
            </label>
         </div>      
       </td>
   
    </tbody>
    <tbody>
     
      <th scope="row">Juancito</th>
        <td>80 tiraderas</td>
        <td>20 sigaderas</td>
        <td>singando</td>
       <td>
          <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                  El propio
            </label>
         </div>      
       </td>
   
    </tbody>
  </table>
  </div>
  </div>
</div>
  </div>


 <div class="item">
   
    <div id="exampleAccordion4" class="collapse" role="tabpanel">
     
     <div class="card card-body">
    
     <div class="table-responsive"> 
  <table class="table table-hover text-center">
    <thead class="thead-light">
      <tr>
        <th>Aeromosas</th>
        <th>Horas_Parciales</th>
        <th>Horas_Percibidas</th>
        <th>Estatus</th>
        <th>Asignar</th>
      </tr>
    </thead>
    <tbody>
     
      <th scope="row">Pepitaaaa</th>
        <td>80 tiraderas</td>
        <td>20 sigaderas</td>
        <td>singando</td>
        <td>
         <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> 1
              </label>
        </div>
        <div class="form-check form-check-inline">
             <label class="form-check-label">
                 <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> 2
            </label>
        </div> 
        <div class="form-check form-check-inline">
             <label class="form-check-label">
                 <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> 3
              </label>
        </div>    
       </td>
   
    </tbody>
    <tbody>
     
      <th scope="row">Juancita</th>
        <td>80 tiraderas</td>
        <td>20 sigaderas</td>
        <td>singando</td>
          <td>
         <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> 1
              </label>
          </div>
          <div class="form-check form-check-inline">
             <label class="form-check-label">
                 <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> 2
            </label>
          </div> 
          <div class="form-check form-check-inline">
             <label class="form-check-label">
                 <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> 3
              </label>
          </div>    
       </td>
   
    </tbody>
  </table>



  </div>
  </div>






</div>



      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>








    </div>
  </div>
</div>





</div>
</div>
</div>