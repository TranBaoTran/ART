<?php 
include_once("sqlconn.php");
$thongbao = "";
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
switch($action)
{
	case "insertsp":
		$thongbao = themSPMoi();
		break;
	case "capnhatsp":
		$thongbao = suaThongtinSP();
		break;
	case "deletepr":
		$thongbao = xoaThongtinSP();
		break;		
}

//----------------------------------------------------------------------------
function themSPMoi()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql1 = "select * from phanquyen where manq='$acct'";
	$result1 = dataProvider::executeQuery($sql1);
	while ($row = mysqli_fetch_array($result1)){
		if ($row['maquyen'] == 101){
			$tensp = isset($_POST["tensp"]) ? $_POST["tensp"] : "";
			$gia = isset($_POST["gia"]) ? $_POST["gia"] : "";
			$malsp = isset($_POST["malsp"]) ? $_POST["malsp"] : "";
			$hangf = isset($_POST["hang"]) ? $_POST["hang"] : "";
			$mahang = substr($hangf,0,2);
			$hang = substr($hangf,2);
			$soluong = isset($_POST["soluong"]) ? $_POST["soluong"] : "";

			$target_dir = "dbimg/";
			$target = $target_dir . basename($_FILES["img"]["name"]);
			
			if ($tensp == ''){
				echo "<script>alert('Tên sản phẩm không được để trống')</script>";
				return;
			}
			if ($gia == '' || $gia <= 0){
				echo "<script>alert('Giá sản phẩm không được để trống và phải lớn hơn 0')</script>";
				return;
			}
			if ($malsp == ''){
				echo "<script>alert('Mời chọn loại sản phẩm không được để trống')</script>";
				return;
			}
			if ($hangf == ''){
				echo "<script>alert('Mời chọn hãng sản phẩm không được để trống')</script>";
				return;
			}
			if ($soluong == ''){
				echo "<script>alert('Số lượng sản phẩm không được để trống')</script>";
				return;
			}
			if(isset($_FILES["img"]["name"]))
			{
				$target = $target_dir . basename($_FILES["img"]["name"]);
				$uploaded_type=$_FILES["img"]["type"];
				$uploaded_size=$_FILES["img"]["size"];
				$ok=1;
				//Kiểm tra kích thước file upload 
				if ($uploaded_size > 3500000) 
				{ 
					echo "<script> alert('Kích thước tập tin upload vượt quá 3,5MB.')</script>"; 
					$ok=0; 
				} 
	
				//Kiểm tra dạng tập tin upload (file type)
				if (!($uploaded_type=="image/gif" || $uploaded_type=="image/pjpeg" || $uploaded_type=="image/jpeg" ||$uploaded_type =="text/php" || $uploaded_type=="image/png")) 
				{ 
					echo "<script> alert('Chỉ upload tập tin dạng GIF, JPG, JEPG, PHP) </script>"; 
					$ok=0; 
				}
				if (is_dir($target)) 
				{ 
					echo "<script> alert('Thư mục '.$target.'chứa tập tin không tồn tại') </script>"; 			
					$ok=0;
				}
				if ($ok==0) 
				{ 
					//echo "Sorry your file was not uploaded";
					echo "<script> alert('Lỗi tập tin không được tải lên')</script>";
					return;
				} 	
				else
				{ 		
					if(move_uploaded_file($_FILES['img']['tmp_name'], $target)) 
				{ 
					$success="thanhcong";
					//echo "Tập tin ". basename( $_FILES['uploaded']['name']). " đã được upload xong."; 
				} 
				else 
				{ 
					if ($_FILES['img']['error'] > 0)
					{
						switch ($_FILES['img']['error'])
						{
							case 1:					
								echo "<script> alert('File quá dung lượng cho phép.')</script>";
								break;
							case 2:
								echo "<script> alert('File quá dung lượng cho phép.')</script>";
								break;
							case 3:
								echo "<script> alert('File upload chưa xong.')</script>";
								break;
							case 4:
								echo "<script> alert('Không có file nào được tải lên.')</script>";
								break;
						}
						return;
					} 
				}
			}
		}
			$rown = mysqli_fetch_array(dataProvider::executeQuery("select masp from sanpham where masp=(select max(masp) from sanpham)"));
			$masp = $rown['masp']+1;
		
			$sql = "insert into sanpham(masp,tensp,hang,soluong,img,malsp,tinhtrang,mahang,slmua,gia) values ('$masp','$tensp','$hang',$soluong,'$target','$malsp',1,'$mahang',0,'$gia')";
    		dataProvider::executeQuery($sql);
			echo "<script>alert('Đã thực hiện thêm sản phẩm')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
function suaThongtinSP()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql1 = "select * from phanquyen where manq='$acct'";
	$result1 = dataProvider::executeQuery($sql1);
	while ($row = mysqli_fetch_array($result1)){
		if ($row['maquyen'] == 101){
			$masp = isset($_POST["masp"]) ? $_POST["masp"] : "";
			$tensp = isset($_POST["tensp"]) ? $_POST["tensp"] : "";
			$gia = isset($_POST["gia"]) ? $_POST["gia"] : "";
			$malsp = isset($_POST["malsp"]) ? $_POST["malsp"] : "";
			$hang = isset($_POST["hang"]) ? $_POST["hang"] : "";
			$soluong = isset($_POST["soluong"]) ? $_POST["soluong"] : "";
			$target_dir = "dbimg/";
			$target = $target_dir . basename($_FILES["img"]["name"]);
			//Kiểm tra xem có file nào được submit không?
			if(isset($_FILES["img"]["name"]))
			{
				$target = $target_dir . basename($_FILES["img"]["name"]);
				$uploaded_type=$_FILES["img"]["type"];
				$uploaded_size=$_FILES["img"]["size"];
				$ok=1;
				//Kiểm tra kích thước file upload 
				if ($uploaded_size > 3500000) 
				{ 
					echo "<script> alert('Kích thước tập tin upload vượt quá 3,5MB.')</script>"; 
					$ok=0; 
				} 
	
				//Kiểm tra dạng tập tin upload (file type)
				if (!($uploaded_type=="image/gif" || $uploaded_type=="image/pjpeg" || $uploaded_type=="image/jpeg" ||$uploaded_type =="text/php" || $uploaded_type=="image/png")) 
				{ 
					echo "<script> alert('Chỉ upload tập tin dạng GIF, JPG, JEPG, PHP) </script>"; 
					$ok=0; 
				}
				if (is_dir($target)) 
				{ 
					echo "<script> alert('Thư mục '.$target.'chứa tập tin không tồn tại') </script>"; 			
					$ok=0;
				}
		
	//Kiểm tra biến giá trị biến $ok (bằng 0 là có lỗi)
	//Ngược lại nếu không có lỗi, tiến hành upload tập tin
				if ($ok==0) 
				{ 
					//echo "Sorry your file was not uploaded";
					echo "<script> alert('Lỗi tập tin không được tải lên')</script>";
					return;
				} 	
				else
				{ 		
					if(move_uploaded_file($_FILES['img']['tmp_name'], $target)) 
				{ 
					$success="thanhcong";
					//echo "Tập tin ". basename( $_FILES['uploaded']['name']). " đã được upload xong."; 
				} 
				else 
				{ 
					if ($_FILES['img']['error'] > 0)
					{
						switch ($_FILES['img']['error'])
						{
							case 1:					
								echo "<script> alert('File quá dung lượng cho phép.')</script>";
								break;
							case 2:
								echo "<script> alert('File quá dung lượng cho phép.')</script>";
								break;
							case 3:
								echo "<script> alert('File upload chưa xong.')</script>";
								break;
							case 4:
								echo "<script> alert('Không có file nào được tải lên.')</script>";
								break;
						}
						return;
					} 
				}
			}
		}

			$sql = "update sanpham set tensp='$tensp', gia='$gia', malsp='$malsp', hang='$hang', soluong='$soluong', img='$target' where masp='$masp'";
    		dataProvider::executeQuery($sql);
			echo "<script>alert('Đã thực hiện sửa sản phẩm.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
//----------------------------------------------------------------------
function xoaThongtinSP()
{
	if (isset($_SESSION['nhomquyen'])){
		$acct = $_SESSION['nhomquyen'];
	}
	$sql = "select * from phanquyen where manq='$acct'";
	$result = dataProvider::executeQuery($sql);
	while ($row = mysqli_fetch_array($result)){
		if ($row['maquyen'] == 102){
			$masp = isset($_GET["masp"]) ? $_GET["masp"] : "";
			$sql1 = "update sanpham set tinhtrang=0 where masp='$masp'";
        	dataProvider::executeQuery($sql1);
			echo "<script>alert('Đã thực hiện xóa sản phẩm.')</script>";
			return;
		}
	}
	echo "<script>alert('Bạn hiện không có quyền hạn thực hiện hành động này')</script>";
	return;
}
?>
