<html>
<link rel="stylesheet" href="css/admin.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="js/admin.js"></script>
<script src="https://kit.fontawesome.com/ba199146f8.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
    </script>
    <?php 
        session_start();
    include "ad_header.php";?>
    <?php
        $view = isset($_REQUEST["view"]) ? $_REQUEST["view"]: "" ;
		switch($view){
            case "show1":
                include "ad_product.php";
                break;
            case "show2":
                include "ad_account.php";
                break;
            case "show3":
                include "ad_donhang.php";
                break;
            case "show4":
                include "thongke.php";
                break;
            case "show5":
                include "ad_permission.php";
                break;
        }
    ?>

</html>    