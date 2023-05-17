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
	width:500px;
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
<form  method="POST" action="?view=show5&action=insertper" name="frmCapnhat" id="frmCapnhat">
<input name="maper" type="hidden" size="40" value="" />
<br>
<br><br>
<h3>Thêm quyền tài khoản</h3>
<table id="bang">
    <tr>
        <td>Nhóm quyền:</td>
        <td>
            <select name="manq" style="height:30px; width:170px; float:left; margin-left:40px"> 
            <?php
                $sql1 = "select * from nhomquyen where ma!='KH'";
                $result1 = dataProvider::executeQuery($sql1);
                while ($row1=mysqli_fetch_array($result1)){?>
                    <option value="<?=$row1['ma'] ?>"><?= $row1['ten'];?> </option>
            <?php }?>
            </select>
        </td>
    </tr>
  <tr>
    <td>Chức năng:</td>
    <td>
    <select name="maquyen" style="height:30px; width:170px; float:left; margin-left:40px"> 
    	<?php $sql2 = "select * from chucnang";
            $result2 = dataProvider::executeQuery($sql2);
            while ($row2=mysqli_fetch_array($result2)) {?>
            <option value="<?=$row2['maquyen'].$row2['tenquyen'];?>">  <?= $row2['tenquyen'];?> </option>
           <?php }?> 
    </select>
    </td>
  </tr>
   
  <tr>
    <td><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td><input name="btn_insert" type="submit" value="Thêm" id="btn_insert"/></td>
  </tr>
</table>


</form>
</div>
</body>
</html>