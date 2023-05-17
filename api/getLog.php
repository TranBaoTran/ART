<?php
    include_once "../database.php";

    session_start();

    $uname=$_POST["username"];
    $upass=$_POST["password"];

    if($uname==""){
        echo "-3";
        die();
    }
    if($upass==""){
        echo "-2";
        die();
    }
    $db=new Database();

    $key=$db->getName($uname,$upass);

    if($key==-1){
        echo "-1";
    }
    else if($key==0){
        echo "0";
    }
    else{
        $sql="select matk,tendn,nhomquyen from taikhoan where tendn='".$uname."'";
        $member=$db->getOne($sql);
        $_SESSION['matk'] = $member->matk;
        $_SESSION['nhomquyen'] = $member->nhomquyen;
        $_SESSION['tentk'] = $member->tendn;
        if($member->nhomquyen=="KH"){
            $sql="select hoten as total from khachhang where matk='".$member->matk."'";
            $hoten=$db->Take($sql);
            $_SESSION['hoten'] = $hoten;
        }
        echo "$member->nhomquyen";
    }

    $db->close();

?>