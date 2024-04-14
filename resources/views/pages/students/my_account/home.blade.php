@extends('layouts.web')
@section('title', 'Home Page')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="starter-template">
    <br/><br/><br/>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                        <br/>
                        <a href="#" class="card-link">Another link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
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