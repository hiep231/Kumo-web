<?php
    session_start();
    include 'connectDB.php';
    include 'model_cart.php';
    include 'thuvien.php';
    if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
        header('location:login_form.php');
        exit;
        // echo "login";
    };
    $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    

    <section id="page-header" class="about-header">           
            <h2>#Let's_talk</h2>
            <p>Leave a message, we love to hear from you !</p>
    </section>

    <div class="giohang">
        <div class="header">
            <h1><i class='bx bx-cart'></i> Giỏ hàng</h1>
            
        </div>

        <div class="layout-2column">
            <div class="layoutcolumn1">
                    <div class="listcart" style="overflow: scroll; overflow-x: hidden; overflow-y: auto; height: 420px;">

                        
                    </div>
                <div class="formdonhang">
                    
                </div>
            </div>
            <div class="layoutcolumn2">
                <div class="promotion">
                    <h1>Mã coupon ưu đãi</h1>
                    <div class="promotion-search">
                        <input type="text" name="coupon" placeholder="Nhập mã coupon">
                        <button>Áp dụng</button>
                    </div>
                </div>
                <div class="total-pricecart">
                    <h1>TẠM TÍNH</h1>
                    <table>
                        <tr>
                            <td>Số lượng</td>
                            <td id="totalCount"></td>
                        </tr>
                        <tr>
                            <td>Tạm tính</td>
                            <td class="totalAmount">Đ</td>
                        </tr>
                        <tr>
                            <td>Phí vận chuyển</td>
                            <td>0đ</td>
                        </tr>
                    </table>
                    <div class="footer">
                        <p>Tổng cộng</p>
                        <p class="totalAmount">Đ</p>
                    </div>
                </div>    
                <!-- <button type="button" class="btnprimary">Thanh toán <span>700.000đ</span></button> -->
            </div>
        </div>
    </div>

    <?php 
    include 'footer.php'; 
    include 'header.php';
    ?>

    <script type="text/javascript">
        const showcartString = localStorage.getItem("showcart");
        // const showcart = JSON.parse(showcartString) || [];
        console.log(showcart);
        

        // var xhr = new XMLHttpRequest();
        // xhr.open('POST', 'cart.php', true);
        // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // xhr.onreadystatechange = function() {
        //     if (xhr.readyState == 4 && xhr.status == 200) {
        //         // Xử lý phản hồi từ máy chủ nếu cần
        //         // console.log(xhr.responseText);
        //     }
        // };
        function showAllCart() {
            // Clear existing cart elements
            document.querySelector('.listcart').innerHTML = '';

            for (let i = 0; i < showcart.length; i++) {
                const item = showcart[i];
                const cartElement = document.createElement("div");
                cartElement.className = "cart";
                cartElement.innerHTML = `
                    <img src="${item[0]}" alt="" onclick="window.location.href='product.php?id=${item[5]}'">
                    <div class="infoproduct">
                        <p id="ten">${item[2]}</p>
                        <p id="size">Màu: ${item[6]}, ${item[4]}</p>
                        <div class="num">
                            <a href="#" class="minus" onclick="minusSoluong(${i},this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 24 24">
                                    <path fill="#888888" d="M18 12.998H6a1 1 0 0 1 0-2h12a1 1 0 0 1 0 2z"/>
                                </svg>
                            </a>
                            <input type="number" id="count-${i}" readonly value="${item[3]}">
                            <a href="#" class="plus" onclick="plusSoluong(${i})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 24 24">
                                    <path fill="#888888" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2v-6Z"/>
                                </svg>
                            </a>
                        </div>
                        <p>${number_format(item[1], 0, ",", ".")} VND</p>
                    </div>
                    <a href="#" onclick="xoaspcart(${i}, this)">Xóa</a>
                `;
                document.querySelector('.listcart').appendChild(cartElement);
            }
        }

        showAllCart();



        function updateLocalStorage() {
            localStorage.setItem("showcart", JSON.stringify(showcart));
        }
        function xoaspcart(index, element) {
            event.preventDefault();
            var cartElement = element.closest('.cart');
            var tensp = cartElement.querySelector('#ten').innerText;
            var size = cartElement.querySelector('#size').innerText.split(', ')[1];
            console.log(cartElement);
            console.log(tensp);
            console.log(size);

            cartElement.remove();

            // Assuming showcart10 is a global variable
            for (var i = 0; i < showcart.length; i++) {
                if (showcart[i][2] === tensp && showcart[i][4] === size) {
                    showcart.splice(i, 1);
                    console.log(showcart);
                    break;
                }
            }
            updateLocalStorage();
            updateTotalAmount()
            showAllCart();
        }


        function tongdonhang() {
            // var showcart = JSON.parse(localStorage.getItem("showcart")) || [];

            var tongTien = 0;

            for (var i = 0; i < showcart.length; i++) {
                var gia = showcart[i][1];
                var soLuong = showcart[i][3];

                var thanhTien = gia * soLuong;

                tongTien += thanhTien;
            }

            return tongTien;
        };
        function formdonhang() {
            let tong = number_format(tongdonhang(),0,",",".");  
            const item = showcart;
            const cartElement = document.createElement("div");
            cartElement.className = "cart";

            cartElement.innerHTML = `
            <p><i class='bx bx-map-alt'></i> Thông tin đơn hàng</p>                    
            <form action="bill.php" method="post">
                <div class="form-cart">
                    <select name="promotion" required> 
                        <?php
                        $queryPromotion = "SELECT * FROM promotion";
                        $result = mysqli_query($conn, $queryPromotion);
                        while ($r = mysqli_fetch_array($result)) {
                            echo '<option value="' . $r['id'] . '">' . $r['code'] . " - " . number_format($r['price'],0,",",".") . " VND" . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" name="ten" placeholder="Tên*" required>
                    <input type="text" name="phone" placeholder="Số điện thoại*" pattern="[0-9]{10}" required maxlength="10">
                    <input type="text" name="location" placeholder="Địa chỉ*" required>
                    <input type="email" name="email" placeholder="Email*" required>
                    <textarea name="customer_note" id="note" cols="500" rows="" placeholder="Ghi chú đơn hàng"></textarea>
                </div>
                <input type="submit" name="dongydathang" id="finalTotal" value="THANH TOÁN ${tong} Đ">
            </form>`;
            document.querySelector('.formdonhang').appendChild(cartElement);
        }
        formdonhang();
        

        function plusSoluong(i) {
            event.preventDefault();
            if (showcart[i] && showcart[i].length >= 4) {
                showcart[i][3] = parseInt(showcart[i][3]) + 1;
                // console.log(showcart[i][3]);
                var num = document.getElementById(`count-${i}`);
                num.value = showcart[i][3];
                updateLocalStorage();
                updateTotalAmount();
                showAllCart();
            }
            // showmycart();
        }

        function minusSoluong(i,element) {
            event.preventDefault();
            if (showcart[i] && showcart[i].length >= 4 && showcart[i][3] > 1) {
                showcart[i][3] = parseInt(showcart[i][3]) - 1;
                var num = document.getElementById(`count-${i}`);
                num.value = showcart[i][3];
                updateLocalStorage();
                updateTotalAmount();
                showAllCart();
            } else if (showcart[i] && showcart[i][3] == 1) {
                xoaspcart(i, element);
            }
        }


        function updateTotalAmount() {
            var totalAmount = tongdonhang();
            console.log(totalAmount);
            var totalCount = tongSoLuong();
            console.log(document.getElementsByClassName('totalAmount')[0]);
            var totalAmountElements = document.getElementsByClassName('totalAmount');
            for (var i = 0; i < totalAmountElements.length; i++) {
                totalAmountElements[i].textContent = number_format(totalAmount, 0, ",", ".") + 'Đ';
            }
            document.getElementById('finalTotal').value = "THANH TOÁN " + number_format(totalAmount, 0, ",", ".") + 'Đ';
            document.getElementById('totalCount').innerText = totalCount;
        }
        updateTotalAmount();

        function tongSoLuong(){
            var showcart = JSON.parse(localStorage.getItem("showcart")) || [];
            // console.log(showcart);

            var soluong = 0;

            for (var i = 0; i < showcart.length; i++) {
                soluong += parseInt(showcart[i][3]);
            }

            return soluong;
        }
        document.getElementById('finalTotal').addEventListener('click', function() {
            <?php
            if (!isset($_SESSION['user_id'])) {
                echo 'window.location.href = "login_form.php";';
            } else {
                echo 'document.querySelector("form").submit();';
            }
            ?>
        });

    </script>

    <!-- <script>
        let num = document.getElementById("input");
        let inputvalue = parseFloat(num.value);
        function increaseQuantity(productId) {
            var inputElement = document.getElementById("input" + productId);
            inputElement.value = parseInt(inputElement.value) + 1;
        }
        function decreaseQuantity(productId) {
            var inputElement = document.getElementById("input" + productId);
        if (parseInt(inputElement.value) > 1) {
            inputElement.value = parseInt(inputElement.value) - 1;
        }
    }
    </script> -->
</body>
</html>