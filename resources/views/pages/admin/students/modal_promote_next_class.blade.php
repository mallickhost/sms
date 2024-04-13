

    <form action="{{ route('admin.students.updateAcademicDetails') }}" method="POST" id='frm_save_student'  enctype="multipart/form-data">

@csrf
<div class="modal-header">
    <h4 class="modal-title">
       Promote to class
    </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">  
	
	@if(!empty($arr_student['academic_details']))
	<div class="callout callout-danger">
		<h5>Student has running class </h5>
		<p>Please pass the student current stuying class - <b class="text-danger">{{$arr_student['academic_details'][0]['class']['class_roman_name']}}</b></p>
	</div>

	@else

	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label>Academic Session</label>
				<select class="form-control" name='academic_session_id' >
				@foreach($arr_session as $session)							
					<option value="{{$session['id']}}" >{{$session['session_name']}}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="form-group">
				<label>Class</label>
				<select class="form-control" name='class_master_id' >
					@foreach($arr_class as $class)							
					<option value="{{$class['id']}}" >{{$class['class_roman_name']}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="form-group">
				<label>Section</label>
				<select class="form-control" name='section_id' >
				@foreach($arr_section as $section)							
					<option value="{{$section['id']}}" >{{$section['name']}}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="form-group">
				<label>Roll Number</label>
				<input type="number" class="form-control" name='roll_number' min="1" max="100">
			</div>
		</div>

	

	</div>
	

	<input type="hidden"  value="{{ $arr_student['id']}}" name='student_id' >
	@endif


		

</div>
<div class="modal-footer justify-content-between">
	<button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
	@if(empty($arr_student['academic_details']))
	<button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i>Save</button>
	@endif
</div>
</form>
