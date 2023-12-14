<?php
include "thuvien.php";
include "connectDB.php";
// Assuming $_POST['showcart'] contains the array
session_start();
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
    $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
    // echo $user_id;
    if (isset($_POST['showcart'])) {
        $showcart = $_POST['showcart'];
        // $idbill = $_POST['idbill'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $time = $_POST['time'];
        // $totalTemp = $_POST['totalTemp'];
        $orderCode = $_POST['orderCode'];
        $note = isset($_POST['note']) ? $_POST['note'] : "Không có";
        $totalTemp = 0;
        if ($showcart) {
            $totalTemp = tongdonhangbill($showcart);
        }
        // echo $totalTemp;
        $totalpromotion = $_POST['totalpromotion'];

        $totalAmount = $totalTemp - $totalpromotion;
        
        $promotion = $_POST['promotion'];

        $isSave = $_POST['isSave'];
        // echo $isSave;
        // echo $isSave;
        // echo $totalpromotion;
        if (empty($isSave) || $isSave == "true") {
            // $idbill = $_POST['idBill'];
            $idbill = getLastOrderIdForUser($user_id);
            // echo $idbill;
        } else {
            $idbill = taodonhang($orderCode,$phone,$note,$address,$email,$totalAmount,$totalTemp,$promotion,$totalpromotion,$time,$name,$user_id);
            // echo $idbill;
        }
        // echo $idbill;

        ?>
        <!-- <script>
            localStorage.setItem('idbill', <?php echo json_encode($idbill); ?>);
        </script> -->
        <?php
        if ($showcart) {
            foreach ($showcart as $item) {
                $hinh = $item[0];
                $price = $item[1];
                $productName = $item[2];
                $quantity = $item[3];
                $size = $item[4];
                $idsp = $item[5];
                $thanhtien = floatval($price) * floatval($quantity);

                if ($isSave == 1) {
                    taogiohang($idbill,$productName,$price,$quantity,$size,$hinh);
                };
            }
        }
        if (isset($user_id)){
            $sql_orders = "SELECT * FROM orders WHERE user = $user_id ORDER BY id DESC; ";
            $result_orders = mysqli_query($conn, $sql_orders);
            if (mysqli_num_rows($result_orders) > 0) {
                while ($row = mysqli_fetch_array($result_orders)) {
                    if ($idbill != null){
                        $sql_orderitem = "SELECT product, images,size,quantity,price FROM orderitem WHERE orders = '" . $row['id'] . "'";
                        
                        // echo $sql_orderitem; exit;
                        $result_orderitem = mysqli_query($conn, $sql_orderitem);
                        // if ($result_orderitem != null){
                            // echo '</div class="giohang1">';
                        echo '<div class="element-giohang">
                            <div class="header">
                            <h1><i class="bx bx-cart"></i> Giỏ hàng</h1>
                            <p>' . mysqli_num_rows($result_orderitem) . ' loại sản phẩm</p>
                        </div>
                
                        <div class="layout-2column">
                            <div class="layoutcolumn1" style="padding: 10px 20rem 10px 0;">
                                <div class="listcart">';
                        // mysqli_data_seek($result_orderitem, 0);
                        while ($r = mysqli_fetch_array($result_orderitem)) {
                            echo '<div class="cart">
                                    <img src="'.$r['images'].'" alt="">
                                    <div class="infoproduct">
                                        <p>' . $r['product'] . '</p>
                                        <p>Size: '.$r['size'] . '</p>
                                        <p>Số lượng: ' . $r['quantity'] . '</p>
                                        <p>' . number_format($r['price'], 0, ",", ".") . ' VND</p>
                                    </div>
                                </div>';
                        }
                    }
                    echo '</div>
                        </div>
                        <div class="layoutcolumn2">
                            <p style="font-size:1.5rem; font-weight: bold;"><i class="bx bx-map-alt"></i> Thông tin đơn hàng</p>                    
                            <p style="margin: 10px 0;">' . $row['statusName'] . '</p>
                            
                            <h1 style="margin: 10px 0; color:red;">Mã đơn hàng: ' . $row['id'] . '</h1>
                            <b>THÔNG TIN NHẬN HÀNG</b>
                            <ol>
                                <li style="list-style: circle;">Khách hàng: ' . $row['customer'] . '</li>
                                <li style="list-style: circle;">Địa chỉ: ' . $row['location'] . '</li>
                                <li style="list-style: circle;">Số điện thoại: ' . $row['phone'] . '</li>
                                <li style="list-style: circle;">Email: ' . $row['email'] . '</li>
                            </ol>
                            <h2>Tổng đơn hàng: ' . number_format($row['totalAmount'], 0, ",", ".") . 'Đ</h2>
                            <a href="delete-cart.php?id='.$row['id'].'" onclick="return confirm(\'Bạn có chắc chắn muốn hủy đơn hàng này không\')">Hủy Đơn Hàng</a>

                            </div>
                    </div>
                    </div>';
                    
                    // echo '</div>';
                }
            }else{
                ?>
                    <div class="unvaluable-bill">
                        <div class="nullBill"></div>
                        <p>Chưa có đơn hàng</p>
                        <a href="shop.php">Shopping Now</a>
                    </div>
                <?php
            }
        }
    
    } else {
        echo 'No showcart data received.';
    }
}else{ ?>
    <div class="unvaluable-bill">
        <div class="nullBill"></div>
        <p>Chưa có đơn hàng</p>
        <a href="shop.php">Shopping Now</a>
    </div>
<?php
}
?>
