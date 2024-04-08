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
      <!-- <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}"> -->
   </head>
   <body >
   <body class="hold-transition sidebar-mini layout-fixed ">

      <div class="wrapper">
       

         @yield('content')
   
    
      </div>
 <!-- jQuery -->
 <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 5 -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>


@yield('scripts')
</body>
</html>