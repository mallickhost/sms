@extends('layouts.web')
@section('title', 'Home Page')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="starter-template">
    <br/><br/><br/><br/>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <img src="{{asset('assets/img/web/student_login.jpg')}}" class="img-fluid" alt="Responsive image">
            </div>

            <div class="col-md-6">
                <form action="{{ route('students.doLogin') }}" method="POST" id='frmLogin'>
                  <div class="mb-3">
                          <label  class="form-label">Student Number</label>
                          <input type="text" name='student_number' class="form-control" placeholder="Student Number ">
                  </div>
                  <div class="mb-3">
                          <label class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" placeholder="**********">
                  </div>
                  <div class="mb-3">
                
                  <div class="mb-3">
                      <a class="text-danger" href=""><i class="fas fa-key"></i> Forgot password</a> &nbsp;&nbsp;&nbsp;&nbsp;
                      <a class="text-info" href=""><i class="fas fa-user-plus"></i> Register New Student</a>      
                  </div>
                  <div class="mb-12">
                      <button type='submit' class="btn btn-flat  btn-primary">Login to student account</button>        
                  </div>
                </form>
              </div>
        </div>

    </div>
</div>

<div style='height:120px;'></div>

@endsection


@section('scripts')
<script>

$(document).ready(function(){
    // $('#xx').on('click',function(){
    //     $("#addModal").modal('show');
    // });
})
</script>
@endsection