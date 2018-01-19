<input type="hidden" name="aeronave_id" id="aeronave_id" value="{{ $aeronave->id }}">
            <div class="form-row">
<div class="form-group col-sm-12 col-md-6">
<label style="font-weight: 600;">Matricula</label>
                <input type="text" class="form-control" id="matriculaN" name="matricula" placeholder="matricula" value="{{ $aeronave->matricula }}" required>
              </div>
                                                               
              <div class="form-group col-sm-12 col-md-6">
<label style="font-weight: 600;">Modelo</label>
                <input type="text" class="form-control" id="modeloN" name="modelo" placeholder="modelo" value="{{ $aeronave->modelo }}" required>
              </div>

              <div class="form-group col-sm-12 col-md-6">
<label style="font-weight: 600;">Capacidad</label>

                <input type="text" class="form-control" id="capacidadN" name="capacidad" placeholder="capacidad" onkeypress="return soloNumDec(event)" value="{{ $aeronave->capacidad }}" required>
              </div>


              <div class="form-group col-sm-12 col-md-6">
<label style="font-weight: 600;">Estado</label>
                <select class="form-control form-control-lg" name="estado">
                	@switch($aeronave->estado)
                      @case('activo')
                        <option value="activo" selected>activo</option>
                        <option value="inactivo">inactivo</option>
                        <option value="mantenimiento">mantenimiento</option>
                      @break
                      @case('inactivo')
                        <option value="inactivo" selected>inactivo</option>
                        <option value="activo">activo</option>
                        <option value="mantenimiento">mantenimiento</option>
                      @break
                      @case('mantenimiento')
                        <option value="mantenimiento" selected>mantenimiento</option>
                        <option value="activo">activo</option>
                        <option value="inactivo">inactivo</option>
                      @break
                  @endswitch
                </select>
              </div>
</div>