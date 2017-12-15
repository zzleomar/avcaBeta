
<input type="hidden" id="origen_id" name="origen_id" value="{{ $ruta['origen_id'] }}">
<input type="hidden" id="destino_id" name="destino_id" value="{{ $ruta['destino_id'] }}">
  <div id="exampleAccordion" data-children=".item">
   <div class="opcionesAccordion">
    <a class="btn btn2 btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosAbiertos" aria-expanded="true" aria-controls="VuelosAbiertos">
      Vuelos Abiertos
    </a>

    <a class="btn btn2 btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosRetrasados" aria-expanded="false" aria-controls="VuelosRetrasados">
      Vuelos Retrasados
    </a>
    

    <a class="btn btn2 btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosCancelados" aria-expanded="false" aria-controls="VuelosCancelados">
      Vuelos Cancelados
    </a>

    <a class="btn btn2 btn-primary" data-toggle="collapse" data-parent="#exampleAccordion" href="#VuelosEjecutados" aria-expanded="false" aria-controls="VuelosEjecutados">
      Vuelos Ejecutados
    </a>
 </div>



  <div class="item">
   
    <div id="VuelosRetrasados" class="collapse" role="tabpanel">
     <div class="row">
          <div class="col-md-12 col-sm-12">
@if((sizeof($retrasados))==0)
                <h5>No existen vuelos Retrasados</h5>
              @else 
         <div class=" container card">  
            <div class="table-responsive">  
              <table class="table table-hover text-center">
                <thead class="thead-light">
                  <tr>
                    <th>#Vuelo</th>
                    <th>Ruta</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estatus</th>
                    <th>Modificar</th>
                  </tr>
                </thead>
                  @foreach($retrasados as $vuelo)

                <tbody>
                 
                  <th scope="row">{{ $vuelo->id }}</th>
                    <td>{{ $ruta['ruta'] }}</td>
                    <td>{{ $vuelo->salida }}</td>
                    <td>{{ $vuelo->salida }}</td>
                    <td>{{ $vuelo->estado }}</td>
                   <td>
                    <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $vuelo->id }}')">Ver</button>
                </td>
               
                </tbody>
                @endforeach
              </table>
              </div>      
            
        </div>
@endif

</div></div>
  </div>
  </div>


  <div class="item">
    <div id="VuelosAbiertos" class="collapse show" role="tabpanel">
      <div class="row">
          <div class="col-md-12 col-sm-12">
 @if((sizeof($abiertos))==0)
                <h5>No existen vuelos abiertos para esta ruta</h5>
              @else     
         <div class=" container card"> 
            <div class="table-responsive">  
              <table class="table table-hover text-center">
                <thead class="thead-light">
                  <tr>
                    <th>#Vuelo</th>
                    <th>Ruta</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estatus</th>
                    <th>Modificar</th>
                  </tr>
                </thead>
                  @foreach($abiertos as $vuelo)

                <tbody>
                 
                  <th scope="row">{{ $vuelo->id }}</th>
                    <td>{{ $ruta['ruta'] }}</td>
                    <td>{{ $vuelo->salida }}</td>
                    <td>{{ $vuelo->salida }}</td>
                    <td>{{ $vuelo->estado }}</td>
                   <td>
                    <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#ModalCancelarVuelo" onclick="cancelar('{{ $vuelo->id  }}')">Cancelar</button>
                    <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $vuelo->id }}')">Ver</button>
                </td>
               
                </tbody>
                @endforeach
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
@if((sizeof($cancelados))==0)
                <h5>No existen vuelos cancelados para esta ruta</h5>
              @else  
         <div class=" container card">
            <div class="table-responsive">  
              <table class="table table-hover text-center">
                <thead class="thead-light">
                  <tr>
                    <th>#Vuelo</th>
                    <th>Ruta</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estatus</th>
                    <th>Modificar</th>
                  </tr>
                </thead>
                  @foreach($cancelados as $vuelo)

                <tbody>
                 
                  <th scope="row">{{ $vuelo->id }}</th>
                    <td>{{ $ruta['ruta'] }}</td>
                    <td>{{ $vuelo->salida }}</td>
                    <td>{{ $vuelo->salida }}</td>
                    <td>{{ $vuelo->estado }}</td>
                   <td>
                    <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $vuelo->id }}')">Ver</button>
                </td>
               
                </tbody>
                @endforeach
              </table>
              </div>    
        </div>
        @endif
</div></div>
</div>
  </div>
  <div class="item">
   <div id="VuelosEjecutados" class="collapse" role="tabpanel">
      <div class="row">
          <div class="col-md-12 col-sm-12">
@if((sizeof($ejecutados))==0)
                <h5>No existen vuelos Ejecutados para esta ruta</h5>
              @else  
         <div class=" container card">
            <div class="table-responsive">  
              <table class="table table-hover text-center">
                <thead class="thead-light">
                  <tr>
                    <th>#Vuelo</th>
                    <th>Ruta</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estatus</th>
                    <th>Modificar</th>
                  </tr>
                </thead>
                  @foreach($ejecutados as $vuelo)

                <tbody>
                 
                  <th scope="row">{{ $vuelo->id }}</th>
                    <td>{{ $ruta['ruta'] }}</td>
                    <td>{{ $vuelo->salida }}</td>
                    <td>{{ $vuelo->salida }}</td>
                    <td>{{ $vuelo->estado }}</td>
                   <td>
                      <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $vuelo->id }}')">Ver</button>
                  </td>
               
                </tbody>
                @endforeach
              </table>
              </div>    
        </div>
        @endif
</div></div>
</div>
  </div>

</div>
 <h1 align="center">
      <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#ProgramarVuelo">Nuevo Vuelo</button>
  </h1>