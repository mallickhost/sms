@extends('layouts.web')
@section('title', 'Home Page')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="starter-template">
    <br/><br/><br/>
    <img src="{{asset('assets/img/web/home_page_banner1.jpg')}}" alt=""  width="100%">
    <h1 class='text-danger'>Guma Juliant KG School</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
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