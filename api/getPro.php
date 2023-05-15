<?php 
    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $ten=$_POST['prName'];
    $sl=$_POST['prQuantity'];

    foreach ($_SESSION['cart'] as $item) {
        if ($item['ten'] == $ten) {
            echo "Sản phẩm đã có sẵn trong giỏ";
            die();
        }
    }

    $_SESSION['cart'][] = array(
        'ten' => $ten,
        'sl' => $sl
    );
    
    echo "Thêm sản phẩm thành công";
?>