@extends('layouts.admin')
@section('title', 'Students Details')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <br/>
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
							

							@if(empty($arr_student['picture']))
								@if($arr_student['gender'] == 'MALE')
									@php
										$profile_img = 'assets/img/m_profile_pic.png';
									@endphp
								@elseif($arr_student['gender']=="FEMALE")
									@php
										$profile_img = 'assets/img/f_profile_pic.png';
									@endphp
								@endif

							@else
								@php
									$profile_img = 'storage/'.$arr_student['picture'];
								@endphp
								
							@endif

						
							
							<img class="profile-user-img img-fluid img-circle"
							src="{{asset($profile_img)}}"
								alt="User profile picture">
						</div>

						<h3 class="profile-username text-center">{{$arr_student['student_name']}}</h3>

						<p class="text-muted text-center">{{$arr_student['student_number']}}</p>

						@if(!empty($arr_student['current_academic_details']))
						
						<ul class="list-group list-group-unbordered mb-0">
							<li class="list-group-item" style="padding: 5px;">
								<b>Class</b> <a class="float-right">{{$arr_student['current_academic_details']['class']['class_roman_name']}}</a>
							</li>
							<li class="list-group-item" style="padding: 5px;">
								<b>section</b> <a class="float-right">{{$arr_student['current_academic_details']['section']['name']}}</a>
							</li>
							<li class="list-group-item" style="padding: 5px;">
								<b>Roll No</b> <a class="float-right">{{$arr_student['current_academic_details']['roll_number']}}</a>
							</li>
							<!-- <li class="list-group-item">
								<b>Gender</b> <a class="float-right">{{$arr_student['gender']}}</a>
							</li> -->
						</ul>
						<br>
						@else
						<a  data-toggle="modal" data-target="#myModal"  class="btn btn-outline-primary btn-block" href="{{ route('admin.students.promoteToNextClass',$arr_student['id']) }}"><i class="fas fa-arrow-up"></i> Promote to class</a>
						@endif
					
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

						<a  class="btn btn-outline-danger btn-block" href="#"><i class="fas fa-user-times"></i> Permanant Delete</a>
						
					</div>
				</div>
				<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-9">


								
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title text-primary">Academic History</h3>
								<div class="card-tools">
									<a href="{{ route('admin.students.list') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-chevron-left"></i> Back</a>
								</div>
							</div>

							<div class="card-body ">
							@if(!empty($arr_history))	
								<table class="table table-sm">
									<thead>
									<tr>
										<th>Academic Session</th>
										<th>Year</th>
										<th>Status</th>
										<th>Class</th>
										<th>Section</th>
										<th>Roll No</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									@foreach ($arr_history as $history)
										<tr>                    
											<td>{{$history['academic_session']['session_name']}}</td>
											<td>{{$history['academic_session']['session_year']}}</td>
											<td>
												@if($history['academic_status'] == "RUNNING")
												<span class="badge bg-primary">Current</span>
												@elseif($history['academic_status']=='PASSED')
												<span class="badge bg-success">Passed</span>
												@else
												<span class="badge bg-danger">Failed</span>
												@endif
											</td>
											<td>{{$history['class']['class_roman_name']}}</td>
											<td>{{$history['section']['name']}}</td>
											<td>{{$history['roll_number']}}</td>
											
											<td>
											<!-- <a data-toggle="modal" data-target="#myModal"  title="Fees details"  class="btn btn-sm btn-outline-primary" href="{{ route('admin.students.displayFees', ['studentId' => $history['student_id']]) }}"><i class="fas fa-rupee-sign"></i> Fees</a> -->
												<a title="Fees details"  class="btn btn-sm btn-outline-primary" href="{{ route('admin.students.fees', ['studentId' => $history['student_id'],'academicSessionId' => $history['academic_session_id']]) }}"><i class="fas fa-rupee-sign"></i> Fees</a>
												<button class="btn btn-sm btn-outline-primary"><i class="fas fa-table"></i> Results</button>
												@if($history['academic_status'] == "RUNNING")
												<a  data-toggle="modal" data-target="#myModal"  class="btn btn-outline-primary btn-sm" href="{{ route('admin.students.editAcademicDetails',$history['id']) }}"><i class="fas fa-pencil-alt"></i> Edit</a>
												@endif
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>  
								
							@else
							No academic records found !
							@endif
							</div>
								
						</div>
					
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
		$('.modal-content').load(targetUrl)
	});
})
</script>
@endsection

