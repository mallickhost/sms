<form action="{{ route('admin.students.paymentDetails') }}" method="POST">

@csrf
<div class="modal-header">
    <h4 class="modal-title">
      Assigned fees to the student
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">            
	<div class="row">
	<div class="col-md-12">
                @if(!empty($arr_fees_data))
                <div class="card">
                 
                 
                    <div class="card-body p-0">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>  
                              <th>Fee Name</th>
                              <th>Month</th>
                              <th class="text-right">Total</th>
                              <th class="text-right">Paid</th>
                              <th class="text-right">Remaining</th>
                              <th class="text-center">Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($arr_fees_data as $fee_data)
                        
                            <tr>
                              <td>
                                <div class="form-check">
                                @if($fee_data['payment_status']=='PARTIALY' || $fee_data['payment_status']=='NOT_PAID' )
                                  <input type="checkbox" name="payment_for[{{$fee_data['id']}}]" class="form-check-input" >
                                @else
                                <input type="checkbox" checked disabled class="form-check-input" >
                                @endif
                                 
                                </div>
                              </td>   
                              <td>{{$fee_data['academic_fees']['fees_master']['fees_name']}}</td>
                              <td>{{$fee_data['month_name']}}</td>
                              <td class="text-right">₹{{number_format($fee_data['total_amount'],2)}}</td>
                              <td class="text-right">₹{{number_format($fee_data['paid_amount'],2)}}</td>
                              <td class="text-right">₹{{number_format($fee_data['total_amount'] - $fee_data['paid_amount'],2)}}</td>
                              <td class="text-center">
                              
                                  @if($fee_data['payment_status'] == "FULL_PAID")
                                  <span class="badge bg-success">Paid</span>
                                  @elseif($fee_data['payment_status']=='PARTIALY')
                                   <span class="badge bg-warning">Partially</span>
                                  @else
                                  <span class="badge bg-danger">Not Paid</span>
                                  @endif
                               
                                
                              </td>
                              <td> 
                                @if($fee_data['payment_status'] == "FULL_PAID" || $fee_data['payment_status']=='PARTIALY'  )
                                  <button class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></button> 
                                 
                                  @endif
                                                          
                               
                              </td>
                              
                            </tr>

                            
                            @endforeach
                            
                          
                            
                          </tbody>
                        </table>          
                    </div>
      
                </div>
                @else

					<div class="callout callout-danger">
						<h5>No fees is assign please click on assign fees button </h5>
						<a  href="{{ route('admin.students.assignFees', ['studentId' => $student_data['id']]) }}" class="btn btn-block btn-success">Assign fees</a>
					
					</div>
                	
					
                @endif
              </div>
	
	</div>


</div>
<div class="modal-footer justify-content-between">
	<button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
	@if(!empty($arr_fees_data))
	<button type="submit" class="btn btn-outline-primary"><i class="far fa-check-square"></i> Paid Checked</button>
	@endif
</div>
</form>
