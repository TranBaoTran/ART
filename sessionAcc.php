<?php
    session_start();
    if (isset($_SESSION['nhomquyen'])){
        $manq = $_SESSION['nhomquyen'];
        $_SESSION['nhomquyen'] = $manq;
    }
?>