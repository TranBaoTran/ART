<?php 
    include_once "../database.php";

    $db=new Database();

    $limit=isset( $_GET['limit'] ) ? $_GET['limit'] : 9;
    $offset=isset( $_GET['offset'] ) ? $_GET['offset'] : 0;
    $gen=isset( $_GET['gen'] ) ? $_GET['gen'] : '';

    $member = $db->Table('sanpham')->Limit( $limit)->Offset($offset)->GetGen($gen);
    $db->Close();

    echo json_encode($member);

?>