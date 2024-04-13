@extends('layouts.admin')
@section('title', 'Academic Fees')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
  
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">

            @include('includes.flash')

            <div class="row">
               

				<div class="col-md-3">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title text-primary">Academic Sessions</h3>
						</div>
						<div class="card-body ">
					
						
							<table class="table table-sm">
								<thead>
									<tr>
										<th>Session</th>							
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($arr_all_session as $arr_session)	

									@if($arr_session['id'] == $selected_academic_session_details['id'])
									<tr class="table-primary">
									@else
									<tr>
									@endif
										
											<td>{{$arr_session['session_name']}}
												@if(!empty($arr_session['is_current']))
												<span class="badge bg-success"><i class="fas fa-check" title="Current Session"></i></span></td>
												@endif
											<td>
											<a  title="Fees details" class="btn btn-xs btn-outline-primary" href="{{ route('admin.masterdata.academicFees', ['selectedSessionId' => $arr_session['id']]) }}"><i class="fas fa-eye"></i> View</a>
											</td>
										</tr>
									@endforeach
									
								</tbody>
							</table>
						</div>
					</div>
				</div>


				<div class="col-md-9">
					<div class="card  card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title "><span class="text-primary">Academic Fees for - </span><span class="badge bg-primary">{{$selected_academic_session_details['session_name']}}</span> </h3>
						</div>
						<div class="card-body ">
						
						
							<table class="table table-sm">
								<thead>
									<tr>
										<th>Class</th>	
										<th>Fees</th>								
										<th class="float-right">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($arr_class_fees as $class_fees)	
										<tr>
											<td>{{$class_fees['class_roman_name']}}</td>
											<td>
												@if(!empty($class_fees['academic_fee']))	
													@foreach($class_fees['academic_fee'] as $academic_fee)
														<span class="badge bg-primary">
															{{$academic_fee['fees_master']['fees_name']}}
															(₹ {{$academic_fee['total_fees_amount']}})
														</span>
												
													@endforeach
												@else
													<span class="badge bg-danger">
														No fees is assigned
													</span>
												@endif
											</td>
											<td>
											<a  data-toggle="modal" data-target="#myModal"  class="btn float-right btn-sm btn-outline-primary" href="{{ route('admin.masterdata.assignClassFees',['academicSessionId' => $selected_academic_session_details['id'],'classId'=>$class_fees['id']]) }}"><i class="fas fa-link"></i> Assign Fees</a>
												
											</td>
										</tr>
									@endforeach
									
								</tbody>
							</table>
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
      $('.modal-content').load(targetUrl);
    });
})
</script>
@endsection