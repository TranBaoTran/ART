<?php 
     if(isset($_GET["id"])){
        switch($_GET["id"]){
            case 'about':
                include "aboutus.php";
                break;
            case 'news':
                break;
            case 'product':
                include "product.php";
                break;
            case 'cart':
                break;
        }
     }
     else{
            include "frontpage.php";
     }
?>