<?php 
    $result=new stdClass();
    if(isset($_POST['start']) && isset($_POST['end']) && isset($_POST['otype']) && isset($_POST['sort']) ){
        $start=$_POST['start'];
        $end=$_POST['end'];
        $sort=$_POST['sort'];
        $otype=$_POST['otype'];
        // echo "$start $end $sort $otype";
        include_once "../database.php";
        $db=new Database();
        $member=$db->getTop($start,$end,$otype,$sort);
        $db->close();
        $result->member=$member;
        $result->status='1';
    }
    else{
        $result->status='0';
    }
    echo json_encode($result);
?>