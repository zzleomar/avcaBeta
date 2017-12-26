<div class="subtituloM">       <h4> Aeronave</h4></div>
               <hr>      
<div class="form-row">
    <div class="form-group col-md-5 centrarAux">
        <label class="infoTitulo" for="inputPuesto">Matricula: </label><label style="margin-left: 10px;">{{ $vuelo->pierna->aeronave->matricula }}</label>
    </div>
    <div class="form-group col-md-5 centrarAux">
        <label class="infoTitulo" for="inputPuesto">Modelo: </label><label style="margin-left: 10px;">{{ $vuelo->pierna->aeronave->modelo }}
    </div>
</div>

       <div class="subtituloM">       <h4> Boletos</h4></div>
               <hr>
<div class="form-row">

    <div class="form-group col-md-5 centrarAux">
        <label class="infoTitulo" for="inputPuesto">Boletos Vendidos</label>
        <div class="input-group mb-2 mb-sm-0">
              <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Pagado'] }}">
        </div>
    </div>

              
    <div class="form-group col-md-5 centrarAux">
        <label class="infoTitulo" for="inputPuesto">Boletos Reservados</label>
        <div class="input-group mb-2 mb-sm-0">
              <input type="text" readonly class="form-control-plaintext inputAux centrarAux" id="staticEmail2" value="{{ $boletos['Reservados'] }}">
        </div>
    </div>
</div>
               <hr>
       <div class="subtituloM"> <h4> Tripulación</h4></div>
               <hr>       
<div class="table-responsive"> 
  <table class="table table-hover text-center">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Experiencia (Hrs Voladas)</th>
        <th>Licencia</th>
      </tr>
    </thead>
     @foreach($vuelo->personal_operativo as $tripulante)

    <tbody>
      <th scope="row">{{ $tripulante->rango }}</th>
      @php
        $persona=$tripulante->Persona();
      @endphp
        <td>{{ $persona->apellidos." ".$persona->nombres }}</td>
        <td>80 Hras</td>
        <td>{{ $tripulante->licencia }}</td>
   
    </tbody>
    @endforeach
  </table>
  </div>

  @if($vuelo->estado=='retrasado')
      <button type="button" class="btn btn-lg btn-outline-success" value="Ejecutar Vuelo" onclick="estadoVuelo('/sucursal/vuelo/ejecutado/{{ $vuelo->id }}')">Vuelo ejecutado</button>
  @endif