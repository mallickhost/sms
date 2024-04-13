


<form action="{{ route('admin.students.updateAcademicDetails') }}" method="POST">

@csrf
<div class="modal-header">
    <h4 class="modal-title">
       Edit Academic Details
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">            
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label>Academic Session</label>
				<select class="form-control" name='academic_session_id' readonly >
				@foreach($arr_session as $session)							
					<option value="{{$session['id']}}" {{ $session['id'] == $obj_student_academic->academic_session_id ? 'selected' : '' }} >{{$session['session_name']}}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Class</label>
				<select class="form-control" name='class_master_id' >
					@foreach($arr_class as $class)							
					<option value="{{$class['id']}}" {{ $class['id'] == $obj_student_academic->class_master_id ? 'selected' : '' }}>{{$class['class_roman_name']}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>Section</label>
				<select class="form-control" name='section_id' >
				@foreach($arr_section as $section)							
					<option value="{{$section['id']}}" {{ $section['id'] == $obj_student_academic->section_id ? 'selected' : '' }}>{{$section['name']}}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
			<label>Roll No.</label>
			<input type="text" class="form-control" name='roll_number' min="1" max="100" value="{{ $obj_student_academic->roll_number }}" >
			</div>
		</div>
	
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<div class="custom-control custom-checkbox">
				<input class="custom-control-input custom-control-input-success" name='is_passed' type="checkbox" id="ck_passed" >
				<label for="ck_passed" class="custom-control-label">Pass this student for promot to next class</label>
				</div>
				
			</div>
		</div>
		
	
	</div>



<input type="hidden"  value="{{ $obj_student_academic->id }}" name='id' >
<input type="hidden"  value="{{ $obj_student_academic->student_id }}" name='student_id' >
		

</div>
<div class="modal-footer justify-content-between">
	<button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
	<button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> Save</button>
</div>
</form>
