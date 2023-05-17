<header style="font-family:sans-serif;top: 0;margin: 0;padding: 0;max-width: 100%;position: sticky; z-index: 999;">
    <div class="top">
        <div class="top_container sub-menu-parent"><i class="fa-solid fa-user"></i>&nbspADMIN
            <ul class="sub-menu">
                <li style="padding-top:10px ;padding-bottom:10px" onclick="Logout();"><i class="fa-solid fa-right-from-bracket"></i>&nbspĐăng xuất</li>
                <ul>
        </div>
        <div class="top_container_name" style="float: left;width:297px;">
            <img src="img/logo.png" style="top:0;margin: 0;padding: 0;height: 50px;">
        </div>
        <div class="top_container" style="width: 43px;float: left;" onclick="menu2()"><i class="fas fa-bars"></i></div>
    </div>
    <div style="display: none;width: 100%;" id="top2">
        <div class="top2">
            <nav>
                <ul id="main-menu">
                    <li>
                        <a href="?view=show1" id="show1" class="menubox"><i class="fa-brands fa-product-hunt"></i>&nbspSản phẩm</a>
                    </li>
                    <li>
                        <a href="?view=show2" id="show2"class="menubox" ><i class="fa-solid fa-users"></i>&nbspTài khoản</a>
                    </li>
                    <li>
                        <a href="?view=show3" id="show3" class="menubox"><i class="fa-solid fa-pen-to-square"></i>&nbspĐơn hàng</a>
                    </li>
                    <li>
                        <a href="?view=show4" class="menubox"><i class="fa-solid fa-chart-simple"></i>&nbspThống kê</a>
                    </li>
                    <li>
                        <a href="?view=show5" class="menubox"><i class="fa-solid fa-users"></i>&nbspQuyền hạn</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>    
</header>

<script>
    function Logout(){
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