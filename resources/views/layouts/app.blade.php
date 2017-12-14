<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
    <script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('plugin/Loading/dist/loading-overlay.min.js') }}"></script>
  <link type="text/css" href="{{ asset('plugin/Loading/demo/demo.css') }}" rel="stylesheet"></link>

</head>
<body>
    <header class="header sticky-top fondo-header"> 
        <nav class="navbar navbar-expand-lg navbar-dark navperso perso">
            <div class="container2">                
                
                <div class="collapse navbar-collapse" id="avca-navbar">
                    
                    <ul class="navbar-nav ml-auto">
                        {{--  Links de autenticacion  --}}                
                        @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Ingresar</a></li>
                        @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                <?php $id=Auth::user()->administrativo_id;
                                    $personal=Auth::user()->Personal($id); ?>
                                    {{ Auth::user()->tipo.": ".$personal->nombres." ".$personal->apellidos }}                              
                               <!-- Isabel Lopez -->
                            </a>

                            <div class="dropdown-menu" aria-labelledby="userDropdown">                          <a href="#" class="dropdown-item">
                                    <i class="fa fa-user" aria-hidden="true"></i> Perfil                  
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fa fa-lock" aria-hidden="true"></i> Cambiar contraseña       
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();" class="dropdown-item">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> Cerrar sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                        @endguest

                    </ul>
                </div>  {{-- Final del div collapse --}}
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#avca-navbar" aria-controls="avca-navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>  {{-- Final del div container --}}
        </nav>
    </header>

    <main class="py-4">
        <div class="container">
            @if(count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>                    
                </div>
            @endif
            @auth
                @include('partials.private-navbar')
            @endauth
            @yield('content')
        </div>
    </main>

    <footer class="footer py-2">
        <p class="text-center text-muted">&copy;2017 <a href="·">SIOCA</a> - Todos los derechos reservados</p>
    </footer>

    <!-- Scripts -->
    
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
