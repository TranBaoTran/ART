<?php
session_start();

if (isset($_SESSION['cart']) && isset($_POST['index']) && is_array($_SESSION['cart'])) {
    $key=$_POST['index'];
    unset($_SESSION['cart'][$key]);
    if (!isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        echo "Đã xóa sản phẩm khỏi giỏ hàng.";
    } else {
        echo "Không thể xóa sản phẩm khỏi giỏ hàng.";
    }
}
else{
    echo "Đã xảy ra lỗi. Không thể xoá sản phẩm ra khỏi giỏ";
}
?>