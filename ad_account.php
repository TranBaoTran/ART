
<?php

$limit=10;
include_once("sqlconn.php");
$result = dataProvider::executeQuery("select count(matk) as total from taikhoan where tinhtrang=1");
$row = mysqli_fetch_array($result);
$total = $row['total'];
$pagecount = ceil($total/$limit);

$page = isset($_GET["page"]) ? $_GET["page"] : 1 ;
	$page = max($page, 1);	//Nếu số trang < 1 thì cho số trang là 1
	$page = min($page, $pagecount);	//Nếu số trang > tổng số trang, thì cho bằng tổng số trang
	
	//+ Tính vị trí của dòng bắt đầu
	$start = ($page -1)*$limit;


	//include_once("../KETNOI/ketnoi.php");
	
	if(isset($_GET["manhinh"]) and $_GET["manhinh"]=="insertacc")
		include_once("insertacc_mh.php");
    if(isset($_GET["manhinh"]) and $_GET["manhinh"]=="editacc")
		include_once("editacc_mh.php");	

    include_once("ed_account.php");
?>

<div class="container" id="ad_body">
    <div id="bd_info"></div>
    <div style="padding-top:70px; padding-left:20px; padding-right:20px" id=bd_content>
    <h2 style="padding-top:40px" id="list">Danh Sách Tài Khoản</h2>
    <br>
    <div style="margin-left: 1050px"><a href="?view=show2&manhinh=insertacc" class="btn_ins" type="button">Thêm tài khoản</a></div>
    <br>
<div>
    <table style="margin-left:100px;">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã tài khoản</th>
                <th style="width:250px">Tên đăng nhập</th>
                <th style="width:200px">Ngày tạo</th>
                <th>Nhóm quyền</th>
                <th style="width: 150px">Tình trạng</th>
            </tr>
        </thead>
    <?php
        $count  = $start+1;
        include_once("sqlconn.php");
        $sql = "select * from taikhoan limit $start, $limit";
        $result = dataProvider::executeQuery($sql);
        while ($row=mysqli_fetch_array($result)){ ?>
            <tbody>
            <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row['matk']; ?></td>
            <td><?php echo $row['tendn']; ?></td>
            <td><?php echo $row['ngaytao']; ?></td>
            <td><?php echo $row['nhomquyen']; ?></td>
            <td><?php if ($row['tinhtrang']==1){
                    echo "Hoạt động";
                }
                else if ($row['tinhtrang']==0){
                    echo "Khóa";
                }
                ?>
            </td>
            <td><a href='?view=show2&manhinh=editacc&matk=<?=$row['matk']; ?>.&manhomq=<?= $row['nhomquyen'];?>' class='edit_icon' title='Sửa'></a></td>
            <?php if ($row['tinhtrang']==1){ ?>
            <td><a href='?view=show2&action=lockac&matk=<?=$row['matk']; ?>' onClick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này không ?')" class='delete_icon' title='Khóa'></a></td>
            <?php }
            if ($row['tinhtrang']==0){ ?>
            <td><a href='?view=show2&action=activeac&matk=<?=$row['matk']; ?>' onClick="return confirm('Bạn có chắc chắn muốn kích hoạt tài khoản này không ?')" class='active_icon' title='Kích hoạt'></a></td>
            <?php } ?>
            <td style="align:right">&nbsp;</td>
            <td style="align:right"></td>
            </tr>
            </tbody>
            <?php $count += 1;
            } ?>
    </table>
    <br>
    <br>
    <div class="pagination"> <a href="?view=show1&page=<?=$page-1;?>" class="page_num">&laquo;</a> <span class="active">
            <?php for($i=1; $i<=$pagecount; $i++) {?>
            <a href="?view=show1&page=<?=$i; ?>" class="page_num">
            <?=$i; ?>
            </a>
            <?php } ?>
            </span> <a href="?view=show1&page=<?=$page+1;?>" class="page_num">&raquo;</a> </div>
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