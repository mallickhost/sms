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
			<form action="{{ route('admin.students.makePayment') }}" method="POST" >
				<div class="row">
				<div class="col-md-12">

				<div class="invoice p-3 mb-3">
					<!-- title row -->
					<div class="row">
					<div class="col-12">
						<h4>
						<input type="hidden" name="student_id" value="{{$current_academic['student']['id']}}" >
						<i class="fas fa-user-graduate"></i> {{$current_academic['student']['student_name']}}
						<!-- <small class="float-right">Date: {{ date('d-m-Y') }}</small> -->
						</h4>
					</div>
					<!-- /.col -->
					</div>
					<!-- info row -->
					<div class="row invoice-info">
					<div class="col-sm-3 invoice-col">
						Academic
						<address>
						<strong>Class:  {{$current_academic['class']['class_roman_name']}}</strong><br>
						Roll:  {{$current_academic['roll_number']}} , {{$current_academic['section']['name']}}<br>
						Student Number:  {{$current_academic['student']['student_number']}}<br>
						</address>
					</div>
					<!-- /.col -->
					<div class="col-sm-3 invoice-col">
						Personal
						<address>
						<strong>Father:  {{$current_academic['student']['father_name']}}</strong><br>
						Mobile No:  {{$current_academic['student']['mobile_no_1']}}<br>
						Alt Mobie No:  {{$current_academic['student']['mobile_no_2']}}<br>
						</address>
					</div>
					<!-- /.col -->
					<div class="col-sm-6 invoice-col">
						<div class="row">
							<div class="col-4">
								<div class="form-group">
									<label>Payment Date</label>
									<input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" >
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Payment Mode</label>
									<select class="form-control" name="payment_mode">
									<option value="CASH">Cash</option>
									<option value="ONLINE">Online</option>
									</select>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Transaction Number</label>
									<input type="text" name="transaction_nubmer" class="form-control" >
								</div>
							</div>
						</div>                                                          
					</div>
					<!-- /.col -->
					</div>
					<!-- /.row -->

					<!-- Table row -->
					<div class="row">
					<div class="col-12 table-responsive">
						<table class="table table-striped">
							<thead>
							<tr>
								<th>Fee Name</th>
								<th>Month for</th>
								<th>Total Amount</th>
								<th>Total Paid Amount</th>
								<th>Remaining Amount</th>
							</tr>
							</thead>
							<tbody>
							@php
								$total_amount = 0;
							@endphp
							@foreach ($arr_fees as $fee_data)
								<tr>
									<td>{{$fee_data['academic_fees']['fees_master']['fees_name']}}</td>
									<td>{{$fee_data['month_name']}}</td>
									<td>₹{{number_format($fee_data['total_amount'],2)}}</td>
									<td>₹{{number_format($fee_data['paid_amount'],2)}}</td>
									<td>
									@php
									$total_amount += $fee_data['total_amount']-$fee_data['paid_amount'];
									@endphp
										<input type="number" min="1" max="{{$fee_data['total_amount']-$fee_data['paid_amount']}}" class="paid_amt" name="paid_amount[{{$fee_data['id']}}]" value="{{$fee_data['total_amount']-$fee_data['paid_amount']}}">
									</td>
								</tr>
								
							@endforeach
							
							</tbody>
						</table>
					</div>
					<!-- /.col -->
					</div>
					<!-- /.row -->

					<div class="row">
					
					<!-- /.col -->
					<div class=" col-md-6">
						<div class="form-group">
							<label >Note</label>
							<textarea class="form-control" rows="3"  name='transaction_note' ></textarea>
						</div>
					</div>
					<div class="col-md-6  ">
						<div class="table-responsive">
						<table class="table">
							<tr>
								<th style="width:50%">Total:</th>
								<td>₹<span id="total_amt">{{$total_amount}}</span></td>
							</tr>
							<tr>
								
								<td colspan="2">
									<button type="submit" class="btn btn-success float-right"><i class="fas fa-rupee-sign"></i>
										Make Payment
									</button>
								</td>
							</tr>
						</table>
						</div>
					</div>
					<!-- /.col -->
					</div>
					<!-- /.row -->

					<!-- this row will not appear when printing -->
					
					</div>
					</div>
	
				</div>
			</form>
       
        </div>
            
    </section>
</div>


    <!-- /.content-wrapper -->
@endsection


@section('scripts')
<script>

$(document).ready(function(){

	$('.paid_amt').keyup(function(){
		var total = 0;
		$('.paid_amt').each(function(){
			total += parseFloat($(this).val()) || 0;
		});
		$('#total_amt').text(total);
	});
})
</script>
@endsection

