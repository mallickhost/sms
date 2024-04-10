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
                      <img class="profile-user-img img-fluid img-circle"
                          src="{{asset('assets/img/avatar-b.png')}}"
                          alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$student_data['student']['student_name']}}</h3>

                    <p class="text-muted text-center">{{$student_data['student']['student_number']}}</p>
                    <a  href="{{ route('admin.students.assignFees', ['studentId' => $student_data['student']['id']]) }}" class="btn btn-block btn-success">Assign fees</a>
                    <ul class="list-group list-group-unbordered mb-0">
                      <li class="list-group-item">
                        <b>Class</b> <a class="float-right">{{$student_data['class']['class_roman_name']}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>section</b> <a class="float-right">{{$student_data['section']['name']}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Roll No</b> <a class="float-right">{{$student_data['roll_number']}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Gender</b> <a class="float-right">{{$student_data['student']['gender']}}</a>
                      </li>
                    </ul>

                  
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
                    M: Rupali Dhar <br> F: Sankar Dhar
                    </p>
                    <hr>
                    <strong><i class="fas fa-phone-alt"></i> Contact Number</strong>
                    <p class="text-muted">
                    7654567876 <br> 9986655644
                    </p>
                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                    <p class="text-muted">Sukanta Pally, Guma</p>
                 
                </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title text-danger">Tuition Fees</h3>
                    <div class="card-tools">
                        <!-- <a href="{{ route('admin.students.list') }}" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i> Back</a> -->
                    </div>
                  </div>
                  <form action="{{ route('admin.students.paymentDetails') }}" method="POST">
                    <div class="card-body p-0">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>  
                              <th>Fee Name</th>
                              <th>Month</th>
                              <th>Total Amount</th>
                              <th>Paid Amount</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($arr_fees_data as $fee_data)
                        
                            <tr>
                              <td>
                                <div class="form-check">
                                  <input type="checkbox" name="payment_for[{{$fee_data['id']}}]" class="form-check-input" >
                                </div>
                              </td>   
                              <td>{{$fee_data['academic_fees']['fees_master']['fees_name']}}</td>
                              <td>{{$fee_data['month_name']}}</td>
                              <td>Manual</td>
                              <td>{{$fee_data['total_amount']}}</td>
                              <td>Paid </td>
                              <td> 
                                <button class="btn btn-sm btn-primary "><i class="fas fa-rupee-sign"></i></button>
                                <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>                              
                                <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                              </td>
                              
                            </tr>

                            <tr>
                            @endforeach
                            
                            
                            <tr>
                              <td colspan="7">
                                <input type='hidden' name="student_id" value="{{$student_data['student']['id']}}" >
                                <button type='submit' class="btn btn-success btn-sm">Paid Checked</button>
                              </td>
                            </tr>
                            
                          </tbody>
                        </table>          
                    </div>
                  </form>
                </div>

              </div>
              <!-- /.col -->
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

