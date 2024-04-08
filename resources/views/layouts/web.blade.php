<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>@yield('title')</title>

      <!-- Google Font: Source Sans Pro -->
      <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
     <!-- Bootstrap -->
     <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
     
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
   </head>
   <body >
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">

        <div class="">
          <a class="navbar-brand" href="#">
            <img src="{{asset('assets/img/web_logo.jpg')}}" alt="" width="30" height="24">
          </a>
        </div>
          <!-- <a class="navbar-brand" href="{{route('index') }}">Guma Juliant KG School </a> -->
          <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->

          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item nav-item {{ Request::routeIs('index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('index') }}">Home </a>
              </li>
              <li class="nav-item {{ Request::routeIs('students.login') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('students.login') }}">Students </a>
              </li>
              <li class="nav-item {{ Request::routeIs('about_us') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('about_us') }}">About Us </a>
              </li>
              <li class="nav-item {{ Request::routeIs('contact_us') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('contact_us') }}">Contact Us </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
              </li> -->
              <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li> -->
            </ul>
            
          </div>
        </nav>

      </header>



    <main role="main" class="container">
         @yield('content')
    </main><!-- /.container -->



    <!-- <footer class="footer mt-auto py-3 bg-light">
      <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
      </div>
    </footer> -->


    <footer class="container-fluid py-5 custom_footer">
      <div class="row">
        <div class="col-12 col-md">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mb-2"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
          <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
        </div>
        <div class="col-6 col-md">
          <h5>Features</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Cool stuff</a></li>
            <li><a class="text-muted" href="#">Random feature</a></li>
            <li><a class="text-muted" href="#">Team feature</a></li>
            <li><a class="text-muted" href="#">Stuff for developers</a></li>
            <li><a class="text-muted" href="#">Another one</a></li>
            <li><a class="text-muted" href="#">Last time</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Resources</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Resource</a></li>
            <li><a class="text-muted" href="#">Resource name</a></li>
            <li><a class="text-muted" href="#">Another resource</a></li>
            <li><a class="text-muted" href="#">Final resource</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Resources</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Business</a></li>
            <li><a class="text-muted" href="#">Education</a></li>
            <li><a class="text-muted" href="#">Government</a></li>
            <li><a class="text-muted" href="#">Gaming</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>About</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Team</a></li>
            <li><a class="text-muted" href="#">Locations</a></li>
            <li><a class="text-muted" href="#">Privacy</a></li>
            <li><a class="text-muted" href="#">Terms</a></li>
          </ul>
        </div>
      </div>
    </footer>
            
   <!-- jQuery -->
   <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

   <!-- Bootstrap 5 -->
   <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>


   @yield('scripts')
   </body>
</html>