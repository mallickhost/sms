@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Fees Structure</h1>
                </div>                
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">

            @include('includes.flash')

            <div class="row">
                <div class="col-md-6">
             	 <!-- -----------------------   -->
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Condensed Full Width Table</h3>
						</div>
						<div class="card-body p-0">
							<table class="table table-sm">
								<thead>
									<tr>
										<th style="width: 10px">#</th>
										<th>Fees Name</th>
										<th>Fee type</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1.</td>
										<td>Tuition Fees</td>
										<td>Monthly<td>
										<td>
											<button class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></button>
										</td>
									</tr>
									<tr>
										<td>2.</td>
										<td>Admission Fees</td>
										<td>Yearly<td>
										<td>
											<button class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></button>
										</td>
									</tr>
									<tr>
										<td>3.</td>
										<td>Examination Fees</td>
										<td>Quaterly<td>
										<td>
											<button class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></button>
										</td>
									</tr>
									<tr>
										<td>4.</td>
										<td>Session charges</td>
										<td>Yearly<td>
										<td>
											<button class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></button>
										</td>
									</tr>
									
								</tbody>
							</table>
							<br>
							<div class="container">
								<div class="row">
								<div class="col-md-6">
										<div class="input-group mb-3">
										
										<select class="form-control">
											<option>Fees Type</option>
											<option>Monthly(12)</option>
											<option>Yearly(1)</option>
											<option>Quaterly(3)</option>
											<option>Half Yearly(2)</option>
										</select>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="input-group mb-3">
											<input type="text" class="form-control">
											<div class="input-group-append">
												<button class=" btn btn-success">
												<i class="fas fa-save"></i>
												</button>
											</div>
										</div>	
									</div>
								</div>
							</div>
							

							<!-- ----------- -->
						</div>
					</div>
                
					<!-- ------------------ -->
                </div>

				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title text-primary">Assign Fees for class</h3>
						</div>
						<div class="card-body ">
							<table class="table table-sm">
								<thead>
									<tr>
										<th>Class</th>	
										<th>Fees</th>								
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>I</td>
										<td>Tuition, Admission, Examination </td>
										<td>
											<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignFees">
											<i class="fas fa-link"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>II</td>
										<td>Tuition, Admission, Examination,Session </td>
										<td>
											<button class="btn btn-sm btn-primary" title="Download Result">
												<i class="fas fa-link"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>III</td>
										<td>Tuition, Admission, Examination,Session </td>
										<td>
											<button class="btn btn-sm btn-primary" title="Download Result">
												<i class="fas fa-link"></i>
											</button>
										</td>
									</tr>
									<tr>
										<td>IV</td>
										<td>Tuition, Admission, Examination,Session </td>
										<td>
											<button class="btn btn-sm btn-primary" title="Download Result">
												<i class="fas fa-link"></i>
											</button>
										</td>
									</tr>
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