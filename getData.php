<?php
include 'DB.php';
$db = new DB();
$tblName = 'tblstudents';
$condition = array();

//Get limit
$limit = (isset($_POST['limit'])) ? $_POST['limit'] : 5;

//Get page
if (!empty($_POST['page']) && is_numeric($_POST['page']) && isset($_POST['page']))  {
    $page = ( $_POST['page'] < 0) ? 1 : $_POST['page'];

    if ($page) {
        $start = ($page - 1) * $limit;
    } else {
        $start = 0;
    }
    
} else {
    $page = 0;
}

//Get start and limit
$condition['start'] = (isset($start)) ? $start : 0;
$condition['limit'] = $limit;


//Get search input and sort
$searchCol = (!isset($_POST['searchCol'])) ? 'all' : $_POST['searchCol'] ;

if ($searchCol !== 'all') {
    $concat = $searchCol;
} else {
    $concat = array(
                    'id', 
                    'control', 
                    'nickname', 
                    'name', 
                    'address', 
                    'school', 
                    'gender', 
                    'birthday', 
                    'contact', 
                    'guardian', 
                    'econtact', 
                    'department', 
                    'supervisor', 
                    'designation', 
                    'slapd', 
                    'apdtitle', 
                    'hours', 
                    'validity', 
                    'interview', 
                    'started', 
                    'end'
                );
}


if(!empty($_POST['searchCol']) && !empty($_POST['sortCol'])){

    $condition['like'] = array('keywords'=>$_POST['val'], 'concat' => $concat);

    $order = (isset($_POST['order'])) ? $_POST['order'] : 'ASC' ;  

     // if($order == 'DESC'){
     //    $order = 'ASC';
     // }else{
     //    $order = 'DESC';
     // }  

    $sortVal = $_POST['sortCol'];

    // $sortArr = array(
    //     'id' => array(
    //         'order_by' => 'id'
    //     ),
    //     'name' => array(
    //         'order_by' => 'name'
    //     ),
    //     'email'=>array(
    //         'order_by'=>'email'
    //     ),
    //     'phone'=>array(
    //         'order_by'=>'phone'
    //     ),
    //     'created'=>array(
    //         'order_by'=>'created'
    //     ),
    //     'status'=>array(
    //         'order_by'=>'status'
    //     )
    // );
    // $sortKey = key($sortArr[$sortVal]);
    // $orderBy = $sortArr[$sortVal][$sortKey];

    $condition['order_by'] = $sortVal." ".$order;


    // $condition['order_by'] = $orderBy." ".$order;
}else{
    $condition['order_by'] = 'id DESC';
}


//Display data from database
// echo '<div class="table-responsive" id="employee_table">';
// echo '<table class="table table-striped bordered" id="myTable">';
// echo '<thead>';
// echo '<tr>';
// echo '<th>Delete</th>';
// echo '<th><a class="column_sort" id="id" href="#">ID</a></th>';
// echo '<th><a class="column_sort" id="name" href="#">Name</a></th>';
// echo '<th><a class="column_sort" id="email" href="#">Email</a></th>';
// echo '<th><a class="column_sort" id="phone" href="#">Phone</a></th>';
// echo '<th><a class="column_sort" id="created" href="#">Created</a></th>';
// echo '<th><a class="column_sort" id="status" href="#">Status</a></th>';
// echo '<th>Action</th>';
// echo '</tr>';
// echo '</thead>';
// echo '<tbody id="userData">';
// $users = $db->getRows($tblName,$condition);
// if(!empty($users)){
//     $count = 0;
//     foreach($users as $user): $count++;
//         echo '<tr id="'.$user['id'].'">';
//         echo '<td><input type="checkbox" name="ojt_id[]" class="delete_ojt" value="'.$user['id'].'"></td>';
//         echo '<td>'.$user['id'].'</td>';
//         echo '<td>'.$user['name'].'</td>';
//         echo '<td>'.$user['email'].'</td>';
//         echo '<td>'.$user['phone'].'</td>';
//         echo '<td>'.$user['created'].'</td>';
//         $status = ($user['status'] == 1)?'Active':'Inactive';
//         echo '<td>'.$status.'</td>';
//         echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editUser(\''.$user['id'].'\'), $(\'#editFile\').val(\'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?userAction(\'delete\',\''.$user['id'].'\'):false;"></a></td>';
//         echo '</tr>';
//     endforeach;









