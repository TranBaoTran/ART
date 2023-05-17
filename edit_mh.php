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

	$masp = (isset($_REQUEST["masp"])) ? $_REQUEST["masp"] : "0";	
	$sql = "SELECT * FROM sanpham  WHERE masp = '$masp'";

    include_once("sqlconn.php");
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
#btn_edit{
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
<form  method="POST" action="?view=show1&action=capnhatsp" name="frmCapnhat" id="frmCapnhat" enctype="multipart/form-data">
<input name="masp" type="hidden" size="40" value="<?=$row['masp']; ?>" />
<br>
<br><br>
<h3>Sửa thông tin sản phẩm</h3>
<table id="bang">
  <tr>
    <td>Tên sản phẩm:</td>
    <td><input style="height:25px; width:400px; float:left; margin-left:40px" name="tensp" type="text" id="tensp" value="<?= $row['tensp']; ?>" /></td>
  </tr>
  <tr>
    <td>Đơn giá:</td>
    <td><input style="height:25px; width:170px; float:left; margin-left:40px" name="gia" type="text" id="gia" value="<?= $row['gia']; ?>" /></td>
  </tr>
  <tr>
    <td>Mã loại:</td>
    <td>
    <select name="malsp" style="height:30px; width:170px; float:left; margin-left:40px"> 
    <?php
        $sql1 = "select * from theloai";
        $result1 = dataProvider::executeQuery($sql1);
        while ($row1=mysqli_fetch_array($result1)){?>
    		<?php if($row1['malsp']==$row['malsp']){?>
    		<option value="<?=$row1['malsp'] ?>" selected="selected"><?= $row1['tenlsp'];?> </option>
            <?php }else { ?>
            <option value="<?=$row1['malsp'] ?>"><?= $row1['tenlsp'];?> </option>
           <?php }?> 
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
            while ($row2 = mysqli_fetch_array($result2)) {?>
            <?php if($row2['hang']==$row['hang']){?>
    		<option value="<?=$row2['hang'] ?>"  selected="selected">  <?= $row2['hang'];?> </option>
            <?php }else { ?>
            <option value="<?=$row2['hang'] ?>">  <?= $row2['hang'];?> </option>
           <?php }?> 
    		
            <?php }?>
    </select>
    </td>
  </tr>
   <tr>
    <td>Hình ảnh:</td>
    <td> <input style="height:25px; float:left; margin-left:40px" type="file" name="img" value="<?=$row['img'];?>">
  <!--<input type="button" style="height:23px; float:left; margin-left:20px" name="Button" id="btn_img" value="Upload" onClick="window.open('uploadImg.php','','width=500,height=100, status=false')">-->
 </td>
  </tr>
   
  <tr>
    <td>Tồn kho:</td>
    <td><input style="height:25px; width:80px; float:left; margin-left:40px" name="soluong" type="text" id="soluong" value="<?= $row['soluong']; ?>" /></td>
  </tr>
  <tr>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><input name="hinhanh" type="submit" value="Sửa" id="btn_edit"/></td>
  </tr>
</table>


</form>
</div>
</body>
</html>