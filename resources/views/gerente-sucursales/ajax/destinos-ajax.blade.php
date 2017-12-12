
      <div class="text-center" >
      		Seleccione el Destino
      </div>
<div class="text-center">
        <select class="custom-select margenInferior" onchange="vuelosAjax()" id="item-destino">
            <option selected>Sucursal-Destino</option>
             @foreach($destinos as $destino)

                <option value="{{ $destino->destino->id }}">{{ $destino->destino->nombre }}</option>

              @endforeach
        </select>     
      </div>