// echo '<table class="table table-striped" id="myTable">';
// echo '<thead>';
// echo '<tr>';
// echo '<th>Action</th>';
// echo '<th><a class="column_sort" id="id" href="#">ID</a></th>';
// echo '<th><a class="column_sort" id="control" href="#">control</a></th>';
// echo '<th><a class="column_sort" id="nickname" href="#">nickname</a></th>';
// echo '<th><a class="column_sort" id="name" href="#">name</a></th>';
// echo '<th><a class="column_sort" id="address" href="#">address</a></th>';
// echo '<th><a class="column_sort" id="school" href="#">school</a></th>';
// echo '<th><a class="column_sort" id="gender" href="#">gender</a></th>';
// echo '<th><a class="column_sort" id="birthday" href="#">birthday</a></th>';
// echo '<th><a class="column_sort" id="contact" href="#">contact</a></th>';
// echo '<th><a class="column_sort" id="guardian" href="#">guardian</a></th>';
// echo '<th><a class="column_sort" id="econtact" href="#">Contact no.</a></th>';
// echo '<th><a class="column_sort" id="facility" href="#">facility</a></th>';
// echo '<th><a class="column_sort" id="department" href="#">department</a></th>';
// echo '<th><a class="column_sort" id="supervisor" href="#">supervisor</a></th>';
// echo '<th><a class="column_sort" id="designation" href="#">designation</a></th>';
// echo '<th><a class="column_sort" id="slapd" href="#">slapd</a></th>';
// echo '<th><a class="column_sort" id="apdtitle" href="#">apdtitle</a></th>';
// echo '<th><a class="column_sort" id="hours" href="#">hours</a></th>';
// echo '<th><a class="column_sort" id="validity" href="#">validity</a></th>';
// echo '<th><a class="column_sort" id="interview" href="#">interview</a></th>';
// echo '<th><a class="column_sort" id="started" href="#">started</a></th>';
// echo '<th><a class="column_sort" id="end" href="#">end</a></th>';
//x echo '<th><a class="column_sort" id="status" href="#">Status</a></th>';
//x echo '<th>Action</th>';
// echo '</tr>';
// echo '</thead>';
// echo '<tbody id="userData">';
// $users = $db->getRows($tblName,$condition); 
// if(!empty($users)){
//     $count = 0;
//     foreach($users as $user): $count++;
//         echo '<tr id="'.$user['id'].'" class="table-row">';
//         echo '<td><input type="checkbox" name="ojt_id[]" class="delete_ojt" value="'.$user['id'].'">';
//         echo '<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editUser(\''.$user['id'].'\'), $(\'#editFile\').val(\'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?userAction(\'delete\',\''.$user['id'].'\'):false;"></a></td>';
//         echo '<td>'.$user['id'].'</td>';
//         echo '<td>'.$user['control'].'</td>';
//         echo '<td>'.$user['nickname'].'</td>';
//         echo '<td>'.$user['name'].'</td>';
//         echo '<td>'.$user['address'].'</td>';
//         echo '<td>'.$user['school'].'</td>';
//         echo '<td>'.$user['gender'].'</td>';
//         echo '<td>'.$user['birthday'].'</td>';
//         echo '<td>'.$user['contact'].'</td>';
//         echo '<td>'.$user['guardian'].'</td>';
//         echo '<td>'.$user['econtact'].'</td>';
//         echo '<td>'.$user['facility'].'</td>';
//         echo '<td>'.$user['department'].'</td>';
//         echo '<td>'.$user['supervisor'].'</td>';
//         echo '<td>'.$user['designation'].'</td>';
//         echo '<td>'.$user['slapd'].'</td>';
//         echo '<td>'.$user['apdtitle'].'</td>';
//         echo '<td>'.$user['hours'].'</td>';
//         echo '<td>'.$user['validity'].'</td>';
//         echo '<td>'.$user['interview'].'</td>';
//         echo '<td>'.$user['started'].'</td>';
//         echo '<td>'.$user['end'].'</td>';
        //x $status = ($user['status'] == 1)?'Active':'Inactive';
        //x echo '<td>'.$status.'</td>';
//         echo '</tr>';
//     endforeach;

// }else{
//     echo '<tr><td colspan="5">No user(s) found...</td></tr>';
// }
// echo '</tbody>';
// echo '</table>';
// echo '</div>';
// exit;

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
exit;

?>