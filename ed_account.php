<?php 
include_once("sqlconn.php");
$thongbao = "";
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
include_once("sessionAcc.php");
switch($action)
{
	case "editacc":
		$thongbao = editacc();
		break;
	case "insertacc":
		$thongbao = newacc();
		break;
	case "activeac":
		$thongbao = activeAcc();
		break;
	case "lockac":
		$thongbao = lockAcc();
		break;		
}

//----------------------------------------------------------------------------
function editacc()
{
	$manqf = isset($_POST["manqf"]) ? $_POST["manqf"] : "";
	if ($manqf == 'KH'){
		echo "<script>alert('Loại tài khoản này không thể chỉnh sửa thông tin.')</script>";
		return;
	}
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql1 = "select * from phanquyen where manq='$acct'";
	$result1 = dataProvider::executeQuery($sql1);
	while ($row = mysqli_fetch_array($result1)){
		if ($row['maquyen'] == 105){
			$matk = isset($_POST["matk"]) ? $_POST["matk"] : "";
			$tendn = isset($_POST["tendn"]) ? $_POST["tendn"] : "";
			$manq = isset($_POST["manq"]) ? $_POST["manq"] : "";

			$sql = "update taikhoan set tendn='$tendn', nhomquyen='$manq' where matk='$matk'";
        	dataProvider::executeQuery($sql);

			echo "<script>alert('Đã sửa thông tin tài khoản.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
function newacc()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$tendn = isset($_POST["tendn"]) ? $_POST["tendn"] : "";
	$pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
	$manq = isset($_POST["manq"]) ? $_POST["manq"] : "";
	$sql1 = "select * from phanquyen where manq='$acct'";
	$result1 = dataProvider::executeQuery($sql1);
	while ($row = mysqli_fetch_array($result1)){
		if ($row['maquyen'] == 105){
			$date = getdate();
			$d = $date['year']."-".$date['mon']."-".$date['mday'];
			$tendn = isset($_POST["tendn"]) ? $_POST["tendn"] : "";
			$pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
			$manq = isset($_POST["manq"]) ? $_POST["manq"] : "";
			$pass = md5($pass);
            $sql = "insert into taikhoan(tendn,matkhau,ngaytao,nhomquyen,tinhtrang) values ('$tendn','$pass','$d','$manq',1)";
        	dataProvider::executeQuery($sql);
			echo "<script>alert('Đã thực hiện tạo tài khoản.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
//----------------------------------------------------------------------------
function activeAcc()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql1 = "select * from phanquyen where manq='$acct'";
	$result1 = dataProvider::executeQuery($sql1);
	while ($row = mysqli_fetch_array($result1)){
		if ($row['maquyen'] == 103){
			$matk = isset($_GET["matk"]) ? $_GET["matk"] : "";
            $sql1 = "update taikhoan set tinhtrang=1 where matk='$matk'";
        	dataProvider::executeQuery($sql1);
			echo "<script>alert('Đã kích hoạt tài khoản này.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
//----------------------------------------------------------------------
function lockAcc()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql = "select * from phanquyen where manq='$acct'";
	$result = dataProvider::executeQuery($sql);
	while ($row = mysqli_fetch_array($result)){
		if ($row['maquyen'] == 104){
			$matk = isset($_GET["matk"]) ? $_GET["matk"] : "";
			$sql1 = "update taikhoan set tinhtrang=0 where matk='$matk'";
        	dataProvider::executeQuery($sql1);
			echo "<script>alert('Đã khóa tài khoản này.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
?>
