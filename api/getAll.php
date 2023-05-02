<?php 
    include_once "../database.php";
    include_once "../pagination.php";

    $db=new Database();

    $limit=isset( $_GET['limit'] ) ? $_GET['limit'] : 9;
    $page=isset( $_GET['page'] ) ? $_GET['page'] : 1;
    $offset=($page-1)*9;
    // $offset=isset( $_GET['offset'] ) ? $_GET['offset'] : 0;
    
    if(isset($_GET['gen'])){
        if(isset($_GET['category'])){
            $member = $db->Table('sanpham')->Limit($limit)->Offset($offset)->GetCate($_GET['category']);
            $total=$db->Table('sanpham')->ID($_GET['category'])->CountCate('malsp');
        }
        else{
            $member = $db->Table('sanpham')->Limit($limit)->Offset($offset)->GetGen($_GET['gen']);
            $total=$db->Table('sanpham')->ID($_GET['gen'])->CountGen('theloai','malsp','malsp','macl');
        }
    }
    else{
        $member = $db->Table('sanpham')->Limit($limit)->Offset($offset)->Get();
        $total=$db->Table('sanpham')->CountAll();
    } 
  
    $result=new stdClass();
    $result->member=$member;
    $result->limit= (int)$limit;
    $result->current_page =  (int)$page;
    $result->allPage =  ceil($total/$limit);


    
    $db->Close();
    echo json_encode($result);

    
?>