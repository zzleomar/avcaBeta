<div id="AccordionInfoPersonal" data-children=".item" style="font-weight: 600;">
             INFORMACIÓN
             <br>
                  <a class="btn btn-primary btn-aux-magin" data-toggle="collapse" data-parent="#AccordionInfoPersonal" href="#AccordionInfoPersonal1" aria-expanded="true" aria-controls="AccordionInfoPersonal1" onclick="helpCollapse('1')">
                    Persona
                  </a>
               

                  <a class="btn btn-primary btn-aux-magin" data-toggle="collapse" data-parent="#AccordionInfoPersonal" href="#AccordionInfoPersonal2" aria-expanded="false" aria-controls="AccordionInfoPersonal2" onclick="helpCollapse('2')">
                    Profesional
                  </a>
                 <div class="item">
                    <div id="AccordionInfoPersonal1" class="collapse show" role="tabpanel">
                     <div class="card card-body">
                      <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="inputIdentificacion4">Identificación:</label>
                         <div class="input-group">  
                          <input type="text" class="form-control" placeholder="Identificación" name="cedula" id="cedula" onkeypress="return soloNumDec(event)" value="{{ $empleado->cedula }}">
                        </div>
                      </div> 
                      </div>
                      <div class="form-row">
                          <div class="form-group col-md-6">
                            <div class="input-group mb-2 mb-sm-0">
                            <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                              <input type="text" class="form-control" id="nombres" placeholder="Ingrese el nombre" name="nombres" value="{{ $empleado->nombres }}">
                                      <div id="Comentarios"></div></div>
                              </div>
                              <div class="form-group col-md-6">
                                  <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                                    <input type="text" class="form-control" id="apellidos" placeholder="Ingrese el Apellidos" name="apellidos" value="{{ $empleado->apellidos }}">
                                  </div>
                              </div>
                              
                          </div>


                        <div class="form-group">
                                <label for="inputAddress">Dirección</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion del empleado" value="{{ $empleado->direccion }}">
                          </div>


                        <div class="form-row">
                          
                            <div class="form-group col-md-6">
                                    <label for="inputNombre"> Telefono Movil</label>
                                <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon"> <i class="fa fa-mobile" aria-hidden="true"></i> </div>
                                      <input type="text" class="form-control" id="tlf_movil" placeholder="Ejemplo 0414 098 1234" name="tlf_movil" value="{{ $empleado->tlf_movil }}" >
                                      </div>
                              </div>                            
                            <div class="form-group col-md-6">
                                    <label for="inputNombre">Telefono Fijo</label>

                                    <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                                      <input type="text" class="form-control" id="tlf_casa" placeholder="Ejemplo 0293 098 1234" name="tlf_casa" value="{{ $empleado->tlf_casa }}">
                                    </div>
                              </div> 
                          </div>   
                      
                     </div>
                   </div>
                 </div>

                  <div class="item">
                    <div id="AccordionInfoPersonal2" class="collapse" role="tabpanel">
                     <div class="card card-body">
                      <div class="form-row">
                          
                            <div class="form-row col-md-6">
                                    <label class="infoTitulo">Fecha de entrada</label>
                                <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon"> <i class="fa fa-mobile" aria-hidden="true"></i> </div>
                                      <input type="date" placeholder="introduzca fecha mm/dd/yyyy" name="fechaEntrada" id="fechaEntrada" class="form-perso-help" value="{{ DATE('Y-m-d',strtotime($empleado->entrada)) }}"  />
                                      </div>
                              </div> 
                      <br>
                    <div class="col col-sm-12 col-md-12 btn-aux-magin">
                            <div class="input-group">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle" style="min-width: 8rem;" 
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown">Tipo
                              </button>
                              <div class="dropdown-menu ">
                                <a class="dropdown-item" id="tipoC1" onclick="tipoCargo('1','1')">Operativo</a>
                              @if(Auth::user()->tipo=='Gerente de RRHH')
                                <a class="dropdown-item" id="tipoC2" onclick="tipoCargo('2','1')">Tripulante</a>
                              @endif
                                <a class="dropdown-item" id="tipoC3" onclick="tipoCargo('3','1')">Administrativo</a>
                              </div>
                            </div>
                            @if(is_null($empleado->tripulante))
                                @if(is_null($empleado->empleado->personal_operativo))
                                     <select name="cargo1" class="opcTipo oculto form-control-lg" id="opcOperativo1"  onchange="cargoEleccion('1')">
                                        <option value="0">Seleccione un cargo</option>
                                        <option value="Operador de Tráfico" >Operador de Tráfico</option>
                                        <option value="Controlador de Tráfico" >Controlador de Tráfico</option>
                                        <option value="Supervisor de Mantenimiento">Supervisor de Mantenimiento</option>
                                        <option value="Mecánico">Mecánico</option>
                                      </select>
                                      <div class="oculto" id="opcTripulante1">
                                  <div class="form-row">
                                  <div class="col-md-6">
                                    <select name="cargo2" class="opcTipo form-control-lg" id="" onchange="cargoEleccion('1')">
                                          <option value="0">Seleccione un rango</option>
                                          <option value="Piloto">Piloto</option>
                                          <option value="Copiiloto">Copiloto</option>
                                          <option value="Jefe de Cabina">Jefe de Cabina</option>
                                          <option value="Sobrecargo">Sobrecargo</option>
                                        </select>
                                        </div>                            
                                      <div class="col-md-6">
                                              <div class="input-group mb-2 mb-sm-0">
                                              <div class="input-group-addon"> <i class="fa fa-plane" aria-hidden="true"></i> </div>
                                                <input type="text" class="form-control" id="licencia" placeholder="Ingrese la licencia" name="licencia" >
                                              </div>
                                        </div> 
                                    </div>  
                                      </div>
                                      <select name="cargo3" class="opcTipo form-control-lg" id="opcAdministrativo1" onchange="cargoEleccion('1')">
                                        <option value="{{ $empleado->empleado->cargo }}">{{ $empleado->empleado->cargo }}</option>
                                        <option value="Obrero">Obrero</option>
                                        <option value="Beder">Beder</option>
                                        <option value="Asistente de RRHH">Asistente de RRHH</option>
                                        <option value="SubGerente de Sucursal">SubGerente de Sucursal</option>
                                        <option value="Gerente de RRHH">Gerente de RRHH</option>
                                        <option value="Gerente de Finanzas">Gerente de Finanzas</option>
                                        <option value="Gerente de Sucursales">Gerente de Mantenimiento y Soporte</option>
                                        <option value="Gerente de Sucursales">Gerente General</option>
                                      </select>
                                      <input type="hidden" name="tipoC" id="tipoCid1" value="1">
                                      <input type="hidden" name="tipoC2" id="tipoCid21" value="1">
                                @else
                                  <select name="cargo1" class="opcTipo form-control-lg" id="opcOperativo1"  onchange="cargoEleccion('1')">
                                        <option value="{{ $empleado->empleado->cargo }}">{{ $empleado->empleado->cargo }}</option>
                                        <option value="Operador de Tráfico" >Operador de Tráfico</option>
                                        <option value="Controlador de Tráfico" >Controlador de Tráfico</option>
                                        <option value="Supervisor de Mantenimiento">Supervisor de Mantenimiento</option>
                                        <option value="Mecánico">Mecánico</option>
                                      </select>
                                      <div class="oculto" id="opcTripulante1">
                                  <div class="form-row">
                                  <div class="col-md-6">
                                    <select name="cargo2" class="opcTipo form-control-lg" id="" onchange="cargoEleccion('1')">
                                          <option value="0">Seleccione un rango</option>
                                          <option value="Piloto">Piloto</option>
                                          <option value="Copiiloto">Copiloto</option>
                                          <option value="Jefe de Cabina">Jefe de Cabina</option>
                                          <option value="Sobrecargo">Sobrecargo</option>
                                        </select>
                                        </div>                            
                                      <div class="col-md-6">
                                              <div class="input-group mb-2 mb-sm-0">
                                              <div class="input-group-addon"> <i class="fa fa-plane" aria-hidden="true"></i> </div>
                                                <input type="text" class="form-control" id="licencia" placeholder="Ingrese la licencia" name="licencia" >
                                              </div>
                                        </div> 
                                    </div>  
                                      </div>
                                      <select name="cargo3" class="opcTipo oculto form-control-lg" id="opcAdministrativo1" onchange="cargoEleccion('1')">
                                        <option value="0">Seleccione un cargo</option>
                                        <option value="Obrero">Obrero</option>
                                        <option value="Beder">Beder</option>
                                        <option value="Asistente de RRHH">Asistente de RRHH</option>
                                        <option value="SubGerente de Sucursal">SubGerente de Sucursal</option>
                                        <option value="Gerente de RRHH">Gerente de RRHH</option>
                                        <option value="Gerente de Finanzas">Gerente de Finanzas</option>
                                        <option value="Gerente de Sucursales">Gerente de Mantenimiento y Soporte</option>
                                        <option value="Gerente de Sucursales">Gerente General</option>
                                      </select>
                                      <input type="hidden" name="tipoC" id="tipoCid1" value="3">
                                      <input type="hidden" name="tipoC2" id="tipoCid21" value="1">
                                @endif
                                <br>
                                  </div><div class="" id="CdatosEmpleado1">
                                    <div class="form-row">
                                
                                  <div class="form-group col-md-6">

                                          <div class="input-group">
                                          @if(Auth::user()->tipo=='Gerente de RRHH')
                                            <div class="input-group-btn">
                                                  <button type="button" class="btn btn-secondary dropdown-toggle" style="min-width: 8rem;" 
                                                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown">Sucursal
                                                  </button>
                                                  <div class="dropdown-menu ">
                                                    @foreach($sucursales as $sucursal1)
                                                    <a class="dropdown-item" id="sucursalT{{ $sucursal1->id }}" onclick="datosSP('{{ $sucursal1->id }}','sucursal')">{{ $sucursal1->nombre }}</a>
                                                    @endforeach
                                                  </div>
                                              </div>
                                               <input type="text" class="form-control" aria-label="Text input with dropdown button" id="sucursalN" placeholder="Seleccione la sucursal donde labora" value="{{ $empleado->empleado->sucursal->nombre }}" readonly >
                                               <input type="hidden" name="sucursalid" id="sucursalid" value="{{ $empleado->empleado->sucursal_id }}">
                                              <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>
                                              @else
                                                  <div class="input-group-btn">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" style="min-width: 8rem;" 
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown">Sucursal
                                                    </button>
                                                    <div class="dropdown-menu ">
                                                      <a class="dropdown-item" id="sucursalT{{ $sucursal->id }}" onclick="datosSP('{{ $sucursal->id }}','sucursal')">{{ $sucursal->nombre }}</a>
                                                    </div>
                                                </div>
                                                 <input type="text" class="form-control" aria-label="Text input with dropdown button" id="sucursalN" placeholder="Seleccione la sucursal donde labora" value="{{ $empleado->empleado->sucursal->nombre }}" readonly >
                                                 <input type="hidden" name="sucursalid" id="sucursalid" value="{{ $empleado->empleado->sucursal_id }}">
                                                <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>
                                              @endif
                                        </div>
                                    </div>                            
                                  <div class="form-group col-md-6">
                                          <div class="input-group">
                                            <div class="input-group-btn">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" style="min-width: 8rem;" 
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown">Horario
                                              </button>
                                              <div class="dropdown-menu ">
                                                @foreach($horarios as $horario)
                                                <a class="dropdown-item" id="horarioT{{ $horario->id }}"  onclick="datosSP('{{ $horario->id }}','horario')">{{ $horario->entrada." ".$horario->salida }}</a>
                                                @endforeach
                                              </div>
                                            </div>
                                             <input type="text" class="form-control" aria-label="Text input with dropdown button" id="horarioN" placeholder="Seleccione el horario de trabajo" value="{{ $empleado->empleado->horario->entrada.' '.$empleado->empleado->horario->salida }}" readonly >
                                             <input type="hidden" name="horarioid" id="horarioid" value="{{ $empleado->empleado->horario_id }}">
                                            <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>
                                          </div>
                                    </div> 
                                </div> 
                              </div><!-- FIn de datos Empleado -->
                            @else
                              <select name="cargo1" class="opcTipo oculto form-control-lg" id="opcOperativo1"  onchange="cargoEleccion('1')">
                                        <option value="0">Seleccione un cargo</option>
                                        <option value="Operador de Tráfico" >Operador de Tráfico</option>
                                        <option value="Controlador de Tráfico" >Controlador de Tráfico</option>
                                        <option value="Supervisor de Mantenimiento">Supervisor de Mantenimiento</option>
                                        <option value="Mecánico">Mecánico</option>
                                      </select>
                                      <div class="" id="opcTripulante1">
                                  <div class="form-row">
                                  <div class="col-md-6">
                                    <select name="cargo2" class="opcTipo form-control-lg" id="" onchange="cargoEleccion('1')">
                                          <option value="{{ $empleado->tripulante->rango }}">{{ $empleado->tripulante->rango }}</option>
                                          <option value="Piloto">Piloto</option>
                                          <option value="Copiiloto">Copiloto</option>
                                          <option value="Jefe de Cabina">Jefe de Cabina</option>
                                          <option value="Sobrecargo">Sobrecargo</option>
                                        </select>
                                        </div>                            
                                      <div class="col-md-6">
                                              <div class="input-group mb-2 mb-sm-0">
                                              <div class="input-group-addon"> <i class="fa fa-plane" aria-hidden="true"></i> </div>
                                                <input type="text" class="form-control" id="licencia" placeholder="Ingrese la licencia" name="licencia" value="{{ $empleado->tripulante->licencia }}" >
                                              </div>
                                        </div> 
                                    </div>  
                                      </div>
                                      <select name="cargo3" class="opcTipo oculto form-control-lg" id="opcAdministrativo1" onchange="cargoEleccion('1')">
                                        <option value="0">Seleccione un cargo</option>
                                        <option value="Obrero">Obrero</option>
                                        <option value="Beder">Beder</option>
                                        <option value="Asistente de RRHH">Asistente de RRHH</option>
                                        <option value="SubGerente de Sucursal">SubGerente de Sucursal</option>
                                        <option value="Gerente de RRHH">Gerente de RRHH</option>
                                        <option value="Gerente de Finanzas">Gerente de Finanzas</option>
                                        <option value="Gerente de Sucursales">Gerente de Mantenimiento y Soporte</option>
                                        <option value="Gerente de Sucursales">Gerente General</option>
                                      </select>
                                      <input type="hidden" name="tipoC" id="tipoCid1" value="2">
                                      <input type="hidden" name="tipoC2" id="tipoCid21" value="1">
                                      <br>
                                  </div><div class="oculto" id="CdatosEmpleado1">
                                    <div class="form-row">
                                
                                  <div class="form-group col-md-6">
                                          <div class="input-group">

                                            <div class="input-group-btn">
                                                  <button type="button" class="btn btn-secondary dropdown-toggle" style="min-width: 8rem;" 
                                                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown">Sucursal
                                                  </button>
                                                  <div class="dropdown-menu ">
                                                    @foreach($sucursales as $sucursal)
                                                    <a class="dropdown-item" id="sucursalT{{ $sucursal->id }}" onclick="datosSP('{{ $sucursal->id }}','sucursal')">{{ $sucursal->nombre }}</a>
                                                    @endforeach
                                                  </div>
                                              </div>
                                               <input type="text" class="form-control" aria-label="Text input with dropdown button" id="sucursalN" placeholder="Seleccione la sucursal donde labora" value="" readonly >
                                               <input type="hidden" name="sucursalid" id="sucursalid" value="">
                                              <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>
                                        </div>
                                    </div>                            
                                  <div class="form-group col-md-6">
                                          <div class="input-group">
                                            <div class="input-group-btn">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" style="min-width: 8rem;" 
                                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown">Horario
                                              </button>
                                              <div class="dropdown-menu ">
                                                @foreach($horarios as $horario)
                                                <a class="dropdown-item" id="horarioT{{ $horario->id }}"  onclick="datosSP('{{ $horario->id }}','horario')">{{ $horario->entrada." ".$horario->salida }}</a>
                                                @endforeach
                                              </div>
                                            </div>
                                             <input type="text" class="form-control" aria-label="Text input with dropdown button" id="horarioN" placeholder="Seleccione el horario de trabajo" value="" readonly >
                                             <input type="hidden" name="horarioid" id="horarioid" value="">
                                            <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>
                                          </div>
                                    </div> 
                                </div> 
                              </div><!-- FIn de datos Empleado -->

                            @endif
                           
                       </div>


                            </div>
                            
                    <br>
                    

                     </div>
                   </div>
                 </div>

              </div>
            </div>