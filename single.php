<?php
    $formDisplay=TRUE;
    if(isset($_POST['submit'])){
        $formDisplay=FALSE;
    }
    if($formDisplay){
        $db=new Database();
        if(isset($_GET["pr"])){
            $sql="select * from sanpham where masp='".$_GET["pr"]."'";
            $member = $db->NotPrepare($sql);
        }
        $db->close();
?>

<div class="form_background" id="LoginSpace">
        <form class="Login_Space"  style="width:50%" method="post" action="">
        <div class="title"><a id="close" href="javascript:history.go(-1)" style="text-decoration:none">X</a></div>
        <?php foreach ($member as $item){ 
            echo "<div class='singleSP'>
            <div class='SP_CON1'>
                <img src='".$item->img."'>
            </div>
            <div class='SP_CON2'>
                <div>
                    <h3>".$item->tensp."</h3><br>
                    <a class='price'>".$item->gia." VNĐ</a><br>
                    <a class='price'>Số lượng: <a><input type='number' name='quantity' min='1' max='".$item->soluong."' required value='1'>
                </div>
                <div style='padding-top: 20px;'>
                    <input type='hidden' name='pr' value='".$item->masp."'>
                    <input type='submit' class='btn' name='submit' value='Thêm vào giỏ'>
                </div>
            </div>
            </div>";
        }    
        ?>
        </form>
</div>

<?php }?>