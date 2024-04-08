<!doctype html>
<html lang="en">
   <head>
      @include('includes.admin.header')
   </head>
   <body class="hold-transition sidebar-mini layout-fixed ">

      <div class="wrapper">
         @include('includes.admin.sidemenu')

         @yield('content')
   
         @include('includes.admin.footer')
      </div>

   </body>
</html>