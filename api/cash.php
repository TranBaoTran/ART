<?php 
    session_start();
    include_once "../database.php";
    $db=new Database();
    
    if (isset($_SESSION['cart'])  && is_array($_SESSION['cart'])) {
        $ck1=$db->InsertDH($_SESSION['matk']);
        if($ck1!="-1"){
            foreach ($_SESSION['cart'] as $item) {
                $ck2=$db->InsertCTD($ck1,$item['ten'],$item['sl']);
                if($ck2<1){
                    echo "Không thể thêm sản phẩm vào đơn hàng";
                    $db->close();
                    die();
                }
                // $sql="select * from sanpham where masp='".$item['ten']."'";
                // $pr=$db->getOne($sql);
                // $slnew=$pr->soluong-$item['sl'];
                // $buynew=$pr->slmua+$item['sl'];
                // $ck4=$db->updateQuantity($slnew,$buynew,$item['ten']);
                // if($ck4<1){
                //     echo "Không thể thay đổi dữ liệu của kho";
                //     $db->close();
                //     die();
                // }
            }
            if(isset($_SESSION['total'])){
                $ck3=$db->updateTotal($_SESSION['total'],$ck1);
                if($ck3>0){
                    unset($_SESSION['cart']);
                    unset($_SESSION['total']);
                    echo "Đã thanh toán thành công";
                }
            }
        }
        else{
            echo "Không thể tạo đơn hàng mới";
        }
    }else{
        echo "Giỏ hàng đang trống";
    }

    $db->close();
?>