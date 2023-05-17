
<?php
$kichthuoctrang=10;
$tongsodong = 326;
$tongsotrang = ceil($tongsodong/$kichthuoctrang);

$page = isset($_GET["page"]) ? $_GET["page"] : 1 ;
	$page = max($page, 1);	//Nếu số trang < 1 thì cho số trang là 1
	$page = min($page, $tongsotrang);	//Nếu số trang > tổng số trang, thì cho bằng tổng số trang
	
	//+ Tính vị trí của dòng bắt đầu
	$dongbatdau = ($page -1)*$kichthuoctrang;


	//include_once("../KETNOI/ketnoi.php");
	
	if(isset($_GET["manhinh"]) and $_GET["manhinh"]=="themmoisp")
		include_once("MH_thaydoisp.php");		
	else if(isset($_GET["manhinh"]) and $_GET["manhinh"]=="manhinhsuasp")
		include_once("MH_SUASP.php");

?>

<div class="container" id="ad_body">
    <div id="bd_info"></div>
    <div style="padding-top:70px; padding-left:20px; padding-right:20px" id=bd_content>
    <h2 id="list">Danh Sách Sản Phẩm</h2>
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
        $count  = $dongbatdau+1;
        include "sqlconn.php";
        $arr = [];
        $sql = "select * from sanpham limit $dongbatdau, $kichthuoctrang";
        $result = dataProvider::executeQuery($sql);
        while ($row=mysqli_fetch_array($result)){
            echo "<tbody>
            <tr>
            <td>".$count."</td>
            <td>".$row['masp']."</td>
            <td>".$row['hang']."</td>
            <td>".$row['tensp']."</td>
            <td>".$row['gia']."</td>
            <td><img src='".$row['img']."' width=50%></td>
            <td>".$row['soluong']."</td>
            <td>".$row['slmua']."</td>
            <td><a href='?view=show1&manhinh=manhinhsuasp&masp=".$row['masp']."' class='edit_icon' title='Sửa'></a></td>
            <td><a href='?view=show1&action=xoasp&masp=".$row['masp']."' onClick='Xacnhan();' class='delete_icon' title='Xóa'></a></td>
            <td align='right'>&nbsp;</td>
            <td align='right'>
            </tr>
            </tbody>";
            $count += 1;
        }
    ?>
    </table>
 
    <div class="pagination"> <a href="?view=show1&page=<?=$page-1;?>" class="next">&laquo; Previous</a> <span class="active">
            <?php for($i=1; $i<=$tongsotrang; $i++) {?>
            <a href="?view=show1&page=<?=$i; ?>" class="<?=($i==$page)? "tranghientai": "page"; ?>">
            <?=$i; ?>
            </a>
            <?php } ?>
            </span> <a href="?view=show1&page=<?=$page+1;?>" class="next">Next &raquo;</a> </div>
    </div>

</div>

<script>
    function Xacnhan(){
        return confirm('Bạn có chắc chắn muốn xóa SP này không ?');
    }
</script>

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
</style>