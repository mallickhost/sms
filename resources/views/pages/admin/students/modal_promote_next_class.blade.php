

@if (isset( $studentData['id'] ))
    <form action="{{ route('admin.students.updateStudent') }}" method="POST" id='frm_save_student' enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{ route('admin.students.saveStudent') }}" method="POST" id='frm_save_student'  enctype="multipart/form-data">
@endif

@csrf
<div class="modal-header">
    <h4 class="modal-title">
       Promot to next class
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">            
		<div class="row">
			<div class="col-sm-6">
				<!-- text input -->
				<div class="form-group">
				<label>Student Name</label>
				<input type="text" class="form-control" value="{{ old('student_name', $studentData['student_name'] ?? '') }}" name='student_name'>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
				<label>Student Number</label>
				<input type="text" class="form-control" value="{{ old('student_number', $studentData['student_number'] ?? '') }}" name='student_number'>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
				<label>Adhaar Number</label>
				<input type="text" class="form-control" value="{{ old('aadhaar_number', $studentData['aadhaar_number'] ?? '') }}" name='aadhaar_number' >
				</div>
			</div>
		
		</div>



		<input type="hidden"  value="{{ old('id', $studentData['id'] ?? '') }}" name='student_id' >
		

</div>
<div class="modal-footer justify-content-between">
	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-success">Save</button>
</div>
</form>
