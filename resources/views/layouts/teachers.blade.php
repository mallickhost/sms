<!doctype html>
<html lang="en">
   <head>
      @include('includes.teachers.header')
   </head>
   <body class="hold-transition sidebar-mini layout-fixed ">

      <div class="wrapper">
         @include('includes.teachers.sidemenu')

         @yield('content')
   
         @include('includes.teachers.footer')
      </div>

   </body>
</html>