<input type="hidden" name="ruta_id" id="ruta_id" value="{{ $ruta->id }}">
<div class="row">
                    <div class="col col-sm-12 col-md-12 btn-aux-magin">
                            <div class="input-group">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Origen
                              </button>
                              <div class="dropdown-menu dropAux">
                        @foreach($sucursales as $sucursal)
                                <a class="dropdown-item" id="suO{{ $sucursal->id }}" onclick="capturarO('{{ $sucursal->id }}','B')">{{ $sucursal->nombre }}</a>
                            @endforeach
                              </div>
                            </div>
                             <input type="text" class="form-control" aria-label="Text input with dropdown button" id="origenNRB" placeholder="Seleccione Sucursal de Origen" value="{{ $ruta->origen->nombre }}" readonly required>
                             <input type="hidden" name="origenid" id="origenidB" value="{{ $ruta->origen->id }}">
                            <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>


                            </div>
                    </div>
                    <div class="col col-sm-12 col-md-12 btn-aux-magin">
                            <div class="input-group">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="myDropdown"> Destino
                              </button>
                              <div class="dropdown-menu dropAux">
                        @foreach($sucursales as $sucursal)
                                <a class="dropdown-item" id="suD{{ $sucursal->id }}" onclick="capturarD('{{ $sucursal->id }}','B')">{{ $sucursal->nombre }}</a>
                            @endforeach
                              </div>
                            </div>
                             <input type="text" class="form-control" aria-label="Text input with dropdown button" id="destinoNRB" placeholder="Seleccione Sucursal de Destino" value="{{ $ruta->destino->nombre }}" readonly required>
                             <input type="hidden" name="destinoid" id="destinoidB" value="{{ $ruta->destino->id }}">
                            <div class="input-group-addon"><i class="fa fa-plane" aria-hidden="true"></i> </div>


                            </div>
                    </div>
          

                        <div class="row">

                            <div class="form-group col-sm-12 col-md-4"> 
                              <label for="inputEmail4">Distancia Mls.</label>
                              <input type="text" class="form-control" placeholder="Distancia" id="distanciaNR" name="distancia" onkeypress="return soloNumDec(event)" value="{{ $ruta->distancia }}" required>
                            </div>
                            

                            <div class="form-group col-sm-12 col-md-4">
                              <label for="inputEmail4">Duración Hrs.</label>

                              <div class="form-group-duracion"> <input type="text" class="duracionInput" name="horas" id="horasD" onkeypress="return soloNum(event)" value="{{ DATE('i',strtotime($ruta->duracion)) }}"><span id="separadorD">:</span>
                              <input type="text" class="duracionInput" name="minutos" id="minutosD" onkeypress="return soloNum(event)" value="{{ DATE('s',strtotime($ruta->duracion)) }}">
                            </div>
                            </div>

                            
                            <div class="form-group col-sm-12 col-md-4">
                              <label for="inputEmail4">Tarifa Vuelo Bs.</label>
                              <input type="text" class="form-control" placeholder="Precio" id="precioNR" name="precio" onkeypress="return soloNumDec(event)" value="{{ $ruta->tarifa_vuelo }}" required>
                            </div>
                       </div>
    </div>