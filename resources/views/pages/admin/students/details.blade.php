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

                    <h3 class="profile-username text-center">Koushani Sen Chowdhury</h3>

                    <p class="text-muted text-center">S123445</p>

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
                        <b>Gender</b> <a class="float-right">Female</a>
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
                      <h3 class="card-title text-danger">Academic Details</h3>
                      <div class="card-tools">
                          <!-- <a href="{{ route('admin.students.list') }}" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i> Back</a> -->
                      </div>
                    </div>

                    <div class="card-body">
                      <form>
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Academic Session</label>
                              <select class="form-control">
                                <option>--- Select ---</option>
                                <option>2023-2024</option>
                                <option>2022-2023</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Class</label>
                              <select class="form-control">
                                <option>Select</option>
                                <option>KG</option>
                                <option>I</option>
                                <option>II</option>
                                <option>III</option>
                                <option>IV</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Section</label>
                              <select class="form-control">
                                <option>Select</option>
                                <option>A</option>
                                <option>B</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Roll Number</label>
                              <input type="text" class="form-control" placeholder="Roll No">
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Student ID</label>
                              <input type="text" class="form-control" placeholder="Student ID">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-3 offset-sm-9">
                             <button type="button" class="btn btn-primary float-right">Save changes</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>


                 <div class="card">
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
                     
                  </div>

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title text-info">Academic History</h3>
                  </div>

                  <div class="card-body ">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th>Academic Session</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Roll No</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>                    
                            <td>2022-2023</td>
                            <td>III</td>
                            <td>B</td>
                            <td>23</td>
                          </tr>
                          <tr>                    
                            <td>2021-2022</td>
                            <td>II</td>
                            <td>A</td>
                            <td>17</td>
                          </tr>
                          <tr>                    
                            <td>2020-2021</td>
                            <td>I</td>
                            <td>B</td>
                            <td>14</td>
                          </tr>

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

@include('pages.admin.students.modal_add_edit')
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

