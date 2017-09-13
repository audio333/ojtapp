<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
table {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	text-decoration: none;
	border-collapse:collapse;
	border-color: #000;
}
th {
	background-color: #333;
	color: #FFF;
}
</style>
</head>

<body>


<?php

$table = '<table width="2980" border="1" cellspacing="1" cellpadding="8" class="table table-striped" id="myTable>';
$table.= '<thead>';
$table.= '<tr>';
$table.= '<th width="38" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="id" href="#">ID</a></div></th>';
$table.= '<th width="100" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="control" href="#">CTRL NO.</a></div></th>';
$table.= '<th width="73" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="nickname" href="#">NICK NAME</a></div></th>';
$table.= '<th width="141" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="name" href="#">COMPLETE NAME</a></div></th>';
$table.= '<th width="290" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="address" href="#">ADDRESS</a></div></th>';
$table.= '<th width="178" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="school" href="#">SCHOOL</a></div></th>';
$table.= '<th width="42" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="gender" href="#">GENDER</a></div></th>';
$table.= '<th width="55" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="birthday" href="#">BIRTHDAY</a></div></th>';
$table.= '<th width="129" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="contact" href="#">CONTACT NO.</a></div></th>';
$table.= '<th width="141" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="guardian" href="#">GUARDIAN</a></div></th>';
$table.= '<th width="129" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="econtact" href="#">CONTACT NO.</a></div></th>';
$table.= '<th width="179" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="facility" href="#">FACILITY</a></div></th>';
$table.= '<th width="197" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="department" href="#">DEPARTMENT</a></div></th>';
$table.= '<th width="141" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="supervisor" href="#">SUPERVISOR</a></div></th>';
$table.= '<th width="155" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="designation" href="#">DESIGNATION</a></div></th>';
$table.= '<th width="141" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="slapd" href="#">SLAPD</a></div></th>';
$table.= '<th width="155" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="apdtitle" href="#">DESIGNATION</a></div></th>';
$table.= '<th width="55" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="hours" href="#">REQ\'D HRS</a></div></th>';
$table.= '<th width="55" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="validity" href="#">VALIDITY</a></div></th>';
$table.= '<th width="55" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="interview" href="#">INTERVIEW</a></div></th>';
$table.= '<th width="55" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="started" href="#">STARTED</a></div></th>';
$table.= '<th width="55" nowrap="nowrap" scope="col"><div align="center"><a class="column_sort" id="end" href="#">END</a></div></th>';
$table.= '</tr>';
$table.= '</thead>';
$table.= '<tbody id="userData">';
$users = $db->getRows($tblName,$condition); 
if(!empty($users)){
    $count = 0;
    foreach($users as $user): $count++;
        $table .= '<tr id="'.$user['id'].'" class="table-row">';
        $table .= '<td><input type="checkbox" name="ojt_id[]" class="delete_ojt" value="'.$user['id'].'">';
        $table .= '<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editUser(\''.$user['id'].'\'), $(\'#editFile\').val(\'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?userAction(\'delete\',\''.$user['id'].'\'):false;"></a></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['id'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['control'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['nickname'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['name'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['address'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['school'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['gender'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['birthday'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['contact'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['guardian'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['econtact'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['facility'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['department'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['supervisor'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['designation'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['slapd'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['apdtitle'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['hours'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['validity'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['interview'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['started'].'</div></td>';
        $table .= '<td nowrap="nowrap"><div align="center">'.$user['end'].'</div></td>';
        // $status = ($user['status'] == 1)?'Active':'Inactive';
        // echo '<td>'.$status.'</td>';
        $table .= '</tr>';
    endforeach;

}else{
    $table .= '<tr><td colspan="5">No user(s) found...</td></tr>';
}
$table .= '</tbody>';
$table .= '</table>';
// $table .= '</div>';
echo $table;
exit;

?>


</body>
</html>
