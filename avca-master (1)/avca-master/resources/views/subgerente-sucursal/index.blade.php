@extends('layouts.app')

@section('content')
@include('notifications::flash')


    <div class="card-body">
    <h4 class="card-title centrarAux">Sucursal {{ $sucursal->nombre }}</h4>
    <h4>INFORMACIÓN DE VUELOS</h4>


    <div class="card text-center border-info mb-3 centrarAux" style="width: auto;">
     <div class="card-body ">

<div id="exampleAccordion" data-children=".item">
   <div class="opcionesAccordion">
    <a class="btn btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosRetrasados" aria-expanded="true" aria-controls="VuelosRetrasados">
      Vuelos Retrasados
    </a>
 

    <a class="btn btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosAbiertos" aria-expanded="false" aria-controls="VuelosAbiertos">
      Vuelos Abiertos
    </a>

    <a class="btn btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosCancelados" aria-expanded="false" aria-controls="VuelosCancelados">
      Vuelos Cancelados
    </a>
 </div>



  <div class="item">
   
    <div id="VuelosRetrasados" class="collapse show" role="tabpanel">
     <div class="row">
          <div class="col-md-12 col-sm-12">
@if((sizeof($vuelosR))==0)
                <h5>No existen vuelos Retrasados</h5>
              @else 
         <div class=" container card">  
              
            <div class="table-responsive">
         <table class="table text-center ">
            <thead class="thead-light">
              <tr>
                
                <th>Destino</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            
            <tbody>
              
                @foreach($vuelosR as $vuelo)
              
              <tr>
                <td>{{ $vuelo->nombre }}</td>
                <td>{{ $vuelo->salida }}</td>
                <td>Retrasado</td>
                
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalVuelo" onclick="detallesVuelo('{{ $vuelo->id }}')">
                      Ver
                    </button> 

                  </td>
              </tr>
          @endforeach
              
              
                </tbody>
          </table>
</div>
</div>
@endif

</div></div>
  </div>
  </div>


  <div class="item">
    <div id="VuelosAbiertos" class="collapse" role="tabpanel">
      <div class="row">
          <div class="col-md-12 col-sm-12">
 @if((sizeof($vuelosA))==0)
                <h5>No existen vuelos abiertos</h5>
              @else     
         <div class=" container card"> 
          
            <div class="table-responsive">
         <table class="table text-center ">
            <thead class="thead-light">
              <tr>
                
                <th>Destino</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            
            <tbody>
              
                @foreach($vuelosA as $vuelo)
              
              <tr>
                <td>{{ $vuelo->nombre }}</td>
                <td>{{ $vuelo->salida }}</td>
                <td>{{ $vuelo->estado }}</td>
                
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalVuelo" onclick="detallesVuelo('{{ $vuelo->id }}')">
                      Ver
                    </button> 

                  </td>
              </tr>
          @endforeach
              
              
                </tbody>
          </table>
</div>
</div>
@endif
</div></div>
     </div>
  </div>
  
 <div class="item">
   <div id="VuelosCancelados" class="collapse" role="tabpanel">
      <div class="row">
          <div class="col-md-12 col-sm-12">
@if((sizeof($vuelosC))==0)
                <h5>No existen vuelos cancelados</h5>
              @else  
         <div class=" container card">
            
            <div class="table-responsive">

         <table class="table text-center ">
            <thead class="thead-light">
              <tr>
                
                <th>Destino</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th></th>
              </tr>
            </thead>
            
            <tbody>
              
              
                @foreach($vuelosC as $vuelo)
              
              <tr>
                <td>{{ $vuelo->nombre }}</td>
                <td>{{ $vuelo->salida }}</td>
                <td>{{ $vuelo->estado }}</td>
                
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalVuelo" onclick="detallesVuelo('{{ $vuelo->id }}')">
                      Ver
                    </button> 

                  </td>
              </tr>
          @endforeach
              
              
                </tbody>
          </table>
        </div>
</div>
        @endif
</div></div>
</div>
  </div>
</div>

         
<!-- Modal -->

              
<div class="modal fade bd-example-modal-lg" id="myModalVuelo" data-keyboard="false" data-backdrop="static">
<form method="post" id="formOperativo">    
                        {{ csrf_field() }}
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
                      <div id="ajax-vuelo"></div>

                    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
</form>

               </div>




</div>
</div>

</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  function detallesVuelo(id){
      var url="{{ URL::to('/sucursal/vuelo/') }}/"+id; 
      //alert(url);
        $.get(url,function(data){ 
          $('#ajax-vuelo').empty().html(data);
        }); 
  }

</script>
@endsection