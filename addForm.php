	
<div class="panel-body none formData" id="addForm">
    <!-- <h2 id="actionLabel">Add User</h2> -->

    <form class="form" id="userForm" enctype="multipart/form-data" action="" method="POST">
        <div class="row form-group form-group-sm">

            <div class="col-md-9">

            	<div class="row">
	                <div class="form-group col-sm-1">
	                    <label for="id">ID</label>
	                    <input type="text" class="form-control" name="id" id="id" disabled />
	                </div>
	                <div class="form-group col-sm-3 col-sm-offset-2">
	                    <label for="control">Control no.</label>
	                    <input type="text" class="form-control" name="control" id="control"/>
	                </div>
	                <div class="form-group col-sm-4 col-sm-offset-2">
	                    <label for="nickname">Nickname</label>
	                    <input type="text" class="form-control" name="nickname" id="nickname"/>
	                </div>
            	</div>

                <div class="form-group">
                    <label for="name">Complete Name</label>
                    <input type="text" class="form-control" name="name" id="name"/>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address"/>
                </div>
                <div class="form-group">
                    <label for="school">School</label>
                    <input type="text" class="form-control" name="school" id="school"/>
                </div>

				<div class="row">
	                <div class="form-group col-sm-3">
	                    <label for="gender">Gender</label>
	                    <input type="text" class="form-control" name="gender" id="gender"/>
	                </div>
	                <div class="form-group col-sm-3">
	                    <label for="birthday">Birthday</label>
	                    <input type="text" class="form-control" name="birthday" id="birthday"/>
	                </div>
	                <div class="form-group col-sm-6">
	                    <label for="contact">Contact no.</label>
	                    <input type="text" class="form-control" name="contact" id="contact"/>
	                </div>
				</div>

				<div class="row">
	                <div class="form-group col-sm-6">
	                    <label for="guardian">Parent/Guardian</label>
	                    <input type="text" class="form-control" name="guardian" id="guardian"/>
	                </div>
	                <div class="form-group col-sm-6">
	                    <label for="econtact">Contact no.</label>
	                    <input type="text" class="form-control" name="econtact" id="econtact"/>
	                </div>
				</div>
				
                <div class="row">
	                <div class="form-group col-sm-6">
	                    <label for="facility">Facility</label>
	                    <input type="text" class="form-control" name="facility" id="facility"/>
	                </div>

	                <div class="form-group col-sm-6">
	                    <label for="department">Department</label>
	                    <input type="text" class="form-control" name="department" id="department"/>
	                </div>
                </div>

				<div class="row">
	                <div class="form-group col-sm-6">
	                    <label for="supervisor">Supervisor</label>
	                    <input type="text" class="form-control" name="supervisor" id="supervisor"/>
	                </div>
	                <div class="form-group col-sm-6">
	                    <label for="designation">Designation</label>
	                    <input type="text" class="form-control" name="designation" id="designation"/>
	                </div>
				</div>

				<div class="row">
	                <div class="form-group col-sm-6">
	                    <label for="slapd">SLAPD</label>
	                    <input type="text" class="form-control" name="slapd" id="slapd"/>
	                </div>
	                <div class="form-group col-sm-6">
	                    <label for="apdtitle">Designation</label>
	                    <input type="text" class="form-control" name="apdtitle" id="apdtitle"/>
	                </div>
				</div>
				
				<div class="row">
	                <div class="form-group col-sm-3">
	                    <label for="hours">Req'd Hours</label>
	                    <input type="text" class="form-control" name="hours" id="hours"/>
	                </div>
	                <div class="form-group col-sm-3">
	                    <label for="validity">Validity</label>
	                    <input type="text" class="form-control" name="validity" id="validity"/>
	                </div>
	                <div class="form-group col-sm-2">
	                    <label for="interview">Interview</label>
	                    <input type="text" class="form-control" name="interview" id="interview"/>
	                </div>
	                <div class="form-group col-sm-2">
	                    <label for="started">Started</label>
	                    <input type="text" class="form-control" name="started" id="started"/>
	                </div>
	                <div class="form-group col-sm-2">
	                    <label for="end">End</label>
	                    <input type="text" class="form-control" name="end" id="end"/>
	                </div>
				</div>


                
                <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp(), $('#tbl_setting').slideUp(), $('#addFile').val(''), $('#imageAdd').attr('src', 'blank.jpg')">Cancel</a>
                <!-- <a href="javascript:void(0);" class="btn btn-success" onclick="userAction('add')">Add User</a> -->
                <!-- <a href="#" class="btn btn-success" id="shitButton">Add User</a> -->
                <input type="hidden" name="action_type" id="action_type" value="add">
                <input type="submit" id="addSubmit" name="addSubmit" value="Add User" class="btn btn-success">

            </div>

            <div class="col-md-3">
                <a href="#" class="thumbnail" id="addThumbnail">
                    <img alt="" src="blank.jpg" width="450" height="300" id="imageAdd">
                </a>
                <input type="file" name="addFile" id="addFile" onchange="addFilePreview(this)" />
            </div>

        </div>
    </form>
</div>


