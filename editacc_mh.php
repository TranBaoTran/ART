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
	$matk = (isset($_REQUEST["matk"])) ? $_REQUEST["matk"] : "";	
    $manq = (isset($_REQUEST["manq"])) ? $_REQUEST["manq"] : "";
	$sql = "select * from taikhoan where matk='$matk'";

    include_once("sqlconn.php");
    $result = dataProvider::executeQuery($sql);
    global $row;
    $row = mysqli_fetch_array($result);
?>
</head>

<body>
<div class="sua">
<form  method="POST" action="?view=show2&action=editacc" name="frmCapnhat" id="frmCapnhat">
<input name="matk" type="hidden" size="40" value="" />
<br>
<br><br>
<h3>Sửa thông tin tài khoản</h3>
<table id="bang">
    <tr>
        <td>Tên đăng nhập:</td>
        <td><input style="height:25px; width:220px; float:left; margin-left:40px" name="tendn" type="text" id="tendn" value="<?= $row['tendn']; ?>" /></td>
    </tr>
    <tr>
        <td>Mật khẩu:</td>
        <td><input style="height:25px; width:220px; float:left; margin-left:40px" name="pass" type="password" id="pass" value="<?= $row['matkhau']; ?>" /></td>
    </tr>
    <tr>
        <td>Nhóm quyền:</td>
        <td>
            <select name="manq" style="height:30px; width:110px; float:left; margin-left:40px"> 
            <?php
                $sql1 = "select * from nhomquyen where ma!='KH'";
                $result1 = dataProvider::executeQuery($sql1);
                while ($row1=mysqli_fetch_array($result1)){?>
                <?php
                    if($row1['ma']==$manq){?>
    		            <option value="<?=$row1['ma'] ?>" selected="selected"><?= $row1['ten'];?> </option>
                <?php }
                    else { ?>
                        <option value="<?=$row1['ma'] ?>"><?= $row1['ten'];?> </option>
                <?php }
                }?>
            </select>
        </td>
    </tr>
    <tr>
        <td><!--DWLayoutEmptyCell-->&nbsp;</td>
        <td><input name="btn_insert" type="submit" value="Sửa" id="btn_insert"/></td>
  </tr>
</table>


</form>
</div>
</body>
</html>