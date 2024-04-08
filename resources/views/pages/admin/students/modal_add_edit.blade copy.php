<div class="modal fade" id="studentAddEdit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add/Edit Student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.students.saveStudent') }}" method="POST" id='frmLogin'>
            @csrf
                <div class="modal-body">            
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                <label>Student Name</label>
                                <input type="text" class="form-control" name='student_name'>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Student Number</label>
                                <input type="text" class="form-control" name='student_number'>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Adhaar Number</label>
                                <input type="text" class="form-control" name='aadhaar_number' >
                                </div>
                            </div>
                        
                        </div>


                        <div class="row">        
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control"  name='dob' >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control"  name='gender' >
                                    <option>Male</option>
                                    <option>Female</option>
                                </select></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control"  name='mobile_no_1'  >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Alt Mobile Number</label>
                                <input type="text" class="form-control" name='mobile_no_2' >
                                </div>
                            </div>
                            
                        </div>
                        

                        <div class="row">                        
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>Father's Name</label>
                                <input type="text" class="form-control"  name='father_name'  >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                <label>Mother's Name</label>
                                <input type="text" class="form-control"  name='mother_name' >
                                </div>
                            </div>
                            
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="3"  name='address' ></textarea>
                                </div>
                            </div>
                        
                        </div>


                        
                
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>