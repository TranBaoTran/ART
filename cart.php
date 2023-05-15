<script>
    function era(index){
        $.ajax({
                url:'/ART/api/eraPro.php',
                type: "POST",
                dataType: "text",
                data:{
                    index:index
                },
                success : function (data){
                    alert(data);
                    window.location.href="index.php?id=cart";
                },
                error: function(xhr, ajaxOptions, thrownError) {
                            console.log(thrownError);
                            alert('Lỗi sml r đừng cố');
                },
        });
    }
    function convertMoney(num){
        return num.toLocaleString('it-IT',{style: 'currency',currency: 'VND'})
    }
    function goCash(){
        printBillPlace();
        printBill();
    }
    function printBillList(){
        printOldBillPlace();
        printEachBill();
    }

    function printOldBillPlace(){
        const billPlace=document.getElementById("billPlace");
        const contentString=`<div class="form_background" id="LoginSpace" style="display: block;">
        <div class="Login_Space" style="top:60px;">
            <div class="title" style="font-size:20px ;"><div id="back" style="float:left;width:7%;display:none" onclick="printEachBill()"><i class="fa-solid fa-arrow-left"></i></div><b>HOÁ ĐƠN</b><div id="close" onclick="directURL('index.php?id=cart')">X</div></div>
            <div class="billContainer" id="billCon">
                </div>
            <div class="title" style="height:50px">
            
            </div>
        </div>`;
        billPlace.innerHTML=contentString;
    }
    function printBillPlace(){
        const billPlace=document.getElementById("billPlace");
        const contentString=`<div class="form_background" id="LoginSpace" style="display: block;">
        <div class="Login_Space" style="top:60px;">
            <div class="title" style="font-size:20px ;"><b>HOÁ ĐƠN</b><div id="close" onclick="directURL('index.php?id=cart')">X</div></div>
            <div class="billContainer" id="billCon">
                </div>
            <div class="title" style="height:100px">
            <p>Tổng : <span id="prTotal"></span></p>
            <button type="button" class="btn btn-success" style="cursor:pointer;" onclick="cashCart()">Thanh toán</button></div>
            </div>
        </div>`;
        billPlace.innerHTML=contentString;
    }
    function printBill(){
        const billCon=document.getElementById("billCon");
        let contentString='';
        <?php 
        function convertMoney($num) {
            return number_format($num, 0, ',', '.') . ' VND';
        }
        $html='';
        $tot=0;
                        if(isset($_SESSION['cart'])){
                            $db=new Database();
                            
                            foreach ($_SESSION['cart'] as $item) {
                                $sql="select * from sanpham where masp='".$item['ten']."'";
                                $pr=$db->getOne($sql);
                                $total=$pr->gia*$item['sl'];
                                $tot+=$total;
                                $html.='<div class="prCart shadow"><div class="prCart_it1"><img src="'.$pr->img.'"></div><div class="prCart_it2"><p>'.$pr->tensp.'</p><p>x'.$item['sl'].'</p><p>'.convertMoney($total).'</p></div></div>';
                            }
                            $db->close();
                        }
        if($tot){
            $_SESSION['total']=$tot;
        }
        ?>
        contentString=<?php echo "'".$html."'" ?>;
        billCon.innerHTML=contentString;    
        document.getElementById("prTotal").innerHTML+=convertMoney(<?php echo $tot?>);
    }
    
    function printEachBill(){
        const billCon=document.getElementById("billCon");
        let contentString='';
        <?php 
            if(isset($_SESSION['matk'])){
                $db=new Database();
                $sql="select * from donhang where makh='".$_SESSION['matk']."'";
                $member=$db->NotPrepare($sql);
                $html='';
                foreach ($member as $item) {
                    if($item->tinhtrang==0){
                        $tmp="Chờ xác nhận";
                        $cl=' style="color:red;" ';
                    }
                    else{
                        $tmp="Đã xác nhận";
                        $cl=' style="color:green;" ';
                    }
                    $html.='<div onclick="printBillItem('.$item->madon.')" class="prCart shadow"><div class="prCart_it1"><img src="img/icon1.png"></div><div class="prCart_it2"  style="width:45%"><p>Mã đơn hàng: '.$item->madon.'</p><p>'.convertMoney($item->tongtien).'</p><p '.$cl.'>'.$tmp.'</p></div></div>';
                }
                $db->close();
            }
        ?>
        contentString=<?php echo "'".$html."'" ?>;
        billCon.innerHTML=contentString;
        document.getElementById("back").style.display="none";
    }

    function printBillItem(ma){
        $.ajax({
            url:'/ART/api/renderEach.php',
            type: "POST",
            data: {
                masp:ma
            },
            dataType: "text",
            success : function (data){
                document.getElementById("billCon").innerHTML=data;
                document.getElementById("back").style.display="block";
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
                alert('Lỗi sml r đừng cố');
            },
        });
    }

    function cashCart(){
        $.ajax({
                url:'/ART/api/cash.php',
                type: "POST",
                dataType: "text",
                success : function (data){
                    alert(data);
                    window.location.href="index.php?id=cart";
                },
                error: function(xhr, ajaxOptions, thrownError) {
                            console.log(thrownError);
                            alert('Lỗi sml r đừng cố');
                },
        });
    }
</script>
<?php 
    if(isset($_SESSION['hoten']) && $_SESSION['hoten']){
?>
        <div style="width:100%;" >
       <div style="float: left;width:30%"> <h3 style="padding-left: 100px;padding-top: 75px;padding-bottom: 20px; font-size: 25px;"> GIỎ HÀNG </h3></div>
        <br><br>
        <table id="" class="table ">
            <thead id="head">
                <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th></th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tình trạng</th>
                    <th>Sửa đổi</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="keyCart">
                <?php 
                    if(isset($_SESSION['cart'])){
                        $db=new Database();
                        $html='';
                        $count=1;
                        foreach ($_SESSION['cart'] as $item) {
                            $sql="select * from sanpham where masp='".$item['ten']."'";
                            $pr=$db->getOne($sql);
                            $html.='<tr> 
                            <td>'.$count.'</td>
                            <td><img src="'.$pr->img.'"style="witdh:100px;height:100px"></td>
                            <td>'.$pr->tensp.'</td>
                            <td></td>
                            <td>'.$pr->gia.' VND</td>
                            <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$item['sl'].'</td>
                            <td style="color:red;">Chưa thanh toán</td>
                            <td id="eraBut"> 
                                 <input type="button" id="btxoa" value="Xóa" onclick="era('.($count-1).')">
                            </td>
                            <td></td>
                            </tr>';
                            $count++;
                        }
                        $db->close();
                        echo $html;
                    }
                ?>
            </tbody>
        </table>
        <div style="width:100%;text-align: center;padding-top: 50px;padding-bottom: 50px;">
            <button type="button" class="btn btn-success" style="cursor:pointer;" onclick="goCash()">Mua hàng</button>
            <button type="button" class="btn btn-success" style="cursor:pointer; margin-left: 50px;" onclick="printBillList()">Xem lại đơn hàng</button>
    </div>
    <div id="billPlace"><div>
<?php }
else{
    echo "<script>directURL('index.php?id=none')</script>";
}?>

