<div class="subtituloM" style="margin-bottom: 20px;">   
  <h4>ASIGNACIÓN DE PERSONAL Y AERONAVE</h4></div>
<hr>      
<div id="AccordionProg" data-children=".item">
   
    <a class="btn btn-primary" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg1" aria-expanded="true" aria-controls="AccordionProg1">
      Selecion de piloto
    </a>
 

    <a class="btn btn-primary" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg2" aria-expanded="false" aria-controls="AccordionProg2">
      Seleccion de Copiloto
    </a>

    <a class="btn btn-primary" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg3" aria-expanded="false" aria-controls="AccordionProg3">
      Seleccion de Jefe de Cabina
    </a>
 
    <a class="btn btn-primary" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg4" aria-expanded="false" aria-controls="AccordionProg4">
      Seleccion de aeromosas
    </a>



  <div class="item">
   
    <div id="AccordionProg1" class="collapse show" role="tabpanel">
     <div class="card card-body">
    
     <div class="table-responsive divtablaAux"> 
  <table class="table table-hover text-center tablaAux">
    <thead class="thead-light">
      <tr>
        <th>Pilotos</th>
        <th>Horas_Parciales</th>
        <th>Horas_Percibidas</th>
        <th>Asignar</th>
      </tr>
    </thead>
     @foreach($pilotos as $piloto)

    <tbody>
      <th scope="row">{{ $piloto->nombres." ".$piloto->apellidos }}</th>
        <td>82:10:00</td>
        <td>02:10:00</td>
       <td>
          <label class="custom-control custom-radio">
              <input id="radio1" type="radio" class="custom-control-input" name="piloto" value="{{ $piloto->id }}">
              <span class="custom-control-indicator"></span>
            </label>    
       </td>
    </tbody>
    @endforeach
  </table>
  </div>
    </div>
  </div>
  </div>


  <div class="item">
    <div id="AccordionProg2" class="collapse" role="tabpanel">
      <div class="card card-body">
    
        <div class="table-responsive divtablaAux"> 
           <table class="table table-hover text-center tablaAux">
               <thead class="thead-light">
                    <tr>
                     <th>Copilotos</th>
                     <th>Horas_Parciales</th>
                     <th>Horas_Percibidas</th>
                     <th>Asignar</th>
                   </tr>
               </thead>
     @foreach($copilotos as $copiloto)
      <tbody>
      <th scope="row">{{ $copiloto->nombres." ".$copiloto->apellidos }}</th>
        <td>12:10:00</td>
        <td>01:50:00</td>
       <td>
            <label class="custom-control custom-radio">
                <input id="radio1" type="radio" class="custom-control-input" name="copiloto" value="{{ $copiloto->id }}">
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">1</span>
              </label>      
       </td>
       </tbody> 
       @endforeach
           </table>
        </div>
      </div>
     </div>
  </div>
  
 <div class="item">
   <div id="AccordionProg3" class="collapse" role="tabpanel">
  <div class="card card-body">
    
    <div class="table-responsive divtablaAux"> 
  <table class="table table-hover text-center tablaAux">
    <thead class="thead-light">
      <tr>
        <th>Jefa de Cabina</th>
        <th>Horas_Parciales</th>
        <th>Horas_Percibidas</th>
        <th>Asignar</th>
      </tr>
    </thead>
      @foreach($jefacs as $jefac)
      <tbody>
      <th scope="row">{{ $jefac->nombres." ".$jefac->apellidos }}</th>
        <td>12:10:00</td>
        <td>01:50:00</td>
       <td>
      <label class="custom-control custom-radio">
          <input id="radio1" type="radio" class="custom-control-input" name="jefac" value="{{ $jefac->id }}">
          <span class="custom-control-indicator"></span>
        </label>
         </div>      
       </td>
       </tbody> 
       @endforeach
  </table>
  </div>
  </div>
</div>
  </div>


 <div class="item">
   
    <div id="AccordionProg4" class="collapse" role="tabpanel">
     
     <div class="card card-body">
    
      <div class="table-responsive divtablaAux"> 
  <table class="table table-hover text-center tablaAux">
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
            <label class="custom-control custom-radio">
            <input id="radio1" name="radio" type="radio" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">1</span>
          </label>
          <label class="custom-control custom-radio">
            <input id="radio2" name="radio" type="radio" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">2</span>
          </label>
          <label class="custom-control custom-radio">
            <input id="radio2" name="radio" type="radio" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">3</span>
          </label>
       </td>
   
    </tbody>
    <tbody>
     
      <th scope="row">Juancita</th>
        <td>80 tiraderas</td>
        <td>20 sigaderas</td>
        <td>singando</td>
          <td>
              <label class="custom-control custom-radio">
            <input id="radio1" name="radio" type="radio" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">1</span>
          </label>
          <label class="custom-control custom-radio">
            <input id="radio2" name="radio" type="radio" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">2</span>
          </label>
          <label class="custom-control custom-radio">
            <input id="radio2" name="radio" type="radio" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">3</span>
          </label>
       </td>  
       </td>
   
    </tbody>
  </table>



  </div>
  </div>



</div>


</div>

</div>

      <div class="modal-footer">
        <button type="button" class="btn btn2 btn-primary">Guardar</button>
        <button type="button" class="btn btn2 btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>