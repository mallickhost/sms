@extends('layouts.web')
@section('title', 'Home Page')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="starter-template">
    <br/><br/><br/>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <img src="{{asset('assets/img/web/contact_us.png')}}" class="img-fluid" alt="Responsive image">
            </div>

            <div class="col-md-6">
                <form action='#'>
                    <div class="mb-3">
                            <label for="contact_us_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="contact_us_name" placeholder="Your full Name">
                    </div>
                    <div class="mb-3">
                            <label for="contact_us_phone" class="form-label">Phone No.</label>
                            <input type="text" class="form-control" id="contact_us_phone" placeholder="Your mobile no">
                    </div>
                    <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                            <label for="contact_us_message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="contact_us_message" rows="3"></textarea>
                    </div>
                    <div class="mb-12">
                        <button class="btn btn-flat btn-block btn-primary">Contact Us</button>        
                    </div>

                </form>
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