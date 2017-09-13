<?php
include 'DB.php';
$db = new DB();
$tblName = 'tblstudents';



if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $condition['where'] = array('id'=>$_POST['id']);
        $condition['return_type'] = 'single';
        $user = $db->getRows($tblName,$condition);
        echo json_encode($user);
    }elseif($_POST['action_type'] == 'view'){
       $table = '<table style="table-layout: fixed;" width="3080" border="1" cellspacing="1" cellpadding="12" id="myTable>';
       $table.= '<thead>';
       $table.= '<tr>';
       $table.= '<th width="80" scope="col"><div align="center"></div></th>';
       $table.= '<th class="action" width="80" scope="col"><div align="center"><a class="column_sort" id="action" href="#">ACTION</a></div></th>';
       // $table.= '<th width="80" scope="col"><div align="center">ACTION</div></th>';
       $table.= '<th width="38" scope="col"><div align="center"><a class="column_sort" id="id" href="#">ID</a></div></th>';
       $table.= '<th width="100" scope="col"><div align="center"><a class="column_sort" id="control" href="#">CTRL NO.</a></div></th>';
       $table.= '<th class="photo" width="55" scope="col"><div align="center">PHOTO</div></th>';
       $table.= '<th class="nickname" width="73" scope="col"><div align="center"><a class="column_sort" id="nickname" href="#">NICKNAME</a></div></th>';
       $table.= '<th width="135" scope="col"><div align="center"><a class="column_sort" id="name" href="#">COMPLETE NAME</a></div></th>';
       $table.= '<th class="address" width="200" scope="col"><div align="center"><a class="column_sort" id="address" href="#">ADDRESS</a></div></th>';
       $table.= '<th class="contact" width="120" scope="col"><div align="center"><a class="column_sort" id="contact" href="#">CONTACT NO.</a></div></th>';
       $table.= '<th class="school" width="185" scope="col"><div align="center"><a class="column_sort" id="school" href="#">SCHOOL</a></div></th>';
       $table.= '<th class="gender" width="55" scope="col"><div align="center"><a class="column_sort" id="gender" href="#">GENDER</a></div></th>';
       $table.= '<th class="birthday" width="75" scope="col"><div align="center"><a class="column_sort" id="birthday" href="#">BIRTHDAY</a></div></th>';
       $table.= '<th class="guardian" width="135" scope="col"><div align="center"><a class="column_sort" id="guardian" href="#">GUARDIAN</a></div></th>';
       $table.= '<th class="gcontact" width="120" scope="col"><div align="center"><a class="column_sort" id="econtact" href="#">CONTACT NO.</a></div></th>';
       $table.= '<th class="facility" width="165" scope="col"><div align="center"><a class="column_sort" id="facility" href="#">FACILITY</a></div></th>';
       $table.= '<th class="department" width="180" scope="col"><div align="center"><a class="column_sort" id="department" href="#">DEPARTMENT</a></div></th>';
       $table.= '<th class="supervisor" width="135" scope="col"><div align="center"><a class="column_sort" id="supervisor" href="#">SUPERVISOR</a></div></th>';
       $table.= '<th class="designation" width="135" scope="col"><div align="center"><a class="column_sort" id="designation" href="#">DESIGNATION</a></div></th>';
       $table.= '<th class="slapd" width="135" scope="col"><div align="center"><a class="column_sort" id="slapd" href="#">SLAPD</a></div></th>';
       $table.= '<th class="apdtitle" width="135" scope="col"><div align="center"><a class="column_sort" id="apdtitle" href="#">DESIGNATION</a></div></th>';
       $table.= '<th class="hours" width="75" scope="col"><div align="center"><a class="column_sort" id="hours" href="#">HOURS</a></div></th>';
       $table.= '<th class="validity" width="75" scope="col"><div align="center"><a class="column_sort" id="validity" href="#">VALIDITY</a></div></th>';
       $table.= '<th class="interview" width="75" scope="col"><div align="center"><a class="column_sort" id="interview" href="#">INTERVIEW</a></div></th>';
       $table.= '<th class="start" width="75" scope="col"><div align="center"><a class="column_sort" id="started" href="#">START</a></div></th>';
       $table.= '<th class="end" width="75" scope="col"><div align="center"><a class="column_sort" id="end" href="#">END</a></div></th>';
       $table.= '</tr>';
       $table.= '</thead>';
       $table.= '<tbody id="userData">';
       $users = $db->getRows($tblName,$condition); 
       if(!empty($users)){
           $count = 0;
           foreach($users as $user): $count++;
               $table .= '<tr id="'.$user['id'].'" class="table-row">';
               $table .= '<td class="action"><div align="center"><input type="checkbox" name="ojt_id[]" class="delete_ojt" value="'.$user['id'].'"> &nbsp;&nbsp;&nbsp;';
               $table .= '<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editUser(\''.$user['id'].'\'), $(\'#editFile\').val(\'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?userAction(\'delete\',\''.$user['id'].'\'):false;"></a></div></td>';
               $table .= '<td><div align="center">'.$user['id'].'</div></td>';
               $table .= '<td><div align="center">'.$user['control'].'</div></td>';
               $table .= '<td class="photo"><div align="center"><img src="'.$user['filelocation'].'" height="50" width="50"></div></td>';
               $table .= '<td class="nickname"><div align="center">'.$user['nickname'].'</div></td>';
               $table .= '<td><div align="center">'.$user['name'].'</div></td>';
               $table .= '<td class="address"><div align="center">'.$user['address'].'</div></td>';
               $table .= '<td class="contact"><div align="center">'.$user['contact'].'</div></td>';
               $table .= '<td class="school"><div align="center">'.$user['school'].'</div></td>';
               $table .= '<td class="gender"><div align="center">'.$user['gender'].'</div></td>';
               $table .= '<td class="birthday"><div align="center">'.$user['birthday'].'</div></td>';
               $table .= '<td class="guardian"><div align="center">'.$user['guardian'].'</div></td>';
               $table .= '<td class="gcontact"><div align="center">'.$user['econtact'].'</div></td>';
               $table .= '<td class="facility"><div align="center">'.$user['facility'].'</div></td>';
               $table .= '<td class="department"><div align="center">'.$user['department'].'</div></td>';
               $table .= '<td class="supervisor"><div align="center">'.$user['supervisor'].'</div></td>';
               $table .= '<td class="designation"><div align="center">'.$user['designation'].'</div></td>';
               $table .= '<td class="slapd"><div align="center">'.$user['slapd'].'</div></td>';
               $table .= '<td class="apdtitle"><div align="center">'.$user['apdtitle'].'</div></td>';
               $table .= '<td class="hours"><div align="center">'.$user['hours'].'</div></td>';
               $table .= '<td class="validity"><div align="center">'.$user['validity'].'</div></td>';
               $table .= '<td class="interview"><div align="center">'.$user['interview'].'</div></td>';
               $table .= '<td class="start"><div align="center">'.$user['started'].'</div></td>';
               $table .= '<td class="end"><div align="center">'.$user['end'].'</div></td>';
               // $status = ($user['status'] == 1)?'Active':'Inactive';
               // echo '<td>'.$status.'</td>';
               $table .= '</tr>';
           endforeach;
       }else{
          $table .= '<tr><td colspan="24">No record(s) found...</td></tr>';
       }
       $table .= '</tbody>';
       $table .= '</table>';
       // $table .= '</div>';
       echo $table;
    }elseif($_POST['action_type'] == 'add'){

            // $info = array(
            //     'name' => $_POST['name'],
            //     'email' => $_POST['email'],
            //     'phone' => $_POST['phone'],
            // );

            $info = array(
                // 'id' => $_POST['id'],
                'control' => $_POST['control'],
                'nickname' => $_POST['nickname'],
                'name' => $_POST['name'],
                'address' => $_POST['address'],
                'school' => $_POST['school'],
                'gender' => $_POST['gender'],
                'birthday' => $_POST['birthday'],
                'contact' => $_POST['contact'],
                'guardian' => $_POST['guardian'],
                'econtact' => $_POST['econtact'],
                'facility' => $_POST['facility'],
                'department' => $_POST['department'],
                'supervisor' => $_POST['supervisor'],
                'designation' => $_POST['designation'],
                'slapd' => $_POST['slapd'],
                'apdtitle' => $_POST['apdtitle'],
                'hours' => $_POST['hours'],
                'validity' => $_POST['validity'],
                'interview' => $_POST['interview'],
                'started' => $_POST['started'],
                'end' => $_POST['end']
            );

            $tmp_name = $_FILES['addFile']['tmp_name'];
            $name = $_FILES['addFile']['name'];
            $type = $_FILES['addFile']['type'];
            $imglocation = "image/". $name;

            move_uploaded_file($tmp_name, $imglocation);

            $image = array(
                'filename'=>$name,
                'filetype'=>$type,
                'filelocation'=>$imglocation
            );

            $userData = array_merge($info, $image);
            $insert = $db->insert($tblName, $userData);
            echo $insert?'ok':'err';

    }elseif($_POST['action_type'] == 'edit'){
        if(!empty($_POST['id'])){

            // print_r($_POST);

            // $info = array(
            //     'name' => $_POST['name'],
            //     'email' => $_POST['email'],
            //     'phone' => $_POST['phone']
            // );

            $info = array(
                // 'id' => $_POST['id'],
                'control' => $_POST['control'],
                'nickname' => $_POST['nickname'],
                'name' => $_POST['name'],
                'address' => $_POST['address'],
                'school' => $_POST['school'],
                'gender' => $_POST['gender'],
                'birthday' => $_POST['birthday'],
                'contact' => $_POST['contact'],
                'guardian' => $_POST['guardian'],
                'econtact' => $_POST['econtact'],
                'facility' => $_POST['facility'],
                'department' => $_POST['department'],
                'supervisor' => $_POST['supervisor'],
                'designation' => $_POST['designation'],
                'slapd' => $_POST['slapd'],
                'apdtitle' => $_POST['apdtitle'],
                'hours' => $_POST['hours'],
                'validity' => $_POST['validity'],
                'interview' => $_POST['interview'],
                'started' => $_POST['started'],
                'end' => $_POST['end']
            );


            $tmp_name = $_FILES['editFile']['tmp_name'];
            $name = $_FILES['editFile']['name'];
            $type = $_FILES['editFile']['type'];
            $imglocation = "image/". $name;

            move_uploaded_file($tmp_name, $imglocation);

            $image = array(
                'filename'=>$name,
                'filetype'=>$type,
                'filelocation'=>$imglocation
            );

            $userData = ($name) ? array_merge($info, $image) : $info ;          
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$userData,$condition);
            echo $update?'ok':'err';

        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
            $condition = array('id' => $_POST['id']);
            $delete = $db->delete($tblName,$condition);
            echo $delete?'ok':'err';
        }
    }

    exit;
}
?>