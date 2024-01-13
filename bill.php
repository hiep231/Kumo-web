<?php
    session_start();
    include "connectDB.php";
    include "thuvien.php";
    include "model_cart.php";
    // if (isset($_SESSION['user_id'])) {
    //     $user_id = $_SESSION['user_id'];
    // }
    // if (isset($_SESSION['admin_id'])) {
    //     $user_id = $_SESSION['admin_id'];
    // }
    if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
        $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
    }
    $isSave = false;
    $isTrue = true;
    $name = null;
    $address = null;
    $phone = null;
    
    $email = null;
    $promotion = null;


    $totalpromotion = 0;

    $note = null;

    $orderCode = null;

    if(isset($_POST['dongydathang'])&&($_POST['dongydathang'])) {
        // if (!isset($_SESSION['order_created']) || $_SESSION['order_created'] !== true) {
            $isSave = true;
            $isTrue = true;
            $name = $_POST['ten'];
            $address = $_POST['location'];
            $phone = $_POST['phone'];
            
            $email = $_POST['email'];
            $promotion = $_POST['promotion'];
            $sql = "SELECT * FROM promotion WHERE id = $promotion";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($r = mysqli_fetch_array($result)) {
                    $totalpromotion = intval($r['price']);
                }
            } else {
                $totalpromotion = 0;
            }
            $note = isset($_POST['customer_note']) ? $_POST['customer_note'] : "";

            $orderCode = "ORD" . rand(10000, 99999);
        //     $_SESSION['order_created'] = true;
        // }
    }
    //  else {
    //     unset($_SESSION['order_created']);
    // }
    // }
    echo '<script>
            let name = "' . $name . '";
            let address = "' . $address . '";
            let phone = "' . $phone . '";
            let email = "' . $email . '";
            let orderCode = "' . $orderCode . '";
            let note = "' . $note . '";
            let promotion = "' . $promotion . '";
            let totalpromotion = "' . $totalpromotion . '";
            let isSave = "' . $isSave . '";
        </script>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Clothes Shopping</title>
    <link rel="stylesheet" href="css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
<section id="page-header" class="about-header">           
    <h2>#LiênHệ</h2>
    <p>Để lại một tin nhắn, chúng tôi rất vui được nghe từ bạn!</p>
</section>
<div class="giohang"></div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    function Time() {
        const now = new Date();
        const year = now.getFullYear().toString();
        const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Tháng bắt đầu từ 0
        const day = now.getDate().toString().padStart(2, '0');
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const timeString = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        return timeString;
    }
    var time = Time();
    var showcart = JSON.parse(localStorage.getItem("showcart"));
    var idbill = JSON.parse(localStorage.getItem("idbill"));
    console.log(idbill);

    $.ajax({
        type: 'POST',
        url: 'billinfo.php',
        data: { 
            showcart: showcart, 
            name: name, 
            address: address, 
            phone: phone, 
            email: email,
            orderCode: orderCode,
            note: note,
            promotion: promotion,
            totalpromotion: totalpromotion,
            isSave: isSave,
            idBill: idbill,
            time: time
        },
        success: function(response) {
            console.log('Dữ liệu gửi thành công.');
            // add html từ a.php
            $('.giohang').html(response);
        },
        error: function(error) {
            console.error('Lỗi khi gửi dữ liệu:', error);
        }
    });
    function clearShowCart() {
        localStorage.removeItem('showcart');
    }
    clearShowCart();


</script>
    <?php 
        include 'footer.php'; 
        include 'header.php';
    ?>
</body>
</html>


