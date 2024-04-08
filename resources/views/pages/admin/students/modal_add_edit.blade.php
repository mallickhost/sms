

@if (isset( $studentData['id'] ))
    <form action="{{ route('admin.students.updateStudent') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{ route('admin.students.saveStudent') }}" method="POST" enctype="multipart/form-data">
@endif

@csrf
<div class="modal-header">
    <h4 class="modal-title">
        @if (isset( $studentData['id'] ))
            Edit
        @else
            Add New
        @endif
        
        Student
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


		<div class="row">        
			<div class="col-sm-3">
				<div class="form-group">
				<label>Date of Birth</label>
				<input type="date" class="form-control" value="{{ old('dob', $studentData['dob'] ?? '') }}"  name='dob' >
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
				<label>Gender</label>
				<select class="form-control"   name='gender' >
					<option>Male</option>
					<option>Female</option>
				</select></div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
				<label>Mobile Number</label>
				<input type="text" class="form-control" value="{{ old('mobile_no_1', $studentData['mobile_no_1'] ?? '') }}"  name='mobile_no_1'  >
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
				<label>Alt Mobile Number</label>
				<input type="text" class="form-control" value="{{ old('mobile_no_2', $studentData['mobile_no_2'] ?? '') }}" name='mobile_no_2' >
				</div>
			</div>
			
		</div>
		<div class="row">        
			<div class="col-sm-3">
				<div class="form-group">
				<label>Academic Session</label>
				<input type="date" class="form-control" value="{{ old('dob', $studentData['dob'] ?? '') }}"  name='dob' >
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
				<label>Class</label>
				<select class="form-control"   name='gender' >
					<option>Male</option>
					<option>Female</option>
				</select></div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
				<label>Section</label>
				<input type="text" class="form-control" value="{{ old('mobile_no_1', $studentData['mobile_no_1'] ?? '') }}"  name='mobile_no_1'  >
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
				<label>Alt Mobile Number</label>
				<input type="text" class="form-control" value="{{ old('mobile_no_2', $studentData['mobile_no_2'] ?? '') }}" name='mobile_no_2' >
				</div>
			</div>
			
		</div>
		

		<div class="row">                        
			<div class="col-sm-6">
				<div class="form-group">
				<label>Father's Name</label>
				<input type="text" class="form-control" value="{{ old('father_name', $studentData['father_name'] ?? '') }}"  name='father_name'  >
				</div>
			</div>
			<div class="col-sm-6">
				<!-- text input -->
				<div class="form-group">
				<label>Mother's Name</label>
				<input type="text" class="form-control" value="{{ old('mother_name', $studentData['mother_name'] ?? '') }}"  name='mother_name' >
				</div>
			</div>
			
		</div>


		<div class="row">
			<div class="col-sm-12">
				<!-- textarea -->
				<div class="form-group">
				<label>Address</label>
				<textarea class="form-control" rows="3" value="{{ old('address', $studentData['address'] ?? '') }}"  name='address' ></textarea>
				</div>
			</div>
		
		</div>

		<input type="text"  value="{{ old('id', $studentData['id'] ?? '') }}" name='student_id' >
		

</div>
<div class="modal-footer justify-content-between">
	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-success">Save</button>
</div>
</form>
        