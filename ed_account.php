<?php 
include_once("sqlconn.php");
$thongbao = "";
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

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
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$matk = isset($_GET["matk"]) ? $_GET["matk"] : "";
	$manq1 = isset($_GET["manhomq"]) ? $_GET["manhomq"] : "";
	if ($manq1 == "KH"){
		echo "<script>alert('Nhóm tài khoản này không thể thực hiện sửa thông tin.')</script>";
		return;
	}
	$sql1 = "select * from phanquyen where manq='$acct'";
	$result1 = dataProvider::executeQuery($sql1);
	while ($row = mysqli_fetch_array($result1)){
		if ($row['maquyen'] == 105){
			$tendn = isset($_POST["tendn"]) ? $_POST["tendn"] : "";
			$pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
			$manq2 = isset($_POST["manq"]) ? $_POST["manq"] : "";
			echo "<script>alert('Đã $matk sửa $manq1 thông tin $manq2 tài khoản.')</script>";
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
            $sql1 = "insert into taikhoan(tendn,matkhau,ngaytao,nhomquyen,tinhtrang) values ('$tendn','$pass','$d','$manq',1)";
        	dataProvider::executeQuery($sql1);
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
