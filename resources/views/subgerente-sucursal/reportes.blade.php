@extends('layouts.app')

@section('content')
@include('notifications::flash')

<div id="targetL" class="py-3">
    @if(Auth::user()->tipo!='Gerente de RRHH')
      @php
          $personal=Auth::user()->DatosPersonal(Auth::user()->personal_id);
        $sucursal= $personal->empleado->sucursal;
      @endphp
      <h4 class="card-title" style="font-weight: 600;">Sucursal {{ $sucursal->nombre }}</h4>
    @endif
<div class="card text-center border-info mb-3 centrarAux" style="width: auto;">
     <div class="card-body ">
 
<div id="AccordionReport" data-children=".item" style="font-weight: 600;">

<a data-toggle="collapse" data-parent="#AccordionReport" href="#AccordionReport2" aria-expanded="false" aria-controls="AccordionReport2"><button type="button" class="btn btn2 btn-outline-success" data-toggle="modal" data-target="#NuevaRutaModal" style="margin: 10px;  float: right;">
  Filtros de Reportes
</button></a>
<a data-toggle="collapse" data-parent="#AccordionReport" href="#AccordionReport1" aria-expanded="true" aria-controls="AccordionReport1"><button type="button" class="btn btn2 btn-outline-success" data-toggle="modal" data-target="#NuevaRutaModal" style="margin: 10px;  float: right;">
  Reporte de Vuelos Abiertos
</button></a>
  <hr style="clear: both;">
<div class="item">
    <div id="AccordionReport1" class="collapse show" role="tabpanel">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>REPORTE DE VUELOS ABIERTOS</th>
        </tr>
      </thead>
    </table>
    <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" >
              <tr class="bg-white " >
               <th class="border  border-primary border-left-0">
               Destino           
                </th>
              <th class="border  border-primary">Fecha</th>
               <th class="border  border-primary ">hora</th>
               <th class="border  border-primary">Boletos vendidos</th>
               <th class="border  border-primary">Boletos Reservados</th>
              <th class="border  border-primary border-right-0 border-left-0">Ingreso</th>
              

              </tr>
              @php
              $vendidos=0;
              $reservados=0;
              $ingresos=0;
              @endphp
              @foreach($datos as $data)
              <tr>
                <td>{{ $data['vuelo']->pierna->ruta->destino->nombre }}</td>
                <td>{{  DATE('d/m/Y',strtotime($data['vuelo']->salida)) }}</td>
                <td>{{  DATE('H:i:s',strtotime($data['vuelo']->salida)) }}</td>
                <td>{{ $data['pagado'] }}</td>
                <td>{{ $data['reservado'] }}</td>
                <td>{{ ($data["vuelo"]->pierna->ruta->tarifa_vuelo)*$data['pagado'] }}</td> 
                @php
                  $vendidos=$vendidos+$data['pagado'];
                  $reservados=$reservados+$data['reservado'];
                  $ingresos=$ingresos+(($data["vuelo"]->pierna->ruta->tarifa_vuelo)*$data['pagado']);
              @endphp      
                              
              </tr> 
              @endforeach           
            </table>
          <br>

          </div>
                     
      <div class="form-row">
          <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputPuesto"> Total de Vuelos: </label>
                    <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-plane" aria-hidden="true"></i> </div>
                      <input type="text" readonly="" class="form-control-plaintext  p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ sizeof($datos) }}" >
                      </div>
              </div>
              
              <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputApellido"> Total de Boletos Reservados:</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-tag" aria-hidden="true"></i> </div> 
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $reservados }}">
                  </div> 
              </div>

              <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputApellido"> Total de Boletos Vendidos:</label>
                <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-tag" aria-hidden="true"></i> </div> 
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $vendidos }}">
                  </div> 
              </div>  

                <div class="form-group col-md-3" style="text-align: left;">
                    <label for="inputApellido"> Total de Ingresos</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ $ingresos }}">
                  </div>
              </div>
          </div>
</div>
</div>
<div class="item">
  <div id="AccordionReport2" class="collapse" role="tabpanel">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>MODALIDADES DE REPORTES</th>
        </tr>
      </thead>
    </table>
    <div class="form-row">   
        <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
          <label class="custom-control custom-radio">Hoy
              <input type="radio" class="custom-control-input" id="hoy" name="reporte" value="hoy"><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
          <label class="custom-control custom-radio">Semana Pasada
              <input type="radio" class="custom-control-input" id="Semana-Pasada" name="reporte" value="Semana-Pasada"><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
          <label class="custom-control custom-radio">Mes Pasado
              <input type="radio" class="custom-control-input" id="mes-Pasada" name="reporte" value="mes-Pasada"><span class="custom-control-indicator"></span></label>
        </div>
        <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
          <label class="custom-control custom-radio">Periodo
              <input type="radio" class="custom-control-input" id="periodo" name="reporte" value="periodo"><span class="custom-control-indicator"></span></label>
        </div>
        <div class="form-group col-md-2" style="margin-top: 3px;">
            <button type="button" class="btn btn-lg btn-success" >Mostrar</button>
        </div>
      </div>

  </div>
</div>


      
      </div>
  </div>   


    

          <!-- <div class="form-row">

            
          <div class="form-group col-md-4">
                    <label for="inputPuesto">Seleccione la Fecha Inicial</label>
                    <div class="text-center">
            <input type="date" placeholder="introduzca fecha" />
              </div>  
              </div>

          <div class="form-group col-md-4">
                    <label for="inputPuesto">Seleccione la Fecha Final</label>
                    <div class="text-center">
            <input type="date" placeholder="introduzca fecha" />
              </div>  
              </div>         
              

                 <div class="form-group col-md-4">
                    <label for="inputApellido">Seleciona la Sucursal:</label>
                  <div class="input-group mb-2 mb-sm-0 col-md-12">
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
                
              
          </div>-->

                 <!-- <div class="form align-items-center">          
                       
              <div class="col-auto">
                 <button type="button" class="btn btn-outline-primary">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                 Imprimir</button> 

            <button type="button" class="btn btn-outline-success">salir</button>
              </div>
            
          </div> -->
         
      


  </div>



</div>


@endsection
