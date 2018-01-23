 <div class="card mb-3">
     <div class="card-body ">
<h4 class="card-title text-center">Nómina de {{ ucwords($mes) }}</h4>
<hr>

<div id="AccordionNomina" data-children=".item" style="font-weight: 600;">
<div id="conteneirItem">
<a data-toggle="collapse" data-parent="#AccordionNomina" href="#AccordionNomina1" aria-expanded="false" aria-controls="AccordionNomina2" class="btn btn2 btn-primary">
  Nómina
</a>
<a data-toggle="collapse" data-parent="#AccordionNomina" href="#AccordionNomina2" aria-expanded="true" aria-controls="AccordionNomina2" class="btn btn2 btn-primary">Vacaciones</a>
<a data-toggle="collapse" data-parent="#AccordionNomina" href="#AccordionNomina3" aria-expanded="true" aria-controls="AccordionNomina3" class="btn btn2 btn-primary">Utilidades</a></div>
<div class="item">
    <div id="AccordionNomina1" class="collapse show" role="tabpanel">

         <div class="table-responsive card divtablaAux">
            <table class="table table-bordered table-hover text-center tablaAux" >
              <tr class="bg-white " >
               <th class="border  border-primary border-left-0">
               Sucursal           
                </th>
              <th class="border  border-primary">Cédula</th>
               <th class="border  border-primary ">Empleado</th>
               <th class="border  border-primary ">Cargos</th>
               <th class="border  border-primary">Sueldo</th>
               <th class="border  border-primary">Compensación</th>
               <th class="border  border-primary">Antig&uuml;edad</th>
               <th class="border  border-primary">Deducción</th>
              

              </tr>
              @foreach($vouches as $vouche)
                @if(is_null($vouche->empleado))
                    <tr>
                      @if(is_null($vouche->personal->empleado))
                        <td>Central</td>
                      @else
                        <td>{{ $vouche->personal->empleado->sucursal->nombre }}</td>
                      @endif
                      <td>{{ $vouche->personal->cedula }}</td>
                      <td>{{ $vouche->personal->apellidos." ".$vouche->personal->nombre }}</td>
                      @if(is_null($vouche->personal->empleado))
                        <td>{{ $vouche->personal->tripulante->rango }}</td>
                      @else
                        <td>{{ $vouche->personal->empleado->cargo }}</td>
                      @endif
                        <td>{{ $vouche->sueldo_base }} Bs.</td>
                        <td>{{ $vouche->compensacion }} Bs.</td>
                        <td>{{ $vouche->antiguedad }} Bs.</td>
                        <td>{{ $vouche->deduccion }} Bs.</td> 
                                    
                    </tr> 
                @else
                  @php 
                    $personal=$vouche->empleado->datosPersonal();
                  @endphp
                  <tr>
                       @if(is_null($vouche->empleado->sucursal))
                        <td>Central</td>
                      @else
                        <td>{{ $vouche->empleado->sucursal->nombre }}</td>
                      @endif
                      <td>{{ $vouche->empleado->sucursal->nombre }}</td>
                      <td>{{ $personal->cedula }}</td>
                      
                      <td>{{ $personal->apellidos." ".$personal->nombre }}</td>
                      <td>{{ $vouche->sueldo_base }} Bs.</td>
                        <td>{{ $vouche->compensacion }} Bs.</td>
                        <td>{{ $vouche->antiguedad }} Bs.</td>
                        <td>{{ $vouche->deduccion }} Bs.</td>     
                                    
                    </tr> 

                @endif

              @endforeach            
            </table>
          </div>

          
              <div class="form-row align-items-center">
                  <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputApellido"> Total Compensación:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $nomina->monto_compensacion }}">
                  </div>
              </div>
              <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputApellido"> Total Antiguedad:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $nomina->monto_antiguedad }}">
                  </div>
              </div>
              <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputApellido"> Total Deducciones:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value=" {{ $nomina->monto_deducciones }}">
                  </div>
              </div>
                  <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputApellido"> Total a pagar:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ ($nomina->monto_sueldos+$nomina->monto_antiguedad+$nomina->monto_compensación)-$nomina->monto_deducciones }}">
                  </div>
              </div>
            </div>

