<form action="{{ route('admin.masterdata.saveClassFees') }}" method="POST" >
@csrf
    <div class="modal-header">
        <h4 class="modal-title">Assign Class Fees</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label>Academic Session</label>
                    <select class="form-control" name='academic_session_id' >
                    @foreach($arr_session as $session)							
                        <option value="{{$session->id}}" >{{$session->session_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Class</label>
                    <select class="form-control" name='class_master_id' >
                    @foreach($arr_class as $class)							
                        <option value="{{$class->id}}" >{{$class->class_roman_name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <!-- <div class="col-5">
                <input type="text" class="form-control" placeholder=".col-5">
            </div> -->
        </div>
        <hr>

        <div class="row">
            <div class="col-3">
                <b>Fees Name</b>
            </div>
            <div class="col-3">
                <b>Payment Type</b>
            </div>
            <div class="col-3">
                <b>No of Payments</b>
            </div>
            <div class="col-3">
                <b>Total Amount</b>
            </div>
        </div>
        <hr>
        @foreach($arr_fees_master as $master_fee)
            <div class="row">
                <div class="col-3">
                    <p>{{$master_fee->fees_name}}</p>
                </div>
                <div class="col-3">
                    <p>{{$master_fee->payment_type}}</p>
                </div>
                <div class="col-3">
                    <p>{{$master_fee->no_of_payments_in_a_year}}</p>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control"  name='amount[{{$master_fee->id}}]'>
                </div>
            </div>
        @endforeach
            
    
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>

</form>
