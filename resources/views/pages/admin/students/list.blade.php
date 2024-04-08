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

          <div class="card card-primary ">
            <div class="card-header">
              <h3 class="card-title">Students List</h3>
              <div class="card-tools">
              <a  data-toggle="modal" data-target="#myModal"  class="btn btn-tool btn-warning" href="{{ route('admin.students.add_edit') }}"><i class="fas fa-plus"></i> Add new Student</a>
           
               
                 
              </div>
            </div>
            <div class="card-body" >
              
            <form action="{{ route('admin.students.list') }}" method="GET">
            @csrf
              <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                        <label>Student Name</label>
                        <input type="text" name="student_name" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                        <label>Student Number</label>
                        <input type="text" name="student_number" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                        <label>Class</label>
                        <select class="form-control" name="student_class">
                          <option>--- Select ---</option>
                          <option>LKG</option>
                          <option>Class I</option>
                          <option>Class II</option>
                          <option>Class III</option>
                          <option>Class IV</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                        <label>Section</label>
                        <select class="form-control" name="class_section">
                          <option>--- Select ---</option>
                          <option>Sec A</option>
                          <option>Sec B</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                        <label>Roll No.</label>
                        <input type="text" name="roll_number" class="form-control" placeholder="Roll No.">
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                        <br>
                        <button class="btn btn-md btn-success"><i class="fas fa-search"></i> </button>
                        <button class="btn btn-md btn-info"><i class="fas fa-undo"></i></button>
                    </div>
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
                            <a target="_blank" title="Fees details"  class="btn btn-sm btn-primary" href="{{ route('admin.students.fees', ['studentId' => $student->id]) }}"><i class="fas fa-rupee-sign"></i></a>
                            <a target="_blank" title="Academic details" class="btn btn-sm btn-info" href="{{ route('admin.students.details', ['studentId' => $student->id]) }}"><i class="fas fa-id-card"></i></a>
                            <a title="Edit Studetn" data-toggle="modal" data-target="#myModal"  class="btn btn-sm btn-success" href="{{ route('admin.students.add_edit', ['studentId' => $student->id]) }}"><i class="fas fa-pencil-alt"></i></a>
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
      $('.modal-content').load(targetUrl);
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

