<div class="text-center">
            Destino
        </div>
        <select class="custom-select" id="item-destino" onchange="vuelosAjax()">
            <option selected>Sucursal-Destino</option>
              @foreach($destinos as $destino)

                <option value="{{ $destino->destino->id }}" >{{ $destino->destino->nombre }}</option>

              @endforeach
        </select>
        
        @foreach($destinos as $destino)
                <input type="hidden" id="suD{{ $destino->destino->id }}X" value="{{ $destino->destino->nombre }}">
        @endforeach