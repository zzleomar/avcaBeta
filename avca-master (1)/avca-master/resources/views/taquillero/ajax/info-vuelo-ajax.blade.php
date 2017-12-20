<div class="form-group">
                          <label for="inputvuelos">Fechas disponibles para el vuelo</label>
                            <div class="input-group">
                            <div class="input-group-btn">
                              <button type="button" class="btn btn-secondary dropdown-toggle"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Fechas
                              </button>
                              <div class="dropdown-menu">
                              @foreach($fechas as $fecha)
                                <a class="dropdown-item" href="#info-vuelo-dispo" id="fc{{ $fecha->id }}" onclick="capturarFechas('{{ $fecha->id }}')">{{ $fecha->salida}}</a>
                            @endforeach
                              </div>
                            </div>
                             <input name="fc" id="fc" type="text" class="form-control" aria-label="Text input with dropdown button">
                            <input type="hidden" name="vueloid" id="vueloid" value="">

                            </div>
                </div>

      <div id="info-vuelo-dispo"></div>
                