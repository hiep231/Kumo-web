<?php
require_once '../connectDB.php';

// if (isset($_GET['orderId'])) {
//     $orderId = $_GET['orderId'];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userId"])) {
    $userId = $_POST["userId"];

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $isAdmin = $row['isAdmin'];
        // $isUser = $row['isUser'];

        // Đảo ngược vai trò (nếu là Admin thì đổi thành Khách hàng, ngược lại)
        // $user = ($isUser == 1) ? 0 : 1;
        $admin = ($isAdmin == 1) ? 0 : 1;

        // Cập nhật vai trò trong cơ sở dữ liệu
        $updateSql = "UPDATE users SET isAdmin = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ii", $admin, $userId);
        if ($updateStmt->execute()) {
            echo "Cập nhật thành công!";
        } else {
            echo "Lỗi cập nhật: " . $updateStmt->error;
        }
        $updateStmt->close();
    }
}
else {
    echo 'Invalid request.';
}

mysqli_close($conn);
?>