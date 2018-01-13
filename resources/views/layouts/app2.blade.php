<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://v4-alpha.getbootstrap.com/favicon.ico">

    <title>Sticky Footer Navbar Template for Bootstrap</title>
    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
    <script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>


  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-toggleable-md navbar-inverse  bg-dark">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">Fixed navbar</a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" placeholder="Search" type="text">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">
      <div class="mt-3">
        <h1>Sticky footer with fixed navbar</h1>
      </div>
      <p class="lead">Pin a fixed-height footer to the bottom of the 
viewport in desktop browsers with this custom HTML and CSS. A fixed 
navbar has been added with <code>padding-top: 60px;</code> on the <code>body &gt; .container</code>.</p>
      <p>Back to <a href="http://v4-alpha.getbootstrap.com/examples/sticky-footer">the default sticky footer</a> minus the navbar.</p>
    </div>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 
  

</body></html>