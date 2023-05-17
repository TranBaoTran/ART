<?php 
include_once("sqlconn.php");
$thongbao = "";
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
switch($action)
{
	case "insertper":
		$thongbao = insertPer();
		break;
	case "deleteper":
		$thongbao = deletePer();
		break;		
}

//----------------------------------------------------------------------------
function insertPer()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql = "select * from phanquyen where manq='$acct'";
	$result = dataProvider::executeQuery($sql);
	while ($row = mysqli_fetch_array($result)){
		if ($row['maquyen'] == 107){
			$manq = isset($_POST["manq"]) ? $_POST["manq"] : "";
            $txt = isset($_POST["maquyen"]) ? $_POST["maquyen"] : "";
            $maquyen = substr($txt,0,3);
            $tenquyen = substr($txt,3);
            $sql1 = "select * from phanquyen where manq='$manq'";
        	$result1 = dataProvider::executeQuery($sql1);
            while ($row1 = mysqli_fetch_array($result1)){
                if ($row1['maquyen'] == $maquyen){
                    echo "<script>alert('Nhóm quyền hiện đã có chức năng này.')</script>";
                    return;
                }
            }
            $sql2 = "insert into phanquyen(manq,maquyen,tenquyen) values('$manq',$maquyen,N'$tenquyen')";
            dataProvider::executeQuery($sql2);
			echo "<script>alert('Đã thêm chức năng cho nhóm quyền này.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
//----------------------------------------------------------------------
function deletePer()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql = "select * from phanquyen where manq='$acct'";
	$result = dataProvider::executeQuery($sql);
	while ($row = mysqli_fetch_array($result)){
		if ($row['maquyen'] == 107){
			$manq = isset($_POST["manq"]) ? $_POST["manq"] : "";
            $txt = isset($_POST["maquyen"]) ? $_POST["maquyen"] : "";
            $maquyen = substr($txt,0,3);
            $tenquyen = substr($txt,3);
            $sql1 = "select * from phanquyen where manq='$manq'";
        	$result1 = dataProvider::executeQuery($sql1);
            while ($row1 = mysqli_fetch_array($result1)){
                if ($row1['maquyen'] == $maquyen){
                    $sql2 = "delete from phanquyen where maquyen=$maquyen and manq='$manq'";
                    dataProvider::executeQuery($sql2);
                    echo "<script>alert('Đã xóa chức năng ".$tenquyen." của nhóm quyền này.')</script>";
                    return;
                }
            }
			echo "<script>alert('Nhóm quyền hiện không có chức năng này để xóa.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
?>
