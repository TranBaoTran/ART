<?php
class dataProvider{
    
    public static function executeQuery($sql){     
        include ('linker.php');
        $connection = mysqli_connect($servername,$username,$password,$database);
        if (!$connection)
            die("Couldn't connect to localhost");
        if (!(mysqli_select_db($connection,$database)))
            echo "Khong th ket noi 1";
        if (!(mysqli_query($connection,"set names 'utf8'")))
            echo "Khong the set utf8";
        if(!($result = mysqli_query($connection,$sql)))
            echo "Khong the ket noi 3";
        if (!(mysqli_close($connection)))
            echo "Khong th ket noi 4";
        return $result;
    }   
}
?>