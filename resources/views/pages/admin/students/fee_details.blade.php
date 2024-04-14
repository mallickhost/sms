@extends('layouts.admin')
@section('title', 'Students Fees')
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
					

                        @if(empty($academics['student']['picture']))
                          @if($academics['student']['gender'] == 'MALE')
                          @php
                            $profile_img = 'assets/img/m_profile_pic.png';
                          @endphp
                          @elseif($academics['student']['gender']=="FEMALE")
                          @php
                            $profile_img = 'assets/img/f_profile_pic.png';
                          @endphp
                          @endif

                        @else
                          @php
                            $profile_img = 'storage/'.$academics['student']['picture'];
                          @endphp
                          
                        @endif	

						<img class="profile-user-img img-fluid img-circle"
						src="{{asset($profile_img)}}"
							alt="User profile picture">
						</div>

						<h3 class="profile-username text-center">{{$academics['student']['student_name']}}</h3>

						<p class="text-muted text-center">{{$academics['student']['student_number']}}</p>

						
						
						<ul class="list-group list-group-unbordered mb-0">
						<li class="list-group-item" style="padding: 5px;">
							<b>Class</b> <a class="float-right">{{$academics['class']['class_roman_name']}}</a>
						</li>
						<li class="list-group-item" style="padding: 5px;">
							<b>section</b> <a class="float-right">{{$academics['section']['name']}}</a>
						</li>
						<li class="list-group-item" style="padding: 5px;">
							<b>Roll No</b> <a class="float-right">{{$academics['roll_number']}}</a>
						</li>
					
						</ul>
						<br>

						
						<a  href="{{ route('admin.students.assignFees', ['studentId' => $academics['student_id'],'sessionId' => $arr_academic_session['id']]) }}" class="btn btn-block btn-outline-primary"><i class="fas fa-rupee-sign"></i> Assign new fees</a>
						
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
					M: {{$academics['student']['mother_name']}} <br> F: {{$academics['student']['father_name']}}
					</p>
					<hr>
					<strong><i class="fas fa-phone-alt"></i> Contact Number</strong>
					<p class="text-muted">
					{{$academics['student']['mobile_no_1']}}<br>{{$academics['student']['mobile_no_2']}}
					</p>
					<hr>

					<strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
					<p class="text-muted">{{$academics['student']['address']}}</p>
					
				</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
				</div>
				<div class="col-md-9">
                
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title text-primary">Fees Breakups for session - {{$arr_academic_session['session_name']}}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.students.details',$academics['student']['id']) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-chevron-left"></i> Back</a>
                    </div>
                  </div>
				 
                    <div class="card-body ">
				        	@if(!empty($arr_fees_data))
                 	 <form action="{{ route('admin.students.paymentDetails') }}" method="POST">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>  
                              <th>Fee Name</th>
                              <th>Month</th>
                              <th class="text-right">Total</th>
                              <th class="text-right">Paid</th>
                              <th class="text-right">Remaining</th>
                              <th class="text-center">Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($arr_fees_data as $fee_data)
                        
                            @if($fee_data['payment_status'] == "FULL_PAID")
                            <tr class="table-primary">
                            @elseif($fee_data['payment_status']=='PARTIALY')
                            <tr class="table-warning">
                            @else
                            <tr>
                            @endif
                              <td>
                                <div class="form-check">
                                @if($fee_data['payment_status']=='PARTIALY' || $fee_data['payment_status']=='NOT_PAID' )
                                  <input type="checkbox" name="payment_for[{{$fee_data['id']}}]" class="form-check-input" >
                                @else
                                <input type="checkbox" disabled checked class="form-check-input" >
                                @endif
                                 
                                </div>
                              </td>   
                              <td>{{$fee_data['academic_fees']['fees_master']['fees_name']}}</td>
                              <td>{{$fee_data['month_name']}}</td>
                              <td class="text-right">₹{{number_format($fee_data['total_amount'],2)}}</td>
                              <td class="text-right">₹{{number_format($fee_data['paid_amount'],2)}}</td>
                              <td class="text-right">₹{{number_format($fee_data['total_amount'] - $fee_data['paid_amount'],2)}}</td>
                              <td class="text-center">
                              
                                  @if($fee_data['payment_status'] == "FULL_PAID")
                                  <span class="badge bg-success">Paid</span>
                                  @elseif($fee_data['payment_status']=='PARTIALY')
                                   <span class="badge bg-warning">Partially</span>
                                  @else
                                  <span class="badge bg-danger">Not Paid</span>
                                  @endif
                               
                                
                              </td>
                              <td> 
                                @if($fee_data['payment_status'] == "FULL_PAID" || $fee_data['payment_status']=='PARTIALY'  )
                                  <button class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></button> 
                                 
                                  @endif
                                                          
                               
                              </td>
                              
                            </tr>

                            
                            @endforeach
                            
                            
                            <tr>
                              <td colspan="8">
                                <input type='hidden' name="student_id" value="{{$academics['student']['id']}}" >
                                <input type='hidden' name="academic_session_id" value="{{$arr_academic_session['id']}}" >
                                <button type='submit' class="btn btn-outline-primary"><i class="far fa-check-square"></i> Paid Checked</button>
                                <!-- <button class="btn btn-sm btn-info"><i class="fas fa-download"></i> Download all paid receipt</button> -->
                              </td>
                            </tr>
                            
                          </tbody>
                        </table>   
						</form>  
						
						@else
            No fee is assign to this student please assign fees !
							@endif
						
                    </div>
                 
				
                </div>
               
              </div>
       		</div>
            

          
        
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

