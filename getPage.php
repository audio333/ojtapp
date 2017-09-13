<?php
include 'DB.php';
$db = new DB();
$tblName = 'tblstudents';

include 'pagination.php';
$p = new Pages();


//Get limit and adjacents
$limit = (isset($_POST['limit'])) ? $_POST['limit'] : 5;
$adjacents = (isset($_POST['adjacents'])) ? $_POST['adjacents'] : 1 ;

//Get Page
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

//Get TotalItems
$searchCol = (!isset($_POST['searchCol'])) ? 'all' : $_POST['searchCol'] ;

if ($searchCol !== 'all') {
    $concat = $searchCol;
} else {
    $concat = array('name', 'nickname', 'contact', 'address' );
}

//Get SearchInput
$val = (!isset($_POST['val'])) ? '' : $_POST['val'] ;

//Count result
$totalitems = $db->getRows($tblName,array('return_type' => 'count', 'like' => array('keywords'=>$val, 'concat' => $concat) ));




//Show pages
$pagination = $p->getPaginationString($page, $totalitems, $limit, $adjacents);
echo '<center>'.$pagination.'<br><br></center>';

// Show entries
$start = (!isset($start)) ? 0 : $start ;
$numStart = $start + 1;
$lastpage = $numStart + ($limit-1);
$lastpage = ($lastpage > $totalitems) ? $totalitems : $lastpage;

echo '<center>Showing '.$numStart.' to '.$lastpage.' of '.$totalitems.' entries</center>';

exit;

?>