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

                    <h3 class="profile-username text-center">Sammya Sen Chowdhury</h3>

                    <p class="text-muted text-center">S123445</p>
                    <a  href="{{ route('admin.students.assignFees', ['studentId' => 5]) }}" class="btn btn-block btn-success">Assign fees</a>
                    <ul class="list-group list-group-unbordered mb-0">
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
                        <b>Gender</b> <a class="float-right">Male</a>
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

                  <div class="card-body p-0">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 10px">#</th>
                            <th>Month</th>
                            <th>Payment Date</th>
                            <th>Payment Mode</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" checked disabled>
                              </div>
                            </td>
                            <td>1.</td>                           
                            <td>January</td>
                            <td>24-jan-2024</td>
                            <td>Manual</td>
                            <td>200</td>
                            <td>Paid </td>
                            <td> 
                              <button class="btn btn-sm btn-primary disabled"><i class="fas fa-rupee-sign"></i></button>
                              <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>                              
                              <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                            </td>
                            
                          </tr>

                          <tr>
                          <td>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" checked disabled>
                              </div>
                            </td>
                            <td>2.</td>
                            <td>February</td>
                            <td>22-Feb-2024</td>
                            <td>Manual</td>
                            <td>200</td>
                            <td>Paid </td>
                            <td> 
                              <button class="btn btn-sm btn-primary disabled"><i class="fas fa-rupee-sign"></i></button>
                              <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                              <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button></td>
                          </tr>

                          <tr>
                          <td>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" checked disabled>
                              </div>
                            </td>
                            <td>3.</td>
                            <td>March</td>
                            <td>13-Mar-2024</td>
                            <td>Online</td>
                            <td>200</td>
                            <td>Paid </td>
                            <td> 
                              <button class="btn btn-sm btn-primary disabled"><i class="fas fa-rupee-sign"></i></button>
                              <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                              <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                            </td>
                          </tr>
                          <tr>
                          <td>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" >
                              </div>
                            </td>
                            <td>4.</td>
                            <td>April</td>
                            <td></td>
                            <td></td>
                            <td>200</td>
                            <td>Unpaid </td>
                            <td> 
                              <button class="btn btn-sm btn-primary"><i class="fas fa-rupee-sign"></i></button>
                              <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                              <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                            </td>
                          </tr>
                          <tr>
                          <td>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" >
                              </div>
                            </td>
                            <td>5.</td>
                            <td>May</td>
                            <td></td>
                            <td></td>
                            <td>200</td>
                            <td>Unpaid </td>
                            <td> 
                              <button class="btn btn-sm btn-primary"><i class="fas fa-rupee-sign"></i></button>
                              <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                              <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                            </td>
                          </tr>
                          <tr>
                          <td>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" >
                              </div>
                            </td>
                            <td>6.</td>
                            <td>June</td>
                            <td></td>
                            <td></td>
                            <td>200</td>
                            <td>Unpaid </td>
                            <td> 
                              <button class="btn btn-sm btn-primary"><i class="fas fa-rupee-sign"></i></button>
                              <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                              <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="7">
                              <button class="btn btn-success btn-sm">Paid Checked</button>
                            </td>
                          </tr>
                          
                        </tbody>
                      </table>          
                  </div>

                </div>


                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title text-primary">One time Fees</h3>
                    
                  </div>

                  <div class="card-body p-0">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Fee Name</th>
                            <th>Payment Date</th>
                            <th>Payment Mode</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1.</td>
                            <td>Exam Fee</td>
                            <td>24-jan-2024</td>
                            <td>Manual</td>
                            <td>260</td>
                            <td>Paid </td>
                            <td> 
                              <button class="btn btn-sm btn-primary disabled"><i class="fas fa-rupee-sign"></i></button>
                              <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                              <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                              
                            </td>
                            
                          </tr>

                          <tr>
                            <td>2.</td>
                            <td>Admission Fees</td>
                            <td>22-Feb-2024</td>
                            <td>Manual</td>
                            <td>500</td>
                            <td>Paid </td>
                            <td> 
                              <button class="btn btn-sm btn-primary disabled"><i class="fas fa-rupee-sign"></i></button>
                              <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                              <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                            </td>
                          </tr>

                          <tr>
                            <td>3.</td>
                            <td>Other Fee</td>
                            <td></td>
                            <td></td>
                            <td>0</td>
                            <td></td>
                            <td> 
                              <button class="btn btn-sm btn-primary disabled"><i class="fas fa-rupee-sign"></i></button>
                              <button class="btn btn-sm btn-success"><i class="fas fa-eye"></i></button>
                              <button class="btn btn-sm btn-info"><i class="fas fa-download"></i></button>
                            </td>
                          </tr>
                          
                          
                        </tbody>
                      </table>          
                  </div>

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

