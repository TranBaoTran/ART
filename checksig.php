<?php 
    if(!isset($_POST['logn'])){
        die('');
    }

    include_once "database.php";

    $name=trim($_POST['fulln']);
    $phone=trim($_POST['phone']);
    $mail=trim($_POST['mail']);
    $logName=trim($_POST['logn']);
    $pass=trim($_POST['pass']);

    $pass=md5($pass);

    $db=new Database(); 
    
    $sql="Select tendn from taikhoan where tendn='".$logName."'";
    if($db->check($sql) == -1){
        echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    $sql="Select sdt from khachhang where sdt='".$phone."'";
    if($db->check($sql) == -1){
        echo "Số điện thoại này đã có người dùng. Vui lòng điền số điện thoại khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    
    $sql="Select mail from khachhang where mail='".$mail."'";
    if($db->check($sql) == -1){
        echo "Email này đã có người dùng. Vui lòng điền email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date=date('Y-m-d',time());

    $dataTK=[
        'tendn' => $logName,
        'matkhau' => $pass,
        'nhomquyen' => 'KH'
    ];

    if($db->InsertTK($dataTK)){
        $sql="select matk as total from taikhoan where tendn='$logName'";
        $ma=$db->Take($sql);
        $dataKH=[
            'matk' => $ma,
            'hoten' => $name,
            'sdt' => $phone,
            'mail' => $mail
        ];
        if($db->InsertKH($dataKH)){
            echo "Đăng ký thành công. <a href='index.php'>Về trang chủ</a>";
            $db->close();
            die();
        }
        else{
            echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='index.php?form=sig'>Thử lại</a>";
        }
    }   
    $db->close();
?>