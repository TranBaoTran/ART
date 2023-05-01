<?php 
    include_once "../database.php";

    $db=new Database();

    $limit=isset( $_GET['limit'] ) ? $_GET['limit'] : 9;
    $offset=isset( $_GET['offset'] ) ? $_GET['offset'] : 0;
    $cate=isset( $_GET['cate'] ) ? $_GET['cate'] : '';

    $member = $db->Table('sanpham')->Limit( $limit)->Offset($offset)->GetCate($cate);
    $db->Close();

    echo json_encode($member);

?>