
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
          <button type="button" class="btn btn2 btn-outline-success" data-toggle="modal" data-target="#ProgramarVuelo">Nuevo Vuelo</button>
       </div>



        <div class="item">
         
          <div id="VuelosRetrasados" class="collapse" role="tabpanel">
           <div class="row">
                <div class="col-md-12 col-sm-12">
      @if((sizeof($retrasados))==0)<br>
                      <h5>No existen vuelos Retrasados para esta ruta</h5>
                    @else 
               <div class=" container card">  
                  <div class="table-responsive divtablaAux">  
                    <table class="table table-hover text-center tablaAux">
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

                         <?php 
                            $retrasados->each(function($retrasados){

                     ?>

                      <tbody>
                       
                        <th scope="row">{{ $retrasados->id }}</th>
                           <!-- <td>{{ $retrasados->pierna->ruta->origen->nombre."--".$retrasados->pierna->ruta->destino->nombre }}
                          </td> -->
                          <td>{{ $retrasados->pierna->ruta->siglas }}
                          </td>
                          <td>{{ DATE('d/m/Y',strtotime($retrasados->salida)) }}</td>
                          <td>{{ DATE('H:i:s',strtotime($retrasados->salida)) }}</td>
                          <td>{{ $retrasados->estado }}</td>
                         <td>
                          <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $retrasados->id }}','{{ $retrasados->pierna->ruta->siglas }}','{{ $retrasados->pierna->ruta->origen->nombre }}','{{ $retrasados->pierna->ruta->destino->nombre }}')">Ver</button>
                      </td>
                     
                      </tbody>
                     <?php }); ?>
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
       @if((sizeof($abiertos))==0)<br>
                      <h5>No existen vuelos abiertos para esta ruta</h5>
                    @else     
               <div class=" container card"> 
                  <div class="table-responsive divtablaAux">  
                    <table class="table table-hover text-center tablaAux">
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

                        <?php 
                            $abiertos->each(function($abiertos){

                     ?>
                      <tbody>
                       
                        <th scope="row">{{ $abiertos->id }}</th>

                          <!-- <td>{{ $abiertos->pierna->ruta->origen->nombre."--".$abiertos->pierna->ruta->destino->nombre }}
                          </td> -->
                          <td>{{ $abiertos->pierna->ruta->siglas }}
                          </td>
                          <td>{{ DATE('d/m/Y',strtotime($abiertos->salida)) }}</td>
                          <td>{{ DATE('H:i:s',strtotime($abiertos->salida)) }}</td>
                          <td>{{ $abiertos->estado }}</td>
                         <td>
                          <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#ModalCancelarVuelo" onclick="cancelar('{{ $abiertos->id  }}')">Cancelar</button>
                          <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $abiertos->id }}','{{ $abiertos->pierna->ruta->siglas }}','{{ $abiertos->pierna->ruta->origen->nombre }}','{{ $abiertos->pierna->ruta->destino->nombre }}')">Ver</button>
                      </td>
                     
                      </tbody>
                     <?php }); ?>
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
      @if((sizeof($cancelados))==0)<br>
                      <h5>No existen vuelos cancelados para esta ruta</h5>
                    @else  
               <div class=" container card">
                  <div class="table-responsive divtablaAux">  
                    <table class="table table-hover text-center tablaAux">
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
                       <?php 
                            $cancelados->each(function($cancelados){

                     ?>

                      <tbody>
                       
                        <th scope="row">{{ $cancelados->id }}</th>

                          <!-- <td>{{ $cancelados->pierna->ruta->origen->nombre."--".$cancelados->pierna->ruta->destino->nombre }}
                          </td> -->
                          <td>{{ $cancelados->pierna->ruta->siglas }}
                          <td>{{ DATE('d/m/Y',strtotime($cancelados->salida)) }}</td>
                          <td>{{ DATE('H:i:s',strtotime($cancelados->salida)) }}</td>
                          <td>{{ $cancelados->estado }}</td>
                         <td>
                          <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $cancelados->id }}','{{ $cancelados->pierna->ruta->siglas }}','{{ $cancelados->pierna->ruta->origen->nombre }}','{{ $cancelados->pierna->ruta->destino->nombre }}')">Ver</button>
                      </td>
                     
                      </tbody>
                      <?php }); ?>
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
      @if((sizeof($ejecutados))==0)<br>
                      <h5>No existen vuelos Ejecutados para esta ruta</h5>
                    @else  
               <div class=" container card">
                  <div class="table-responsive divtablaAux">  
                    <table class="table table-hover text-center tablaAux">
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
                       <?php 
                            $ejecutados->each(function($ejecutados){

                     ?>

                      <tbody>
                       
                        <th scope="row">{{ $ejecutados->id }}</th>
                          <!-- <td>{{ $ejecutados->pierna->ruta->origen->nombre."--".$ejecutados->pierna->ruta->destino->nombre }}
                          </td> -->
                          <td>{{ $ejecutados->pierna->ruta->siglas }}
                          <td>{{ DATE('d/m/Y',strtotime($ejecutados->salida)) }}</td>
                          <td>{{ DATE('H:i:s',strtotime($ejecutados->salida)) }}</td>
                          <td>{{ $ejecutados->estado }}</td>
                         <td>
                            <button type="button" class="btn btn2 btn-primary" data-toggle="modal" data-target="#VerVuelo" onclick="detallesVuelo('{{ $ejecutados->id }}','{{ $ejecutados->pierna->ruta->siglas }}','{{ $ejecutados->pierna->ruta->origen->nombre }}','{{ $ejecutados->pierna->ruta->destino->nombre }}')">Ver</button>
                        </td>
                     
                      </tbody>
                      <?php }); ?>
                    </table>
                    </div>    
              </div>
              @endif
      </div></div>
      </div>
        </div>

      </div>



 <h1 align="center">
  </h1>