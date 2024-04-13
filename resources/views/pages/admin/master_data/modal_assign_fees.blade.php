<form action="{{ route('admin.masterdata.saveClassFees') }}" method="POST" >
@csrf
    <div class="modal-header">
        <h4 class="modal-title">Class Fees Amount <span class="badge bg-secondary">{{$arr_session['session_name']}}</span> <span class="badge bg-secondary">Class: {{$arr_class['class_roman_name']}}</span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
		<input type="hidden" name="academic_session_id" value="{{$arr_session['id']}}" />
		<input type="hidden" name="class_master_id" value="{{$arr_class['id']}}" />

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
                    <p>{{$master_fee['fees_name']}}</p>
                </div>
                <div class="col-3">
                    <p>{{$master_fee['payment_type']}}</p>
                </div>
                <div class="col-3">
                    <p>{{$master_fee['no_of_payments_in_a_year']}}</p>
                </div>
                <div class="col-3">

                    	@php 
                    		$amount = '0';
						@endphp
						@if(!empty($arr_current_fess))
							@foreach($arr_current_fess as $current_fees)
								@if($current_fees['fees_master_id'] == $master_fee['id'])
									@php 
										$amount = $current_fees['total_fees_amount'];
										break;
									@endphp
								@endif
							@endforeach
						@endif
                    
                    <input type="text" class="form-control" value="{{$amount}}"  name="fee_amount[{{$master_fee['id']}}]">
                </div>
            </div>
        @endforeach
            
    
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="submit" class="btn btn-outline-primary"><i class="far fa-save"></i> Save changes</button>
    </div>

</form>
