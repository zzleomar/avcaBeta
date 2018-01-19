
@switch(Auth::user()->tipo)
        @case('Operador de Trafico')
              <div class="avcaColor">

            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link" id="taquilla" href="{{ URL::to('/taquilla') }}">Taquilla</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="chequeo" href="{{ URL::to('/taquilla/confirmar-boleto') }}">Chequeo Boleto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Información al Cliente</a>
                  </li>
                </ul>
              </div>
        @break
 
        @case('Subgerente de Sucursal')
              <div class="avcaColor">

            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link" id="vuelos" href="{{ URL::to('/sucursal') }}">Vuelos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="taquilla" href="{{ URL::to('/taquilla') }}">Taquilla</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="chequeo" href="{{ URL::to('/taquilla/confirmar-boleto') }}">Chequeo Boleto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="adminPersonal" href="{{ URL::to('/gerencia/RRHH') }}">Administración de Personal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="adminAsistencia" href="{{ URL::to('/RRHH/asistencia') }}">Administración de Asistencia</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="ReporIngres" href="{{ URL::to('/reportes/ingresos') }}">Reportes de Ingresos</a>
                  </li>
                </ul>
              </div>

        @break


        @case('Gerente de Sucursales')
              <div class="avcaColor">

            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link " href="{{ URL::to('/gerente-sucursales') }}" id="sucursales">Administración de Vuelos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ URL::to('/gerente-sucursales/administracion-rutas') }}" id="adminrutas">Administración de Rutas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ URL::to('/gerente-sucursales/administracion-aeronaves') }}" id="adminaeronaves">Administración de Aeronaves</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="ReporIngres" href="{{ URL::to('/reportes/ingresos') }}">Reportes de Ingresos</a>
                  </li>
                </ul>
              </div>

        @break


        @case('Gerente General')
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-th" aria-hidden="true"></i> Menú</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Planificar vuelo</a>
                        </div>
                    </li>
                </ul>
        @break


        @case('Asistente de RRHH')
              <div class="avcaColor">

            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link" id="adminAsistencia" href="{{ URL::to('/RRHH/asistencia') }}">Administración de Asistencia</a>
                  </li>
                </ul>
              </div>
        @break


        @case('Gerente de RRHH')
              <div class="avcaColor">

            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link" id="gerentRRHHIni" href="{{ URL::to('/gerente-RRHH') }}">Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="adminPersonal" href="{{ URL::to('/gerencia/RRHH') }}">Administración de Personal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="OpcTabuladorSalarial" href="#">Tabulador Salarial</a>
                  </li>
                </ul>
              </div>
        @break
@endswitch