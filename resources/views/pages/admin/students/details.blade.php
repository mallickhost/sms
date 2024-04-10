@extends('layouts.admin')
@section('title', 'Students Details')
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
              <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
						
                      <img class="profile-user-img img-fluid img-circle"
                          src="{{asset('assets/img/avatar-h.png')}}"
                          alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$arr_student['student_name']}}</h3>

                    <p class="text-muted text-center">{{$arr_student['student_number']}}</p>

                    <!-- <ul class="list-group list-group-unbordered mb-0">
                      <li class="list-group-item">
                        <b>Class</b> <a class="float-right">IV</a>
                      </li>
                      <li class="list-group-item">
                        <b>section</b> <a class="float-right">B</a>
                      </li>
                      <li class="list-group-item">
                        <b>Roll No</b> <a class="float-right">13</a>
                      </li>
                      <li class="list-group-item">
                        <b>Gender</b> <a class="float-right">Female</a>
                      </li>
                    </ul> -->

                  
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">Student Additional Info</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fa-user-friends"></i> Parent's Name</strong>
                    <p class="text-muted">
                    M: {{$arr_student['mother_name']}} <br> F: {{$arr_student['father_name']}}
                    </p>
                    <hr>
                    <strong><i class="fas fa-phone-alt"></i> Contact Number</strong>
                    <p class="text-muted">
                    {{$arr_student['mobile_no_1']}} <br> {{$arr_student['mobile_no_2']}}
                    </p>
                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                    <p class="text-muted"> {{$arr_student['address']}}</p>

                    <button class="btn btn-danger btn-block"><i class="fas fa-user-times"></i> Parmanent Delete</button>
                  
                </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title text-danger">Current Academic Details</h3>
                      <div class="card-tools">
                          <!-- <a href="{{ route('admin.students.list') }}" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i> Back</a> -->
                      </div>
                    </div>

                    <div class="card-body">
                      <form action="{{ route('admin.students.updateAcademicDetails') }}" method="POST" >
					            @csrf
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Academic Session</label>
                              <select class="form-control" name='academic_session_id' >
                                @foreach($arr_session as $session)							
                                  <option value="{{$session->id}}" >{{$session->session_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                            	<label>Class</label>
                              	<select class="form-control" name='academic_class_id' >
									@foreach($arr_class as $class)							
										<option value="{{$class->id}}" >{{$class->class_roman_name}}</option>
									@endforeach
								</select>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Section</label>
                              <select class="form-control" name='section_id' >
									@foreach($arr_section as $section)							
										<option value="{{$section->id}}" >{{$section->name}}</option>
									@endforeach
								</select>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Roll Number</label>
                              <input type="text" class="form-control" name='roll_number' placeholder="Roll No">
                            </div>
                          </div>

                          <div class="col-sm-3">
						              	<div class="form-group">
                              <br>
							                 <input type="hidden"  name='student_id' value='{{$arr_student["id"]}}' >
                              <button type="submit" class="btn btn-primary float-right">Save changes</button>
                            </div>
                          </div>

                        </div>
                        
                      </form>
                    </div>
                  </div>


					<!-- <div class="card">
						<div class="card-header">
						<h3 class="card-title text-primary">Academic Results</h3>
						</div>

						<div class="card-body ">
							<table class="table table-sm">
							<thead>
								<tr>
								<th>Exam Name</th>
								<th>Result on</th>
								<th>Result uploaded</th>
								<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>                    
								<td>Class Test</td>
								<td>16-Jan-2024</td>
								<td>Yes</td>
								<td> 
									<button class="btn btn-sm btn-primary" title="Download Result"><i class="fas fa-download"></i></button>
								</td>
								</tr>
								<tr>                    
								<td>Half Yearly</td>
								<td>27-Jun-2024</td>
								<td>Yes</td>
								<td> 
									<button class="btn btn-sm btn-primary" title="Download Result"><i class="fas fa-download"></i></button>
								</td>
								</tr>
								

							</tbody>
							</table>     
						
						</div>
						
					</div> -->

                
				
				
				
				
				  <div class="card">
                  <div class="card-header">
                    <h3 class="card-title text-info">Academic History</h3>
                  </div>

                  <div class="card-body ">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>Academic Session</th>
							              <th>Year</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Roll No</th>
							              <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($arr_student['academic_details'] as $academic_details)
                              <tr>                    
                                <td>{{$academic_details['academic_session']['session_name']}}</td>
                                <td>{{$academic_details['academic_session']['session_year']}}</td>
                                <td>{{$academic_details['class']['class_roman_name']}}</td>
                                <td>{{$academic_details['section']['name']}}</td>
                                              <td>{{$academic_details['roll_number']}}</td>
                                <td><span class="badge bg-primary">Studing</span></td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>     
                  
                  </div>
                     
                  </div>

                </div>

              </div>
              <!-- /.col -->
        </div>
            
    </section>
</div>


    <!-- /.content-wrapper -->
@endsection


@section('scripts')
<script>

$(document).ready(function(){




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

