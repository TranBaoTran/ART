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
  include_once("sqlconn.php");
?>

<style>
*{
	margin:0;
	padding:0;
}
.sua{
	margin:10px auto;
	padding:0;
	width:700px;
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
	margin:10px auto;
	width:700px;
	border:1 solid #000;
	line-height:40px;
}
#bang tr{
	border:1px solid #000;
}
#bang td{
	padding:0 0 0 10px;
}
#btn_img{
    width: 60px;
    height: 30px;
    background-color: #ffe7ef;
    border: 0.2px solid #df678f;
    border-radius: 13%;
}
#btn_insert{
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
<?php 
	$sql="select *from loaisp ";
	//$loai= $pdo->query($sql);

	$sql="select *from nhacungcap ";
	//$nhacc= $pdo->query($sql);
?>
</head>

<body>
<div class="sua">
<form  method="POST" action="?view=show1&action=insertsp" name="frmCapnhat" id="frmCapnhat" enctype="multipart/form-data">
<input name="masp" type="hidden" size="40" value="" />
<br>
<br><br>
<h3>Thêm sản phẩm</h3>
<table id="bang">
  <tr>
    <td>Tên sản phẩm:</td>
    <td><input style="height:25px; width:400px; float:left; margin-left:40px" name="tensp" type="text" id="tensp" value="" /></td>
  </tr>
  <tr>
    <td>Mã sản phẩm:</td>
    <td><input style="height:25px; width:170px; float:left; margin-left:40px" name="masp" type="text" id="masp" value="" /></td>
  </tr>
  <tr>
    <td>Đơn giá:</td>
    <td><input style="height:25px; width:170px; float:left; margin-left:40px" name="gia" type="text" id="gia" value="" /></td>
  </tr>
  <tr>
    <td>Mã loại:</td>
    <td>
    <select name="malsp" style="height:30px; width:170px; float:left; margin-left:40px"> 
    <?php
        $sql1 = "select * from theloai";
        $result1 = dataProvider::executeQuery($sql1);
        while ($row1=mysqli_fetch_array($result1)){?>
            <option value="<?=$row1['malsp'] ?>"><?= $row1['tenlsp'];?> </option>
           <?php }?>
    </select>
    </td>
  </tr>
  <tr>
    <td>Hãng sản xuất</td>
    <td>
    <select name="hang" style="height:30px; width:170px; float:left; margin-left:40px"> 
    	<?php $sql2 = "select * from sanpham group by mahang";
            $result2 = dataProvider::executeQuery($sql2);
            while ($row2=mysqli_fetch_array($result2)) {?>
            <option value="<?=$row2['mahang'].$row2['hang']; ?>">  <?= $row2['hang'];?> </option>
           <?php }?> 
    </select>
    </td>
  </tr>
   <tr>
    <td>Hình ảnh:</td>
    <td> <input style="height:25px; float:left; margin-left:40px" name="img" type="file" id="hinhanh" value="">
  <!--<input type="button" style="height:23px; float:left; margin-left:20px" name="Button" id="btn_img" value="Upload" onClick="window.open('uploadImg.php','','width=500,height=100, status=false')">-->
 </td>
  </tr>
   
  <tr>
    <td>Tồn kho:</td>
    <td><input style="height:25px; width:80px; float:left; margin-left:40px" name="soluong" type="text" id="soluong" value="" /></td>
  </tr>
  <tr>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><input name="btn_insert" type="submit" value="Thêm" id="btn_insert"/></td>
  </tr>
</table>


</form>
</div>
</body>
<script>
  function exit{
    window.location = "ad_main.php?view=show1";
  }
</script>
</html>