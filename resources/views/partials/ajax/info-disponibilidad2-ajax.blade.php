<div class="form-row">
          <div class="form-group col-md-4">
                    <label for="inputPuesto">Puesto del pasajero</label>
                    <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> <i class="fa fa-user-o" aria-hidden="true"></i> </div>
                      <input type="text" readonly class="form-control-plaintext inputAux" id="staticEmail2" value="{{ $boleto->asiento }}">
                      </div>
              </div>
              <div class="form-group col-md-4">
                    <label for="inputApellido">Numero de Boleto:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon"> # </div>
                    <input type="text" readonly class="form-control-plaintext inputAux" id="sdfdsaf" value="{{ $boleto->id }}">
                  </div>
              </div>


              <div class="form-group col-md-4">
                    <label for="inputApellido">Costo Vuelo:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-money" aria-hidden="true"></i> </div> 
                    <input type="text" readonly class="form-control-plaintext inputAux" id="staticEmail2" value="{{ $boleto->costo }}">
                    <div class="input-group-addon">Bs.</div>
                  </div> 
              </div>

              
          </div>
<div class="form-row">
  <div class="form-group col-md-4 costo-center">
                    <label for="inputApellido">Costo Total:</label>
                  <div class="input-group mb-2 mb-sm-0">
                    <div class="input-group-addon">  <i class="fa fa-money" aria-hidden="true"></i> </div> 
                    <input type="text" readonly class="form-control-plaintext inputAux" id="staticEmail2" value="{{ $costoT }}">
                    <div class="input-group-addon">Bs.</div>
                  </div> 
              </div>
</div>

<script type="text/javascript">
      document.getElementById("boletoAux").value = "{{ $boleto->id }}";
</script>