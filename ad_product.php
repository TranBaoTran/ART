
<?php

$limit=10;
include_once("sqlconn.php");
$result = dataProvider::executeQuery("select count(masp) as total from sanpham where tinhtrang=1");
$row = mysqli_fetch_array($result);
$total = $row['total'];
$pagecount = ceil($total/$limit);

$page = isset($_GET["page"]) ? $_GET["page"] : 1 ;
	$page = max($page, 1);	//Nếu số trang < 1 thì cho số trang là 1
	$page = min($page, $pagecount);	//Nếu số trang > tổng số trang, thì cho bằng tổng số trang
	
	//+ Tính vị trí của dòng bắt đầu
	$start = ($page -1)*$limit;


	//include_once("../KETNOI/ketnoi.php");
	
	if(isset($_GET["manhinh"]) and $_GET["manhinh"]=="insertpr")
		include_once("insert_mh.php");		
	else if(isset($_GET["manhinh"]) and $_GET["manhinh"]=="editpr")
		include_once("edit_mh.php");

    include_once("ed_product.php");
?>

<div class="container" id="ad_body">
    <div id="bd_info"></div>
    <div style="padding-top:70px; padding-left:20px; padding-right:20px" id=bd_content>
    <h2 style="padding-top:40px" id="list">Danh Sách Sản Phẩm</h2>
    <br>
    <div style="margin-left: 1050px"><a href="?view=show1&manhinh=insertpr" class="btn_ins" type="button">Thêm sản phẩm</a></div>
    <br>
<div>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Thương hiệu</th>
                <th >Tên sản phẩm</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th style="width:70px">Tồn kho</th>
                <th style="width:70px">Doanh số</th>
            </tr>
        </thead>
    <?php
        $sort = isset($_GET["sort"]) ? $_GET["sort"] : 1 ;
        $count  = $start+1;
        include_once("sqlconn.php");
        if ($sort == 1){
        $sql = "select * from sanpham where tinhtrang=1 limit $start, $limit";
        $result = dataProvider::executeQuery($sql); ?>
        <div style="display:flex"><a href="?view=show1&sort=abc" class="sort" title="Sắp xếp theo tên sản phẩm"></a></div>
        <?php
        while ($row=mysqli_fetch_array($result)){?>
            <tbody>
            <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row['masp']; ?></td>
            <td><?php echo $row['hang']; ?></td>
            <td><?php echo $row['tensp']; ?></td>
            <td><?php echo $row['gia']; ?></td>
            <td><img src='<?php echo $row['img']; ?>' width=50%></td>
            <td><?php echo $row['soluong']; ?></td>
            <td><?php echo $row['slmua']; ?></td>
            <td><a href='?view=show1&manhinh=editpr&masp=<?=$row['masp']; ?>' class='edit_icon' title='Sửa'></a></td>
            <td><a href='?view=show1&action=deletepr&masp=<?=$row['masp']; ?>' onClick="return confirm('Bạn có chắc chắn muốn xóa SP này không ?')" class='delete_icon' title='Xóa'></a></td>
            <td style="align:right">&nbsp;</td>
            <td style="align:right"></td>
            </tr>
            </tbody>
            <?php $count += 1;
            }}
            else{
                $sql = "select * from sanpham where tinhtrang=1 order by tensp asc limit $start, $limit";
                $result = dataProvider::executeQuery($sql);
                while ($row=mysqli_fetch_array($result)){?>
                    <tbody>
                    <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row['masp']; ?></td>
                    <td><?php echo $row['hang']; ?></td>
                    <td><?php echo $row['tensp']; ?></td>
                    <td><?php echo $row['gia']; ?></td>
                    <td><img src='<?php echo $row['img']; ?>' width=50%></td>
                    <td><?php echo $row['soluong']; ?></td>
                    <td><?php echo $row['slmua']; ?></td>
                    <td><a href='?view=show1&manhinh=editpr&masp=<?=$row['masp']; ?>' class='edit_icon' title='Sửa'></a></td>
                    <td><a href='?view=show1&action=deletepr&masp=<?=$row['masp']; ?>' onClick="return confirm('Bạn có chắc chắn muốn xóa SP này không ?')" class='delete_icon' title='Xóa'></a></td>
                    <td style="align:right">&nbsp;</td>
                    <td style="align:right"></td>
                    </tr>
                    </tbody>
                    <?php $count += 1;
                    }
                ?>
                <div style="display:flex"><a href="?view=show1" class="sort" title="Sắp xếp theo mã"></a></div>
            <?php }?>
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
a.sort{
    background:url(img/icons/ssorts.png) no-repeat left top;
    display:inline-block;
    width: 30px;
    height: 30px;
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