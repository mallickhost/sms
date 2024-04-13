@extends('layouts.admin')
@section('title', 'Students List')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
      <br>

       <!-- Main content -->
    <section class="content">

        <div class="container-fluid">


            <!-- Flash message  -->
            @include('includes.flash')

        <div class="row">
          <div class="col-12">

          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Students List</h3>
            </div>
            <div class="card-body" >
              
				<form action="{{ route('admin.students.list') }}" method="GET">
				@csrf


					<div class="row">
						<div class="col-3">
							<input type="text" name="student_name" class="form-control" placeholder="Student Name">
						</div>
						<div class="col-3">
							<input type="text" name="student_number" class="form-control" placeholder="Student Number">
						</div>
						<div class="col-2">
							<input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number">
						</div>
																					
						<div class="col-2">
							<button class="btn btn-sm btn-outline-primary"><i class="fas fa-search"></i> Search</button>
							<button class="btn btn-sm btn-outline-primary"><i class="fas fa-undo"></i></button>
						</div>
						<div class="col-2">
							<a  data-toggle="modal" data-target="#myModal"  class="btn btn-outline-primary" href="{{ route('admin.students.add_edit') }}"><i class="fas fa-user-plus"></i> Add Student</a>
						</div>
					</div>

				</form>
            </div>
          </div>


          </div>

        </div>
            

            <div class="row">
              <div class="col-12">
                <div class="card">
                 
                  <!-- /.card-header -->
                  <div class="card-body" >
                    <table class="table table-head-fixed table-sm  table-hover" id='client_list'>
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Student Number</th>
                          <th>Name</th>
                          <th>Father Name</th>
                          <th>aadhaar_number</th>
                          <th>Contact No</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @foreach ($students as $student)
                      <tr>
                          <td> {{ $student->id }}</td>
                          <td> {{ $student->student_number }}</td>
                          <td> {{ $student->student_name }}</td>
                          <td> {{ $student->father_name }}</td>
                          <td> {{ $student->aadhaar_number }}</td>
                          <td> {{ $student->mobile_no_1 }}</td>
                          <td>
                            <a  title="Academic details" class="btn btn-sm btn-outline-primary" href="{{ route('admin.students.details', ['studentId' => $student->id]) }}"><i class="fas fa-id-card"></i> View</a>
                            <a title="Edit Student" data-toggle="modal" data-target="#myModal"  class="btn btn-sm btn-outline-primary" href="{{ route('admin.students.add_edit', ['studentId' => $student->id]) }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                          </td>
                        </tr>
                      @endforeach
                        
                      </tbody>
                    
                    </table>
                   
                  </div>

                  <div class="card-footer clearfix ">
                    <div class="float-right">
                    {{ $students->withQueryString()->links() }}
                    </div>
                   
                  </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        </div>
        </div>
    </section>
</div>


<!-- Load Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content">
      <!-- modal content goes here -->
    </div>
  </div>
</div>
   
@endsection


@section('scripts')
<script>

$(document).ready(function(){



$('a[data-toggle="modal"]').on('click', function(e){
  e.preventDefault();
  var targetUrl = $(this).attr('href');
  $('.modal-content').load(targetUrl, function() {
      //  jQuery code modal

           $(function () {
              $.validator.setDefaults({
                // submitHandler: function () {
                //   $('#frm_save_student').submit();
                // }
              });
              $('#frm_save_student').validate({
                rules: {
                  student_name: {
                    required: true,
                  },
                  student_number: {
                    required: true
                  },
                  mobile_no_1: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                  },
                  mobile_no_1: {
                    required: false,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                  },
                  aadhaar_number: {
                    required: false,
                    minlength: 12,
                    maxlength: 12,
                    digits: true
                  },
                  father_name: {
                    required: true
                  },
                  address: {
                    required: true
                  },
                },
                messages: {
                  student_name: {
                    required: "Student name is required",
                  },
                  
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


        // -----------------------
  });
});






//https://www.youtube.com/watch?v=msiGe5U9HFU

    // $('#client_list').DataTable({
    //   processing: true,
    //      serverSide: true,
    //      ajax: "http://127.0.0.1:8000/api/ajax/client-list",
       
    //     columns: [
    //         { data: 'id' },
    //         { data: 'name' },
    //         { data: 'email' },
    //         { data: 'telephone' }
    //     ],
    //     processing: true,
    //     serverSide: true
    // });
})
</script>
@endsection

