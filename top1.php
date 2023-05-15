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
    

    function close_log(){
        var fs= document.getElementById("outCon");
        fs.style.display = 'none';
    }
</script>
<div class="top" style="z-index:100">
        <div class="top_container" id="userCart" onclick="goCart()"><a href="index.php?id=cart"><i class="fa-solid fa-cart-shopping"></i> &nbspGIỎ HÀNG</i><a></div>
        <?php 
        session_start();
        if(isset($_SESSION['hoten']) && $_SESSION['hoten']){
            $html='<div class="top_container_name sub-menu-parent" id="userMenu" ><i class="fa-solid fa-user"></i><span id="menuUsername">&nbsp'.$_SESSION['hoten'].'</span> 
                        <ul class="sub-menu">
                            <li id="logoutButton" style="padding-top:10px ;padding-bottom:10px;display: block;" onclick="LogOut()"><i class="fa-solid fa-right-to-bracket"></i>&nbspĐĂNG XUẤT</li>
                        <ul>
                    </div>';
            echo $html;
        }
        else{
            $html='<div class="top_container" id="Signin_Button"><a href="index.php?form=sig"><i class="fa-solid fa-right-to-bracket"></i>&nbspĐĂNG KÝ</a></div>
            <div class="top_container" id="Login_Button"><a href="index.php?form=log"><i class="fa-solid fa-user"></i> &nbspĐĂNG NHẬP</a></div>';
            echo $html;
        }
        ?>
        <!-- <div class="top_container" id="Signin_Button"><a href="index.php?form=sig"><i class="fa-solid fa-right-to-bracket"></i>&nbspĐĂNG KÝ</a></div>
        <div class="top_container" id="Login_Button"><a href="index.php?form=log"><i class="fa-solid fa-user"></i> &nbspĐĂNG NHẬP</a></div>
        <div class="top_container_name sub-menu-parent hidden" id="userMenu" ><i class="fa-solid fa-user"></i><span id="menuUsername">&nbspUser</span> 
            <ul class="sub-menu">
                <li id="logoutButton" style="padding-top:10px ;padding-bottom:10px;display: block;" onclick="Logout()"><i class="fa-solid fa-right-to-bracket"></i>&nbspĐĂNG XUẤT</li>
            <ul>
        </div> -->
        <div class="top_container_name" style="float: left;width:200px;cursor: pointer;" onclick="HOME();">
            <img src="img/logo1.png" style="top:0;margin: 0;padding: 0;height: 50px;">
        </div>
        <div class="top_container" style="width: 30px;float: left;" onclick="menu2()"><i class="fas fa-bars" ></i></div>
        <div class="top_container" style="float: left;" id="Find_Button"><a href="index.php?id=find"><i class="fa-brands fa-product-hunt"></i>&nbspTÌM KIẾM</a></div>
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

<script>
    function LogOut(){
        $.ajax({
            url: "/ART/api/logOut.php",
            type: "POST",
            dataType: 'json',
            success : function (response){
                if (response.status === 'success') {
                             window.location.href = 'index.php';
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                        alert('Lỗi sml r đừng cố');
            },
        });
    }
</script>

