<?php
    session_start();
    
    // Xóa tất cả các biến session
    $_SESSION = array();
    
    // Huỷ session
    session_destroy();
    
    // Trả về phản hồi JSON
    $response = array('status' => 'success');
    echo json_encode($response);
?>