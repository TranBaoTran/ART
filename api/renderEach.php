<?php 
    include_once "../database.php";
    function convertMoney($num) {
        return number_format($num, 0, ',', '.') . ' VND';
    }
    if(isset($_POST['masp'])){
        $db=new Database();
        $html="";
        $sql="select madon,ctdon.masp,ctdon.soluong,sanpham.gia,sanpham.img,sanpham.tensp from ctdon join sanpham on ctdon.masp=sanpham.masp where madon=".$_POST['masp'];
        $member=$db->NotPrepare($sql);
        foreach ($member as $item) {
            $total=$item->soluong*$item->gia;
            $html.='<div class="prCart shadow"><div class="prCart_it1"><img src="'.$item->img.'"></div><div class="prCart_it2"><p>'.$item->tensp.'</p><p>x'.$item->soluong.'</p><p>'.convertMoney($total).'</p></div></div>';
        }
        $db->close();
        echo $html;
    }
?>