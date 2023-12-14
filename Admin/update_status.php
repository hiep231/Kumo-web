<?php
require_once 'connectDB.php';

// if (isset($_GET['orderId'])) {
//     $orderId = $_GET['orderId'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dropdownContent"])) {
    $dropdownContent = $_POST["dropdownContent"];
    $orderId = $_POST['id'];
    // echo $dropdownContent;

    // Lưu nội dung vào biến PHP hoặc xử lý nó theo nhu cầu của bạn
    // Ví dụ:
    // $content = $dropdownContent;
    // echo $content; // Phản hồi lại nội dung nếu cần


$updateSql = "UPDATE orders SET statusName = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $updateSql);
mysqli_stmt_bind_param($stmt, "si", $dropdownContent, $orderId);

if (mysqli_stmt_execute($stmt)) {
    // header("Location: listed_order.php");
    exit();
} else {
    echo 'Update failed. Please try again.';
}

mysqli_stmt_close($stmt);
}
else {
    echo 'Invalid request.';
}

mysqli_close($conn);
?>
