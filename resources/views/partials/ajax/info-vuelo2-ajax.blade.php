<div class="form-group">
                          <label for="inputvuelos">Fechas disponibles para el vuelo</label>
                            <div class="input-group">
                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Fechas
                              </button>
                              <div class="dropdown-menu">
                              @foreach($fechas2 as $fecha)
                                <a class="dropdown-item" href="#info-vuelo-dispo2" id="fc2{{ $fecha->id }}" onclick="capturarFechas2('{{ $fecha->id }}')">{{ $fecha->salida}}</a>
                            @endforeach
                              </div>
                            </div>
                             <input name="fc2" id="fc2" type="text" class="form-control" aria-label="Text input with dropdown button">
                            </div>
                </div>

      <div id="info-vuelo-dispo2"></div>
                