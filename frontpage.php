<?php 
    $db=new Database();
    $sql="select * from sanpham order by slmua desc limit 9 offset 0";
    $member = $db->NotPrepare($sql);
    $db->close();
?>

<div class="banner">
        <h3 class="banner_content">Sản phẩm</h3>
</div>
<div id="MENU_CONTAIN">
    <div class="MENU_SP" style="display: flex;" id="productWraper">
        <?php foreach ($member as $item){ 
            echo "<div class='SP_CON shadow'>
            <div class='SP_CON1'>
                <img src='".$item->img."'>
            </div>
            <div class='SP_CON2'>
                <div>
                    <h3>".$item->tensp."</h3><br>
                    <a class='price'>".$item->gia." VNĐ</a><br>
                </div>
                <div style='padding-top: 20px;'>
                    <a onclick='' class='btn'>Thêm vào giỏ</a>
                </div>
            </div>
            </div>";
        }    
        ?>
    </div>
</div>
<div class="banner">
        <a class='more' href="index.php?id=product">Xem thêm</a>
</div>