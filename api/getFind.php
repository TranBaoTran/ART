<?php 
include_once "../database.php";
include_once "../pagination.php";

$db=new Database();

$limit=isset( $_GET['limit'] ) ? $_GET['limit'] : 9;
$page=isset( $_GET['page'] ) ? $_GET['page'] : 1;
$offset=($page-1)*9;
$name=isset($_GET['name']) ? $_GET['name'] : "";
$type=isset($_GET['type']) ? $_GET['type'] : "";
$min=isset($_GET['min']) ? (int)$_GET['min'] : 1500;
$max=isset($_GET['max']) ? (int)$_GET['max'] : 7443000;

$member=$db->Limit($limit)->Offset($offset)->getFind($name,$type,$min,$max);
$total=$db->countFind($name,$type,$min,$max);

$result=new stdClass();
$result->member=$member;
$result->limit= (int)$limit;
$result->current_page =  (int)$page;
$result->allPage =  ceil($total/$limit);

$db->Close();
echo json_encode($result);
?>