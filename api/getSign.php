<?php 
    if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['mail']) && isset($_POST['uname']) && isset($_POST['pass'])){
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $mail=$_POST['mail'];
        $uname=$_POST['uname'];
        $pass=$_POST['pass'];
        // echo "$name $phone $mail $uname $pass";
        $pass=md5($pass);

        include_once "../database.php";
        $db=new Database(); 

        $sql="Select sdt from khachhang where sdt='".$phone."'";
        if($db->check($sql) == -1){
            echo "-1";
            die();
        }
        
        $sql="Select mail from khachhang where mail='".$mail."'";
        if($db->check($sql) == -1){
            echo "-2";
            die();
        }

        $sql="Select tendn from taikhoan where tendn='".$uname."'";
        if($db->check($sql) == -1){
            echo "-3";
            die();
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date=date('Y-m-d',time());

        $dataTK=[
            'tendn' => $uname,
            'matkhau' => $pass,
            'nhomquyen' => 'KH'
        ];        

        if($db->InsertTK($dataTK)){
            $sql="select matk as total from taikhoan where tendn='$uname'";
            $ma=$db->Take($sql);
            $dataKH=[
                'matk' => $ma,
                'hoten' => $name,
                'sdt' => $phone,
                'mail' => $mail
            ];
            if($db->InsertKH($dataKH)){
                $db->close();
                echo "1";
                die();
            }
            else{
                echo "-4";
            }
        }
        else{
            echo "-5";
        }   
        $db->close();
    }
    else{
        echo "0";
    }
?>