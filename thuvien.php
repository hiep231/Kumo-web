<?php
function taogiohang($orders_last_id,$product,$price,$quantity,$size,$images){
    $conn=ketnoidb();
    $sql = "INSERT INTO orderitem(orders,product,price,quantity,size,images) VALUES ('$orders_last_id','$product','$price','$quantity','$size','$images')";
    // use exec() because no results are returned
    $conn->exec($sql);
    $conn = null;
}
function taodonhang($orderCode,$phone,$note,$location,$email,$totalAmount,$totalAmountTemporary,$promotion,$totalPromotion,$time,$customer,$user){
    $conn=ketnoidb();

    $sql = "INSERT INTO orders(orderCode,statusName,phone,note,location,email,totalAmount,totalAmountTemporary,promotion,totalPromotion,time,customer,user) VALUES ('$orderCode','Đang xử lí','$phone','$note','$location','$email','$totalAmount','$totalAmountTemporary','$promotion','$totalPromotion','$time','$customer','$user')";
    $conn->exec($sql);
    $lastOrderIdForUser = getLastOrderIdForUser($user);
    $conn = null;
    return $lastOrderIdForUser;
}
function getLastOrderIdForUser($user) {
    $conn = ketnoidb();

    // Sử dụng Prepared Statements để tránh SQL injection
    $sql = "SELECT id FROM orders WHERE user = :user ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user', $user);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;
    return !empty($result['id']) ? $result['id'] : null;
}

function ketnoidb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kumo";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
        
    } catch(PDOException $e) {
       return $e->getMessage();
    }
    $conn = null;
}
// function tongdonhangbill(){
//     $tong=0;
//     if(isset($_SESSION['showcart'])&&(is_array($_SESSION['showcart']))){
//         if(sizeof($_SESSION['showcart'])>0){
            
//             for ($i=0; $i < sizeof($_SESSION['showcart']); $i++) { 
//                 $tt=floatval($_SESSION['showcart'][$i][1]) * floatval($_SESSION['showcart'][$i][3]);
//                 $tong+=$tt;
//             }
            
//         }  
//     }
//     return $tong;
// }
function tongdonhangbill($showcart) {
    $tong = 0;

    foreach ($showcart as $item) {
        $tt = floatval($item[1]) * floatval($item[3]);
        $tong += $tt;
    }

    return $tong;
}
// function tongSoLuong($sql) {
//     $soluong = 0;
//     while ($r = mysqli_fetch_array($sql)) {
//         $soluong += $r['quantity'];
//     }
//     return $soluong;
// }
?>



