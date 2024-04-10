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
               

				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title text-primary">Academic Fees</h3>
						</div>
						<div class="card-body ">

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Academic Session</label>
										<select class="form-control"  name='academic_session_id' >
											@foreach($arr_session as $session)							
												<option value="{{$session->id}}" >{{$session->session_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<br>
										<a  data-toggle="modal" data-target="#myModal"  class="btn  btn-primary" href="{{ route('admin.masterdata.assignClassFees') }}"><i class="fas fa-plus"></i> Assign Fees to Class</a>
        
									</div>
								</div>
							</div>
						
							<table class="table table-sm">
								<thead>
									<tr>
										<th>Class</th>	
										<th>Fees</th>								
										<th>Action</th>
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
												<a href="#"  class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignFees">
												<i class="fas fa-link"></i>
												</button>
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