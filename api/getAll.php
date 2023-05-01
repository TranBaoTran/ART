<?php 
    include_once "../database.php";

    $db=new Database();

    $limit=isset( $_GET['limit'] ) ? $_GET['limit'] : 9;
    $offset=isset( $_GET['offset'] ) ? $_GET['offset'] : 0;

    $member = $db->Table('sanpham')->Limit( $limit)->Offset($offset)->Get();
    $db->Close();

    echo json_encode($member);

?>