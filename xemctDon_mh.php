<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../css/text.css"/>
<link rel="stylesheet" type="text/css" href="../css/reset.css"/>
<link rel="stylesheet" type="text/css" href="../css/960.css"/>
<link rel="stylesheet" type="text/css" href="../css/smoothness/ui.css"/>

<?php 
  global $madon;
	$madon = (isset($_REQUEST["madon"])) ? $_REQUEST["madon"] : "0";	
	$sql = "select dh.madon, dh.makh, kh.hoten, dh.ngaydat, dh.tongtien from donhang dh join ctdon ct on dh.madon = ct.madon join khachhang kh on dh.makh = kh.matk where dh.madon='$madon'";

    include_once("sqlconn.php");
    global $result;
    $result = dataProvider::executeQuery($sql);
    global $row;
    $row = mysqli_fetch_array($result);
?>

<style>
*{
	margin:0;
	padding:0;
}
.sua{
	margin:10px auto;
	padding:0;
	width:850px;
	height:auto;
	clear:both;
}
.sua h3{
	background: #c9114e;
	border-radius:5px;
	height:30px;
	text-align:center;
	line-height:30px;
	color:#fff;
}
#bang{
  display: flex;
	margin: 10px auto;
	width: 850px;
  border:1px solid #000;
}
#bang tr{
    padding:1px;
}
#bang td{
	padding:10px;
}
#btn_img{
    width: 60px;
    height: 30px;
    background-color: #ffe7ef;
    border: 0.2px solid #df678f;
    border-radius: 13%;
}
#btn_exitct{
    width: 60px;
    height: 30px;
    background-color: #ffe7ef;
    border: 0.2px solid #df678f;
    border-radius: 13%;
    margin-right: 60px;
    float: right;
    margin-bottom: 20px;
    margin-top: 8px;
}
</style>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>

<body>
<div class="sua">
<form method="POST" action="?view=show3">
<input name="masp" type="hidden" size="40" value="<?=$row['madon']; ?>" />
<br>
<br><br>
<h3>Xem chi tiết đơn hàng</h3>
<table id="bang">
  <tr>
    <td style="">Mã đơn:</td>
    <td style="height:25px; width:100px; float:left; margin-left:20px"><?= $row['madon']; ?></td>
  </tr>
  <tr>
    <td style="width:150px;">Mã khách hàng:</td>
    <td style="height:25px; width:100px; float:left; margin-left:20px"><?= $row['makh']; ?></td>
  </tr>
  <tr>
    <td style="">Tên khách hàng:</td>
    <td style="height:25px; float:left; margin-left:20px"><?= $row['hoten']; ?></td>
  </tr>
  <tr>
    <td style="">Ngày đặt:</td>
    <td style="height:25px; float:left; margin-left:20px"><?= $row['ngaydat']; ?></td>
  </tr>
  <tr>
    <td style="text-align:left; padding-left:50px" colspan="3">Sản phẩm:</td>
    <td style="height:25px; width:150px; float:right; margin-right:50px">Tổng tiền: &nbsp;<?= $row['tongtien']; ?></td>
  </tr>
  <tr>
    <td style="">Tên sản phẩm</td>
    <td style="">Hình ảnh</td>
    <td style="">Số lượng</td>
    <td style="">Đơn giá</td>
  </tr>
    <?php
      $sql1 = "select sp.tensp, sp.img, ct.soluong, sp.gia from ctdon ct join sanpham sp on ct.masp = sp.masp where ct.madon=$madon;";
      $result1 = dataProvider::executeQuery($sql1);
        foreach ($result1 as $row1){?>
        <tr>
    		  <td style="width:300px"><?= $row1['tensp'];?></td>
          <td><img style="width: 60%" src="<?=$row1['img']?>"></td>
          <td style="width:100px"><?=$row1['soluong']?></td>
          <td style="width:100px"><?=$row1['gia']?></td>
        </tr>
      <?php }?>
  <tr>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td style="" colspan="4"><input name="exitct" type="submit" value="Thoát" id="btn_exitct"/></td>
  </tr>
</table>


</form>
</div>
</body>
</html>