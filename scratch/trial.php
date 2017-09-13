<?php


$sortVal = 'created';

    $sortArr = array(
        'id' => array(
            'order_by' => 'id'
        ),
        'name' => array(
            'order_by' => 'name'
        ),
        'email'=>array(
            'order_by'=>'email'
        ),
        'phone'=>array(
            'order_by'=>'phone'
        ),
        'created'=>array(
            'order_by'=>'created'
        ),
        // 'status'=>array(
        //     'order_by'=>'status'
        // )
    );
    $sortKey = key($sortArr[$sortVal]);
    $orderBy = $sortArr[$sortVal][$sortKey];




    echo 'SORTVAL : '.$sortVal.'<br><br>';
    // echo 'SORTARR : '.$sortArr.'<br><br>';
    echo 'SORTKEY : '.$sortKey.'<br><br>';
    echo 'ORDERBY : '.$orderBy.'<br><br>';


?>