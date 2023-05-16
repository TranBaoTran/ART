<?php 
    $result=new stdClass();
    if(isset($_POST['start']) && isset($_POST['end']) && isset($_POST['type']) && isset($_POST['otype'])){
        $start=$_POST['start'];
        $end=$_POST['end'];
        $type=$_POST['type'];
        $otype=$_POST['otype'];
        include_once "../database.php";
        $db=new Database();
        $member=$db->getGio($start,$end,$type,$otype);
        if($member->total==null){
            $member->total=0;
        }
        $full=$db->getFull($start,$end,$otype);
        if($full==null){
            $full=0;
        }
        $db->close();
        $result->member=$member;
        $result->full=$full;
        $result->status='1';
    }
    else{
        $result->status='0';
    }

    echo json_encode($result);
?>