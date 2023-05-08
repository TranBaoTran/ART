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
<!-- 
<script>
    function renderP(currentPage,allPage){
        let html="";
        let start=1;
        let end=5;
        if(currentPage-2>0){
            start=currentPage-2;
            end=currentPage+2;
        }
        if(currentPage+2>allPage){
            start=allPage-4;
            end=allPage;
        }
        if(allPage<=5){
            start=1;
            end=allPage;
        }
        if(currentPage>1){
            html+="<a href='#/'><div class='page_num' onclick='find(1,"+limit+")'><i class='fa-solid fa-angles-left'></i></div></a> ";
            html+="<a href='#/'><div class='page_num' onclick='getPro("+(currentPage-1)+","+limit+")'><i class='fa-solid fa-angle-left'></i></div></a> ";
        }
        for(let i=start;i<=end;i++){
            html+="<a href='#/'><div class='page_num";
            if(i==currentPage){
                html+=" active'>"+i+"</div></a> ";
            }
            else{
                html+="' onclick='find("+i+","+limit+")'>"+i+"</div></a> ";
            }
        }
        if(currentPage<allPage){
            html+="<a href='#/'><div class='page_num' onclick='getPro("+(currentPage+1)+","+limit+")'><i class='fa-solid fa-angle-right'></i></div></a> ";
            html+="<a href='#/'><div class='page_num' onclick='getPro("+allPage+","+limit+")'><i class='fa-solid fa-angles-right'></i></div></a> ";
        }
        $("#pageWraper").html(html); 
    }

    function find(page=1,limit=9){
        var name=document.getElementById("name").value;
        var type=document.getElementById("type").value;
        var minRanger=document.getElementById("minRanger").value;
        var maxRanger=document.getElementById("maxRanger").value;
        var now=window.location.href;
        if(!now.includes("id=product")){
            window.location.href="index.php?id=product";
        }
        $.ajax({
          url:"/ART/api/getFind.php?name="+name+"&type="+type+"&min="+minRanger+"&max="+maxRanger+"&limit="+limit+"&page="+page,
          type: "GET",
          dataType: 'json',
            success : function (result){
                var html="";
                $.each(result['member'], function (key, item){
                                html += "<div class='SP_CON shadow'><div class='SP_CON1'><img src='"+item['img']+"'></div>";
                                html += "<div class='SP_CON2'><div><h3>"+item['tensp']+"</h3><br><a class='price'>"+item['gia']+" VNĐ</a><br></div>";
                                html += "<div style='padding-top: 20px;'><a class='btn' >Thêm vào giỏ</a></div></div></div>";
                             });             
                $('#productWraper').html(html);
                $('#outCon').css('display', 'none');
                renderP(result.current_page,result.allPage,result.limit);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                        alert('Lỗi sml r đừng cố');
            },
        });
    }
</script> -->
