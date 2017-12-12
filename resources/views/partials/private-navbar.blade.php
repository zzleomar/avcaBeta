
@switch(Auth::user()->tipo)
        @case('Operador')
            <div class="container">
              <div class="container py-3  avcaColor">

            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Taquilla</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Chequeo Boleto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Información al Cliente</a>
                  </li>
                </ul>
              </div>
        @break
 
        @case('Subgerente de Sucursal')
            <div class="container">
              <div class="container py-3  avcaColor">

            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Vuelos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Recursos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Solicitud</a>
                  </li>
                </ul>
              </div>

        @break


        @case('Gerente de Sucursales')
              <div class="container py-3  avcaColor">

            <div class="card text-center">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Administración de Vuelos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Administración de Rutas</a>
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


        @case('Gerente de Finanzas')
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


        @case('Gerente de RRHH')
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
@endswitch