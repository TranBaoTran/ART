<?php 
include_once("sqlconn.php");
$thongbao = "";
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
switch($action)
{
	case "acceptDon":
		$thongbao = activeDon();
		break;
	case "cancelDon":
		$thongbao = cancelDon();
		break;		
}
function activeDon()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql1 = "select * from phanquyen where manq='$acct'";
	$result1 = dataProvider::executeQuery($sql1);
	while ($row = mysqli_fetch_array($result1)){
		if ($row['maquyen'] == 106){
			$madon = isset($_GET["madon"]) ? $_GET["madon"] : "";
            $sql1 = "update donhang set tinhtrang=1 where madon='$madon';";
        	dataProvider::executeQuery($sql1);
			$sql2 = "select ct.soluong as 'sl', sp.soluong, sp.masp from ctdon ct join sanpham sp on ct.masp = sp.masp where ct.madon = $madon";
			$result2 = dataProvider::executeQuery($sql2);
			while ($row1 = mysqli_fetch_array($result2)){
				$totaln = $row1['soluong'] - $row1['sl'];
				$slmua = $row1['sl'];
				$masp = $row1['masp'];
				dataProvider::executeQuery("update sanpham set soluong=$totaln, slmua=$slmua where masp='$masp'; ");
			}
			echo "<script>alert('Đã xác nhận đơn hàng.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
//----------------------------------------------------------------------
function cancelDon()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql = "select * from phanquyen where manq='$acct'";
	$result = dataProvider::executeQuery($sql);
	while ($row = mysqli_fetch_array($result)){
		if ($row['maquyen'] == 106){
			$madon = isset($_GET["madon"]) ? $_GET["madon"] : "";
			$sql1 = "update donhang set tinhtrang=0 where madon='$madon'";
        	dataProvider::executeQuery($sql1);
			$sql2 = "select ct.soluong as 'sl', sp.soluong, sp.masp, sp.slmua from ctdon ct join sanpham sp on ct.masp = sp.masp where ct.madon = $madon";
			$result2 = dataProvider::executeQuery($sql2);
			while ($row1 = mysqli_fetch_array($result2)){
				$totaln = $row1['soluong'] + $row1['sl'];
				$slmua = $row1['slmua'] - $row1['sl'];
				$masp = $row1['masp'];
				dataProvider::executeQuery("update sanpham set soluong=$totaln, slmua=$slmua where masp='$masp'");
			}
			echo "<script>alert('Đã hủy xác nhận đơn hàng.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
?>
