@extends('layouts.login')
@section('title', 'Login')
@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Teachers</b>Portal</a>
    </div>
    <div class="card-body">

   
    @include('includes.flash')
    
    <p class="login-box-msg">Sign in to Teachers Portal</p>

     

      <form action="{{ route('teachers.doLogin') }}" method="POST" id='frmLogin'>
      @csrf
       
      <div class="form-group">
            <label for='email'>Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>


        <div class="row">
          <div class="col-8">
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">
            <i class="fa fa-sign-in-alt"></i> Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

   <!-- FORM END -->

      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>
      <p class="mb-1">
        <a href="#">Register new account</a>
      </p>
   
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
 
@endsection

@section('scripts')
<script>
$(function () {
  // $.validator.setDefaults({
  //   submitHandler: function () {
  //     alert( "Form successful submitted!" );
  //   }
  // });
  $('#frmLogin').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 3
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection