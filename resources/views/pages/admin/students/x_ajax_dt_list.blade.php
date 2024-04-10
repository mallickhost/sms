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
                        <h1>Staff management</h1>
                    </div>
                    <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          {{ $consumerInfo['attributes']['gender']== 'Man'? 'checked="checked"' : '' }}
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div> -->
                </div>
            </div><!-- /.container-fluid -->
        </section>

       <!-- Main content -->
    <section class="content">

        <div class="container-fluid">

            @include('includes.flash')

            <div class="row">
              <div class="col-12">
                <div class="card">
                 
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                  <table class="table table-head-fixed text-nowrap" id='client_list'>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Telephone</th>
                      </tr>
                    </thead>
                  
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
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
    $('#client_list').DataTable({
      processing: true,
         serverSide: true,
         ajax: "http://127.0.0.1:8000/api/ajax/client-list",
       
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'telephone' }
        ],
        processing: true,
        serverSide: true
    });
})
</script>
@endsection