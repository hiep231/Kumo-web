<?php

// $spid = $_GET['sid'];
// echo $spid;

require_once 'connectDB.php';
if (isset($_GET['productid'])) {
    $spid = $_GET['productid'];
    $xoa_product = "DELETE FROM product WHERE id=$spid";
    mysqli_query($conn, $xoa_product);
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'add_home.php';
}

if (isset($_GET['accountid'])) {
    $spid = $_GET['accountid'];
    $xoa_account = "DELETE FROM users WHERE id=$spid";
    mysqli_query($conn, $xoa_account);
    $referer = 'listed_account.php';
}

if (isset($_GET['orderid'])) {
    $spid = $_GET['orderid'];
    $referer = 'listed_order.php';
    $xoa_order = "
    DELETE FROM orderitem WHERE orders = $spid;
    DELETE FROM orders WHERE id=$spid;";
    $conn->multi_query($xoa_order);
}

// $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'add_home.php';
header("Location: $referer");
?>
