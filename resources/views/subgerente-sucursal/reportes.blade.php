@extends('layouts.app')

@section('content')
@section('styles')
{!! Charts::assets() !!}
@endsection
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

<a data-toggle="collapse" data-parent="#AccordionReport" href="#AccordionReport2" aria-expanded="true" aria-controls="AccordionReport2"><button type="button" class="btn btn2 btn-success" data-toggle="modal" data-target="#NuevaRutaModal" style="margin: 10px;  float: right;">
  Reporte de Ingresos
</button></a>
<a data-toggle="collapse" data-parent="#AccordionReport" href="#AccordionReport1" aria-expanded="false" aria-controls="AccordionReport1"><button type="button" class="btn btn2 btn-success" data-toggle="modal" data-target="#NuevaRutaModal" style="margin: 10px;  float: right;">
  Reporte de Vuelos Abiertos
</button></a>
  <hr style="clear: both;">
<div class="item">
    <div id="AccordionReport1" class="collapse" role="tabpanel">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>REPORTE DE VUELOS ABIERTOS</th>
        </tr>
      </thead>
    </table>
    <div class="table-responsive divtablaAux">
            <table class="table table-bordered table-hover text-center tablaAux" >
              <tr class="bg-white " >
               <th class="border  border-primary border-left-0">
               Destino           
                </th>
              <th class="border  border-primary">Fecha</th>
               <th class="border  border-primary ">hora</th>
               <th class="border  border-primary">Boletos vendidos</th>
               <th class="border  border-primary">Boletos Reservados</th>
              <th class="border  border-primary border-right-0 border-left-0">Ingresos</th>
              

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
                <td>{{ number_format((($data["vuelo"]->pierna->ruta->tarifa_vuelo)*$data['pagado']),2,',','.') }}</td> 
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
                    <label for="inputPuesto"> Total de Vuelos Abiertos: </label>
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
                    <label for="inputApellido">Ingresos de Vuelos Abiertos</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-money" aria-hidden="true"></i> </div>
                    <input type="text" readonly="" class="form-control-plaintext p-1 border  border-info border-top-0 border-left-0" id="staticEmail2" value="{{ number_format($ingresos,2,',','.') }}">
                  </div>
              </div>
          </div>