</div></div>
<div class="item">
    <div id="AccordionNomina2" class="collapse" role="tabpanel">
        <div class="table-responsive card">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border  border-primary border-left-0">
               Sucursal           
                </th>
              <th class="border  border-primary">Cédula</th>
               <th class="border  border-primary ">Nombre Apellido</th>
               <th class="border  border-primary ">Cargos</th>
               <th class="border  border-primary">Vacacion</th>
              

              </tr>
              <tr>
                <td>Maiquetía</td>
                <td>21/10/2017</td>
                <td>12</td>
                <td>2000</td>
                <td>$$$$</td>       
                              
              </tr>              
            </table>
          </div>
          <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputApellido"> Total a pagar:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ ($nomina->monto_sueldos+$nomina->monto_antiguedad+$nomina->monto_compensación)-$nomina->monto_deducciones }}">
                  </div>
              </div>
              <div class="col-auto">
                 <button type="button" class="btn btn-outline-primary">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                 Imprimir</button> 

              </div>
</div></div>
<div class="item">
    <div id="AccordionNomina3" class="collapse" role="tabpanel">
          <div class="table-responsive card">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border  border-primary border-left-0">
               Sucursal           
                </th>
              <th class="border  border-primary">Cédula</th>
               <th class="border  border-primary ">Nombre Apellido</th>
               <th class="border  border-primary ">Cargos</th>
               <th class="border  border-primary">Utilidades</th>
              

              </tr>
              <tr>
                <td>Maiquetía</td>
                <td>21/10/2017</td>
                <td>12</td>
                <td>2000</td>
                <td>$$$$</td>       
                              
              </tr>              
            </table>
          </div>
          <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputApellido"> Total a pagar:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ ($nomina->monto_sueldos+$nomina->monto_antiguedad+$nomina->monto_compensación)-$nomina->monto_deducciones }}">
                  </div>
              </div>
              <div class="col-auto">
                 <button type="button" class="btn btn-outline-primary">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                 Imprimir</button> 

              </div>
</div></div>
</div>
         <div style="display: none;"> <div class="form-row  col-md-auto col-sm-7 col-6">
               <div class="form-row">    
        <div class="form-group col-md-2">
          <label class="custom-control custom-radio">Todos
              <input type="radio" class="custom-control-input" id="actualNomina" name="nomina" value="1"><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-md-2">
          <label class="custom-control custom-radio">Sucursal
              <input type="radio" class="custom-control-input" id="otraNomina" name="nomina" value="2"  ><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-md-2">
          <label class="custom-control custom-radio">Cargo
              <input type="radio" class="custom-control-input" id="otraNomina" name="nomina" value="2"  ><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-md-2">
          <label class="custom-control custom-radio">Vacaciones
              <input type="radio" class="custom-control-input" id="otraNomina" name="nomina" value="2"  ><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-auto" style="margin-top: 3px">
                    <label for="inputApellido">Seleciona: </label>
                  <div class="input-group">
                   <div class="input-group-btn">
                  <button type="button" class="btn btn-secondary dropdown-toggle"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sucursal
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#!">Sucre</a>
                     <a class="dropdown-item" href="#!">Anzuategui</a>
                    <a class="dropdown-item" href="#!">Caracas</a>
                  </div>
                </div>
               <input type="text" class="form-control" aria-label="Text input with dropdown button">
              </div> 
              </div>
          <div class="form-group col-auto" style="margin-top: 3px;">
                    <label for="inputApellido">Seleciona: </label>
                <div class="input-group">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-secondary dropdown-toggle"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Cargos </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#!">Subgerente de Sucursal</a>
                     <a class="dropdown-item" href="#!">Piloto</a>
                    <a class="dropdown-item" href="#!">Supervisor de Tráfico</a>
                  </div>
                  </div>
                   <input type="text" class="form-control" aria-label="Text input with dropdown button">                  
                </div>                    
              </div>
        </div></div></div>

          
      </div>
 </div> 

 <script type="text/javascript">
  $(document).ready(function(){
  var altura = $(document).height();
  altura=altura-380;
  altura=altura+"px";
  $(".divtablaAux").css("min-height",altura);
</script>