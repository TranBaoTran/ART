
<!DOCTYPE html>
<html>
<?php include "head.php" ?>
<?php
    include_once "user.php";
    if(isset($_POST['logna']) && isset($_POST['passw'])){
        $u=new user($_POST['logna'],$_POST['passw']);
        $u->checkLog();
    }
?>
<header style="font-family:sans-serif;top: 0;margin: 0;padding: 0;max-width: 100%;position: sticky;">
<?php include "top1.php"; 
      include "top2.php";
?>
</header>
<body>
    <?php include "slide.php" ?>
    <?php include "direct.php" ?>
</body>
<footer>
    <?php include "foot.php" ?>
</footer>
</html>
