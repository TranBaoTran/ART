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
            case 'log':
                include_once "login.php";
                break;
            case 'sig':
                include_once "signin.php";
                break;
        }
     }
     else{
            include "frontpage.php";
     }
?>