<?php
include 'DB.php';
$db = new DB();
$tblName = 'users';

include 'pagination.php';
$p = new Pages();

// $page = (isset($_POST['page'])) ? $_POST['page'] : 1;
$totalitems = (isset($_POST['totalitems'])) ? $_POST['totalitems'] : 28;
$limit = (isset($_POST['limit'])) ? $_POST['limit'] : 3;
$adjacents = (isset($_POST['adjacents'])) ? $_POST['adjacents'] : 1 ;


if (!empty($_POST['page']) && is_numeric($_POST['page']) && isset($_POST['page']))  {
// $_POST['page'] > $lastpage ||
    $page = ( $_POST['page'] < 0) ? 1 : $_POST['page'];

    if ($page) {
        $start = ($page - 1) * $limit;
    } else {
        $start = 0;
    }
    
} else {
    $page = 0;
}

$pagination = $p->getPaginationString($page, $totalitems, $limit, $adjacents);
echo $pagination;

$condition = array();
$condition['start'] = (isset($start)) ? $start : 0;
$condition['limit'] = $limit;


$searchCol = (!isset($_POST['searchCol'])) ? 'id' : $_POST['searchCol'] ;

if ($searchCol !== 'all') {
    $concat = $searchCol;
} else {
    $concat = array('name', 'email', 'phone', 'status' );
}


if(!empty($searchCol) && !empty($_POST['sortCol'])){

        $condition['like'] = array('keywords'=>$_POST['val'], 'concat' => $concat);

        $sortVal = $_POST['sortCol'];

        $sortArr = array(
            'name' => array(
                'order_by' => 'name DESC'
            ),
            'email'=>array(
                'order_by'=>'email ASC'
            ),
            'phone'=>array(
                'order_by'=>'phone DESC'
            ),
            'status'=>array(
                'order_by'=>'status DESC'
            )
        );
        $sortKey = key($sortArr[$sortVal]);
        $condition[$sortKey] = $sortArr[$sortVal][$sortKey];

}else{
    $condition['order_by'] = 'id DESC';
}

$users = $db->getRows($tblName,$condition);
if(!empty($users)){
    $count = 0;
    foreach($users as $user): $count++;
        echo '<tr>';
        echo '<td>'.$user['id'].'</td>';
        echo '<td>'.$user['name'].'</td>';
        echo '<td>'.$user['email'].'</td>';
        echo '<td>'.$user['phone'].'</td>';
        echo '<td>'.$user['created'].'</td>';
        $status = ($user['status'] == 1)?'Active':'Inactive';
        echo '<td>'.$status.'</td>';
        echo '<td><a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editUser(\''.$user['id'].'\')"></a><a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\')?userAction(\'delete\',\''.$user['id'].'\'):false;"></a></td>';
        echo '</tr>';
    endforeach;
}else{
    echo '<tr><td colspan="5">No user(s) found...</td></tr>';
}


$val = (!isset($_POST['val'])) ? '' : $_POST['val'] ;
$total = $db->getRows($tblName,array('return_type' => 'count', 'like' => array('keywords'=>$val, 'concat' => $concat) ));
// Show entries
$start = (!isset($start)) ? 0 : $start ;
$numStart = $start + 1;
$lastpage = $numStart + ($limit-1);
$lastpage = ($lastpage > $total) ? $total : $lastpage;

echo 'Showing '.$numStart.' to '.$lastpage.' of '.$total.' entries';
exit;

?>