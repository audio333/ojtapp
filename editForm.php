	
<div class="panel-body none formData" id="editForm">
    <!-- <h2 id="actionLabel">Add User</h2> -->

    <form class="form" id="userForm" enctype="multipart/form-data" action="" method="POST">
        <div class="row form-group form-group-sm">

            <div class="col-md-9">

            	<div class="row">
            	<input type="hidden" class="form-control" name="id" id="idEdit"/>
	                <div class="form-group col-sm-1">
	                    <label for="id">ID</label>
	                    <input type="text" class="form-control" name="id" id="idEditText" disabled />
	                </div>
	                <div class="form-group col-sm-3 col-sm-offset-2">
	                    <label for="control">Control no.</label>
	                    <input type="text" class="form-control" name="control" id="controlEdit"/>
	                </div>
	                <div class="form-group col-sm-4 col-sm-offset-2">
	                    <label for="nickname">Nickname</label>
	                    <input type="text" class="form-control" name="nickname" id="nicknameEdit"/>
	                </div>
            	</div>

                <div class="form-group">
                    <label for="name">Complete Name</label>
                    <input type="text" class="form-control" name="name" id="nameEdit"/>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="addressEdit"/>
                </div>
                <div class="form-group">
                    <label for="school">School</label>
                    <input type="text" class="form-control" name="school" id="schoolEdit"/>
                </div>

				<div class="row">
	                <div class="form-group col-sm-3">
	                    <label for="gender">Gender</label>
	                    <input type="text" class="form-control" name="gender" id="genderEdit"/>
	                </div>
	                <div class="form-group col-sm-3">
	                    <label for="birthday">Birthday</label>
	                    <input type="text" class="form-control" name="birthday" id="birthdayEdit"/>
	                </div>
	                <div class="form-group col-sm-6">
	                    <label for="contact">Contact no.</label>
	                    <input type="text" class="form-control" name="contact" id="contactEdit"/>
	                </div>
				</div>

				<div class="row">
	                <div class="form-group col-sm-6">
	                    <label for="guardian">Parent/Guardian</label>
	                    <input type="text" class="form-control" name="guardian" id="guardianEdit"/>
	                </div>
	                <div class="form-group col-sm-6">
	                    <label for="econtact">Contact no.</label>
	                    <input type="text" class="form-control" name="econtact" id="econtactEdit"/>
	                </div>
				</div>
				
                <div class="row">
	                <div class="form-group col-sm-6">
	                    <label for="facility">Facility</label>
	                    <input type="text" class="form-control" name="facility" id="facilityEdit"/>
	                </div>

	                <div class="form-group col-sm-6">
	                    <label for="department">Department</label>
	                    <input type="text" class="form-control" name="department" id="departmentEdit"/>
	                </div>
                </div>

				<div class="row">
	                <div class="form-group col-sm-6">
	                    <label for="supervisor">Supervisor</label>
	                    <input type="text" class="form-control" name="supervisor" id="supervisorEdit"/>
	                </div>
	                <div class="form-group col-sm-6">
	                    <label for="designation">Designation</label>
	                    <input type="text" class="form-control" name="designation" id="designationEdit"/>
	                </div>
				</div>

				<div class="row">
	                <div class="form-group col-sm-6">
	                    <label for="slapd">SLAPD</label>
	                    <input type="text" class="form-control" name="slapd" id="slapdEdit"/>
	                </div>
	                <div class="form-group col-sm-6">
	                    <label for="apdtitle">Designation</label>
	                    <input type="text" class="form-control" name="apdtitle" id="apdtitleEdit"/>
	                </div>
				</div>
				
				<div class="row">
	                <div class="form-group col-sm-3">
	                    <label for="hours">Req'd Hours</label>
	                    <input type="text" class="form-control" name="hours" id="hoursEdit"/>
	                </div>
	                <div class="form-group col-sm-3">
	                    <label for="validity">Validity</label>
	                    <input type="text" class="form-control" name="validity" id="validityEdit"/>
	                </div>
	                <div class="form-group col-sm-2">
	                    <label for="interview">Interview</label>
	                    <input type="text" class="form-control" name="interview" id="interviewEdit"/>
	                </div>
	                <div class="form-group col-sm-2">
	                    <label for="started">Started</label>
	                    <input type="text" class="form-control" name="started" id="startedEdit"/>
	                </div>
	                <div class="form-group col-sm-2">
	                    <label for="end">End</label>
	                    <input type="text" class="form-control" name="end" id="endEdit"/>
	                </div>
				</div>


                
                <!-- <input type="hidden" class="form-control" name="id" id="idEdit"/> -->
                <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp(), $('#editFile').val(''), $('#tbl_setting').slideUp();">Cancel</a>
                <!-- <a href="javascript:void(0);" class="btn btn-success" onclick="userAction('edit')">Update User</a> -->
                <!-- <input type="hidden" name="action_type" id="action_type" value="edit"> -->
                <input type="submit" id="editSubmit" name="editSubmit" value="Update User" class="btn btn-success">
            </div>
            <div class="col-md-3">
                <a href="#" class="thumbnail" id="editThumbnail">
                    <img alt="" src="blank.jpg" width="450" height="300" id="imageEdit">
                </a>
                <input type="file" name="editFile" id="editFile" onchange="editFilePreview(this)"/>
            </div>

        </div>
    </form>
</div>



