<?php 
    class user{
        private $name;
        private $pass;

        function __construct($name,$pass){
            $this->name=$name;
            $this->pass=$pass;
        }

        function checkLog(){
            require_once 'database.php';
            $db=new Database();
            if($db->getName($this->name,$this->pass)){
                echo "<script>alert('Đăng nhập thành công')</script>";
            }
            else{
                echo "<script>alert('Đăng nhập không thành công')</script>";
            }
            $db->close();
        }
    }
?>