</div>
</div>
<div class="item">
  <div id="AccordionReport2" class="collapse show" role="tabpanel">
    <table class="table">
      <thead class="thead-light">
        <tr align="center">
          <th>MODALIDADES DE REPORTES</th>
        </tr>
      </thead>
    </table>
      <form method="get" action="{{ URL::to('/reportes/ingresos/ajax') }}" id="formReporte">
    <div class="form-row">  
      @if((!isset($tipo)||($tipo==1))) 
          <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
          <label class="custom-control custom-radio">Este Mes
            @php
              $url=URL::to('/reportes/ingresos/ajax')."/1";
            @endphp
              <input type="radio" class="custom-control-input" id="hoy" name="reporte" value="1" checked onclick="ajaxReporte('{{ $url }}')"><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
          <label class="custom-control custom-radio">Semana Pasada
            @php
              $url=URL::to('/reportes/ingresos/ajax')."/2";
            @endphp
              <input type="radio" class="custom-control-input" id="Semana-Pasada" name="reporte" value="2" onclick="ajaxReporte('{{ $url }}')"><span class="custom-control-indicator"></span>
          </label>
        </div>
        <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
          <label class="custom-control custom-radio">Mes Pasado
            @php
              $url=URL::to('/reportes/ingresos/ajax')."/3";
            @endphp
              <input type="radio" class="custom-control-input" id="mes-Pasada" name="reporte" value="3" onclick="ajaxReporte('{{ $url }}')"><span class="custom-control-indicator"></span></label>
        </div>
      @else
        <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
          <label class="custom-control custom-radio">Este Mes
            @php
              $url=URL::to('/reportes/ingresos/ajax')."/1";
            @endphp
              <input type="radio" class="custom-control-input" id="hoy" name="reporte" value="1" onclick="ajaxReporte('{{ $url }}')"><span class="custom-control-indicator"></span>
          </label>
        </div>
          @if($tipo==2)
              <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
              <label class="custom-control custom-radio">Semana Pasada
                @php
                  $url=URL::to('/reportes/ingresos/ajax')."/2";
                @endphp
                  <input type="radio" class="custom-control-input" id="Semana-Pasada" name="reporte" value="2" onclick="ajaxReporte('{{ $url }}')" checked><span class="custom-control-indicator"></span>
              </label>
            </div>
            <div class="form-group col-md-2">
              <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
              <label class="custom-control custom-radio">Mes Pasado
                @php
                  $url=URL::to('/reportes/ingresos/ajax')."/3";
                @endphp
                  <input type="radio" class="custom-control-input" id="mes-Pasada" name="reporte" value="3" onclick="ajaxReporte('{{ $url }}')"><span class="custom-control-indicator"></span></label>
            </div>
          @else
            <div class="form-group col-md-2">
            <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
                <label class="custom-control custom-radio">Semana Pasada
                  @php
                    $url=URL::to('/reportes/ingresos/ajax')."/2";
                  @endphp
                    <input type="radio" class="custom-control-input" id="Semana-Pasada" name="reporte" value="2" onclick="ajaxReporte('{{ $url }}')" ><span class="custom-control-indicator"></span>
                </label>
              </div>
            @if($tipo==3)
                <div class="form-group col-md-2">
              <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
              <label class="custom-control custom-radio">Mes Pasado
                @php
                  $url=URL::to('/reportes/ingresos/ajax')."/3";
                @endphp
                  <input type="radio" class="custom-control-input" id="mes-Pasada" name="reporte" value="3" onclick="ajaxReporte('{{ $url }}')" checked><span class="custom-control-indicator"></span></label>
            </div>
            @endif
          @endif
      @endif

        

       <!-- <div class="form-group col-md-2">
          <!-- HOY ESTA SEMAN MES PASADO PERIODO A CONSULTAR-->
        <!--  <label class="custom-control custom-radio">Periodo
              <input type="radio" class="custom-control-input" id="periodo" name="reporte" value="periodo"><span class="custom-control-indicator"></span></label>
        </div> -->
      </div>
        </form>

      <div class="col-12" id="graficaReporte">
        @php
          use Carbon\Carbon;
          $actual=Carbon::now();
          $inicio=Carbon::parse($actual->year."-".$actual->month."-01");
          setlocale(LC_TIME, "es");
          $mes1=$inicio->formatLocalized('%B');
        @endphp
      <h2>{{ $titulo }}</h2> 
        {!! $chartjs->render() !!}
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
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
  var altura = $(document).height();
  altura=altura-380;
  altura=altura+"px";
  $(".divtablaAux").css("min-height",altura);

});

 function ajaxReporte(action){
  
    document.getElementById('formReporte').action = action;
    document.getElementById('formReporte').submit();
    var targetL = $('#targetL');
    targetL.loadingOverlay();
    var url="{{ URL::to('/reportes/ingresos/ajax') }}/"+tipo;
   // alert(url);
      $.get(url,function(data){ 
        $('#graficaReporte').empty().html(data);
        targetL.loadingOverlay('remove');
      }); 
    
  }
  function ajaxReporte1(tipo){
    switch (tipo) {
      case '1':
        $('#AccordionReportH').collapse('show');
        $('#AccordionReportS').collapse('hide');
        $('#AccordionReportMP').collapse('hide');
        break;
      case '2':
        $('#AccordionReportH').collapse('hide');
        $('#AccordionReportS').collapse('show');
        $('#AccordionReportMP').collapse('hide');
        break;
      case '3':
        $('#AccordionReportH').collapse('hide');
        $('#AccordionReportS').collapse('hide');
        $('#AccordionReportMP').collapse('show');
        break;
    }
  }
</script>
@endsection
