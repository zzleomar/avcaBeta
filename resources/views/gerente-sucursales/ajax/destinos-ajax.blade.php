<div class="text-center">
            Seleccione el Destino
        </div>
        <select class="custom-select" id="item-origen" onchange="origenAjax()">
            <option selected>Sucursal-Destino</option>
              @foreach($destinos as $destino)

                <option value="{{ $destino->destino->id }}" >{{ $destino->destino->nombre }}</option>

              @endforeach
        </select>