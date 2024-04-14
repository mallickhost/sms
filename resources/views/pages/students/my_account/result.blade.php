@extends('layouts.web')
@section('title', 'Home Page')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="starter-template">
    <br/><br/><br/>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
              Student info
            </div>

            <div class="col-md-6">
                Student Action
            </div>
        </div>
        <br>

    </div>
</div>



@endsection


@section('scripts')
<script>

$(document).ready(function(){
    // $('#xx').on('click',function(){
    //     $("#addModal").modal('show');
    // });
})
</script>
@endsection