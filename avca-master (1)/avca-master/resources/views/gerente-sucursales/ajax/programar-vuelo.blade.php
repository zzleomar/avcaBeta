<div class="subtituloM" style="margin-bottom: 20px;">   
  <h4>ASIGNACIÓN DE PERSONAL Y AERONAVE</h4></div>
<hr>      
<div id="AccordionProg" data-children=".item">
   

    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg1" aria-expanded="true" aria-controls="AccordionProg1">
      Seleción de Piloto
    </a>
 

    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg2" aria-expanded="false" aria-controls="AccordionProg2">
      Selección de Copiloto
    </a>

    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg3" aria-expanded="false" aria-controls="AccordionProg3">
      Selección de Jefe de Cabina
    </a>
 
    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg4" aria-expanded="false" aria-controls="AccordionProg4">
      Selección de Sobrecargos
    </a>

    <a class="btn btn-primary btn-collAc" data-toggle="collapse" data-parent="#AccordionProg" href="#AccordionProg5" aria-expanded="true" aria-controls="AccordionProg5">
      Seleción de Aeronave
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
              <input id="piloto{{ $piloto->id }}" type="radio" class="custom-control-input pilotoRadio" name="piloto" value="{{ $piloto->id }}">
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
                <input id="copiloto{{ $copiloto->id }}"  type="radio" class="custom-control-input" name="copiloto" value="{{ $copiloto->id }}">
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
          <input id="jefac{{ $jefac->id }}"  type="radio" class="custom-control-input" name="jefac" value="{{ $jefac->id }}">
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
   
    <div id="AccordionProg4" class="collapse" role="tabpanel">
     
     <div class="card card-body">
    
      <div class="table-responsive divtablaAux"> 
  <table class="table table-hover text-center tablaAux">
    <thead class="thead-light">
      <tr>
        <th>Sobrecargos</th>
        <th>Horas_Parciales</th>
        <th>Horas_Percibidas</th>
        <th>Asignar</th>
      </tr>
    </thead>
    @foreach($sobrecargos as $sobrecargo)
    <tbody>
     
      <th scope="row">{{ $sobrecargo->nombres." ".$sobrecargo->apellidos }}</th>
        <td>13:10:00</td>
        <td>02:20:00</td>
        <td>
          <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="t{{ $sobrecargo->id }}" name="sobrecargos[]" onclick="doIt(this)" value="{{ $sobrecargo->id }}">
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
   
    <div id="AccordionProg5" class="collapse" role="tabpanel">
     <div class="card card-body">
    
     <div class="table-responsive divtablaAux"> 
  <table class="table table-hover text-center tablaAux">
    <thead class="thead-light">
      <tr>
        <th>Aeronave</th>
        <th>Modelo</th>
        <th>Horas_Parciales</th>
        <th>Horas_Percibidas</th>
        <th>Asignar</th>
      </tr>
    </thead>
     @foreach($aeronaves as $aeronave)

    <tbody>
      <th>{{ $aeronave->matricula }}</th>
      <th>{{ $aeronave->modelo }}</th>
        <td>82:10:00</td>
        <td>02:10:00</td>
       <td>
          <label class="custom-control custom-radio">
              <input id="aeronave{{ $aeronave->id }}" type="radio" class="custom-control-input" name="aeronave" value="{{ $aeronave->id }}">
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
</div>