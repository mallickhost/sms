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
									@foreach($arr_class as $class)	
										<tr>
											<td>{{$class->class_roman_name}}</td>
											<td>Tuition, Admission, Examination </td>
											<td>
												<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignFees">
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

@include('pages.admin.master_data.modal_assign_fees')

@endsection

@section('scripts')
<script>

$(document).ready(function(){
  
})
</script>
@endsection