<?php 
    include_once "database.php";
    $cl="";
    $db=new database();
    $sql="select";
    $db->Close();
?>
<style>
.top_container a{
    text-decoration:none;
    color:#fffeee;
}
.top_container a:hover{
    color:#ff80ab;
}
</style>
<script>
    function findRE(){
    const FP = document.getElementById("Find_Space");
    FP.innerHTML = '<input id="txtInput" type="text" style="width:30%" placeholder="Nhập sản phẩm muốn tìm" onload="makeFocus();">' +
        '<select id="brandInput" style="width:20%; height:35px; margin-left:5px"><option value=0>--Hãng--</option><option value=1>Innisfree</option><option value=2>Maybelline</option><option value=3>Hadalabo</option></select>' +
        '<select id="priceInput" style="width:20%; height:35px; margin-left:5px"><option value=0>--Giá tiền--</option><option value=1>Dưới 100.000 VNĐ</option><option value=2>Dưới 500.000 VNĐ</option><option value=3>Dưới 1.000.000 VNĐ</option><option value=4>Trên 1.000.000 VNĐ</option></select>' +
        '<a class="findBtn" onclick="renderNBP(1);" ><i class="fa-solid fa-magnifying-glass"></i></a>';
    }

    function menu2() {
        var M2 = document.getElementById("top2");
        if (M2.style.display === "none") {
            M2.style.display = 'flex';
        } else {
            M2.style.display = 'none';
        }
    }

    function HOME(){
        location.href='index.php';
    }
    
</script>
<div class="top">
        <div class="top_container" id="noneCart" onclick="noAcc()"><i class="fa-solid fa-cart-shopping"></i> &nbspGIỎ HÀNG</i></div>
        <div class="top_container hidden" id="userCart" onclick="goCart()"><a href="index.php?id=cart"><i class="fa-solid fa-cart-shopping"></i> &nbspGIỎ HÀNG</i><a></div>
        <div class="top_container" id="Signin_Button"><a href="index.php?form=sig"><i class="fa-solid fa-right-to-bracket"></i>&nbspĐĂNG KÝ</a></div>
        <div class="top_container" id="Login_Button"><a href="index.php?form=log"><i class="fa-solid fa-user"></i> &nbspĐĂNG NHẬP</a></div>
        <div class="top_container_name sub-menu-parent hidden" id="userMenu" ><i class="fa-solid fa-user"></i><span id="menuUsername">&nbspUser</span> 
            <ul class="sub-menu">
                <li id="logoutButton" style="padding-top:10px ;padding-bottom:10px;display: block;" onclick="Logout()"><i class="fa-solid fa-right-to-bracket"></i>&nbspĐĂNG XUẤT</li>
            <ul>
        </div>
        <div class="top_container_name" style="float: left;width:200px;cursor: pointer;" onclick="HOME();">
            <img src="img/logo1.png" style="top:0;margin: 0;padding: 0;height: 50px;">
        </div>
        <div class="top_container" style="width: 30px;float: left;" onclick="menu2()"><i class="fas fa-bars" ></i></div>
        <div class="top_container" style="float: left;" id="Find_Button" onclick="findRE();"><i class="fa-brands fa-product-hunt"></i>&nbspTÌM KIẾM</div>
        <div class="name" style="width: 35%;" id='Find_Space'></div>

    <?php 
    if(isset($_GET["form"])){
        switch($_GET["form"]){
            case 'log':
                include_once "login.php";
                break;
            case 'sig':
                include_once "signin.php";
                break;
        }
    }
    ?>        
</div>
