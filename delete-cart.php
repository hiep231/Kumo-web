<?php

// Include the database connection file
require_once("connectDB.php");

// Get id parameter value from URL
$id = $_GET['id'];

// Create a new mysqli object
$mysqli = new mysqli("localhost", "root", "", "kumo");

// Delete order items first, then the order itself
$deleteOrderItemsSQL = "DELETE FROM orderitem WHERE orders = {$id}";
$deleteOrderSQL = "DELETE FROM orders WHERE id = {$id}";

if ($mysqli->query($deleteOrderItemsSQL) === TRUE) {
    if ($mysqli->query($deleteOrderSQL) === TRUE) {
        echo "Đã hủy đơn hàng thành công!";
    } else {
        echo "Lỗi khi hủy đơn hàng: " . $mysqli->error;
    }
} else {
    echo "Lỗi khi xóa các mục đơn hàng liên quan: " . $mysqli->error;
}

$mysqli->close();
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
