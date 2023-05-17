
<?php

$limit=10;
include_once("sqlconn.php");
$result = dataProvider::executeQuery("select count(madon) as total from donhang");
$row = mysqli_fetch_array($result);
$total = $row['total'];
$pagecount = ceil($total/$limit);

$page = isset($_GET["page"]) ? $_GET["page"] : 1 ;
	$page = max($page, 1);	//Nếu số trang < 1 thì cho số trang là 1
	$page = min($page, $pagecount);	//Nếu số trang > tổng số trang, thì cho bằng tổng số trang
	
	//+ Tính vị trí của dòng bắt đầu
	$start = ($page -1)*$limit;


	//include_once("../KETNOI/ketnoi.php");
	
	if(isset($_GET["manhinh"]) and $_GET["manhinh"]=="xemct")
		include_once("xemctDon_mh.php");

    include_once("ed_donhang.php");
?>

<div class="container" id="ad_body">
    <div id="bd_info"></div>
    <div style="padding-top:70px; padding-left:20px; padding-right:20px" id=bd_content>
    <h2 style="padding-top:40px" id="list">Danh Sách Đơn</h2>
    <br>
    <br>
<div>
    <table style="margin-left:120px;">
        <thead>
            <tr>
                <th>STT</th>
                <th style="width:100px">Mã đơn</th>
                <th style="width:200px">Mã khách hàng</th>
                <th style="width:100px">Ngày đặt</th>
                <th style="width:100px">Tổng tiền</th>
                <th style="width:150px">Tình trạng</th>
            </tr>
        </thead>
    <?php
        $count  = $start+1;
        include_once("sqlconn.php");
        $sql = "select * from donhang limit $start, $limit";
        $result = dataProvider::executeQuery($sql);
        while ($row=mysqli_fetch_array($result)){ ?>
            <tbody>
            <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row['madon']; ?></td>
            <td><?php echo $row['makh']; ?></td>
            <td><?php echo $row['ngaydat']; ?></td>
            <td><?php echo $row['tongtien']; ?></td>
            <td><?php if ($row['tinhtrang']==1){
                    echo "Đã xác nhận";
                }
                else if ($row['tinhtrang']==0){
                    echo "Chưa xác nhận";
                }
                ?>
            </td>
            <?php if ($row['tinhtrang']==1){ ?>
            <td><a href='?view=show3&action=cancelDon&madon=<?=$row['madon']; ?>' onClick="return confirm('Hủy xác nhận đơn hàng?')" class='active_icon' title='Hủy đơn'></a></td>
            <?php }
            if ($row['tinhtrang']==0){ ?>
            <td><a href='?view=show3&action=acceptDon&madon=<?=$row['madon']; ?>' onClick="return confirm('Xác nhận đơn hàng?')" class='delete_icon' title='Xác nhận đơn'></a></td>
            <?php } ?>
            <td><a href='?view=show3&manhinh=xemct&madon=<?=$row['madon']; ?>' class='eye_icon' title='Xem chi tiết đơn'></a></td>
            </tr>
            </tbody>
            <?php $count += 1;
            } ?>
    </table>
    <br>
    <br>
    <div class="pagination"> <a href="?view=show1&page=<?=$page-1;?>" class="page_num">&laquo;</a> <span class="active">
            <?php for($i=1; $i<=$pagecount; $i++) {?>
            <a href="?view=show3&page=<?=$i; ?>" class="page_num">
            <?=$i; ?>
            </a>
            <?php } ?>
            </span> <a href="?view=show3&page=<?=$page+1;?>" class="page_num">&raquo;</a> </div>
    </div>

</div>

<style>
.container {
    width: auto;
    padding-right: 30px;
    padding-left: 30px;
    margin-right: auto;
    margin-left: auto;
    align-content: center;
}
* {
    margin: 0;
    padding: 0;
    max-width: 100%;
}

table {
    width: auto;
    border-collapse: collapse;
    overflow: hidden;
    padding-top: 10px;
    margin-left: 30px;
}
a.edit_icon{
    background:url(img/icons/edit.gif) no-repeat left top;
    display:inline-block;
    width: 20px;
    height: 20px;
}
a.delete_icon{
    background:url(img/icons/action_delete.gif) no-repeat left top;
    display:inline-block;
    width: 20px;
    height: 20px;
}
a.eye_icon{
    background:url(img/icons/eye.png) no-repeat left top;
    display:inline-block;
    width: 40px;
    height: 40px;
}
a.active_icon{
    background:url(img/icons/action_check.gif) no-repeat left top;
    display:inline-block;
    width: 20px;
    height: 20px;
}
a.edit_inline{
    background:url(img/icons/edit.gif) no-repeat left top;
    display:inline-block;
    line-height:16px;
    color: #069 !important;
    font-size:10px;
    padding-left:20px;
    margin-right:5px;
}
a.delete_inline{
    background:url(img/icons/action_delete.gif) no-repeat left top;
    display:inline-block;
    line-height:16px;
    color: #D23333 !important;
    font-size:10px;
    padding-left:20px;
    margin-right:5px;
}
.page_num{
    float: left;
    height: 33px;
    padding-top: 7px ;
    width: 40px;
    font-size: 20px;
    margin: 10px;
    display: flex;
    justify-content: center;
    text-align: center;
    background-color: #ff80ab;
    color: #fffeee;
    z-index: 10;
}
.page_num.active{
    background-color:#c94f7c;
}
.page_num:hover{
    background-color: #c94f7c;
    cursor: pointer;
}
.btn_ins{
    height: 33px;
    padding-top: 7px ;
    width: 130px;
    font-size: 18px;
    margin: 10px;
    display: flex;
    justify-content: center;
    text-align: center;
    background-color: #ff80ab;
    color: #fffeee;
    z-index: 10;
    border: 0.2px solid #df678f;
    border-radius: 10%;
}
.btn_ins.active{
    background-color:#c94f7c;
}
.btn_ins:hover{
    background-color: #c94f7c;
    cursor: pointer;
}
.btn_con{
    padding: 20px;
    justify-content: center;
}
</style>