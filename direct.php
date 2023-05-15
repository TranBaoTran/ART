<?php 
     if(isset($_GET["id"])){
        switch($_GET["id"]){
            case 'about':
                include "aboutus.php";
                break;
            case 'product':
                include "product.php";
                break;
            case 'find':
                include "find.php";
                break;
            case 'cart':
                include "cart.php";
                break;
            case 'none':
                include "none.php";
                break;
        }
     }
     else{
            include "frontpage.php";
     }
?>