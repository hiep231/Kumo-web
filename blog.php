<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
if (isset($_SESSION['admin_id'])) {
    $user_id = $_SESSION['admin_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Clothes Shopping</title>
    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        .pagination button#p1 {
            background: #ed975b;
        }
    </style>
</head>
<body>

    <section id="page-header" class="blog-header">           
            <h1>#Đọcthêm</h1> <br>
            <p>Đọc tất cả các nghiên cứu trường hợp về sản phẩm của chúng tôi!</p>
    </section>

    <section id="blog">
        <div class="blog-box">
            <div class="blog-img">
                <img src="hinh_sp/b1 (1).jpg" alt="">
            </div>
            <div class="blog-details">
                <h4>Áo Hoodie Zip-Up Cotton-Jersey</h4>
                <p>Với chất liệu vải cao cấp và thiết kế hiện đại, không chỉ mang đến sự ấm áp mà còn là điểm nhấn thời trang tinh tế cho bất kỳ dịp nào.
                    Sự kết hợp của thoải mái và phong cách trong chiếc áo này sẽ làm nổi bật phong cách cá nhân của bạn, là lựa chọn hoàn hảo cho những ngày năng động và thoải mái.</p>
                <a href="#">Đọc tiếp</a>    
            </div>
            <h1>30/10</h1>
        </div>
        <div class="blog-box">
            <div class="blog-img">
                <img src="hinh_sp/b2 (1).jpg" alt="">
            </div>
            <div class="blog-details">
                <h4>Áo Polo Classic Cotton</h4>
                <p>Với chất liệu cotton cao cấp và kiểu dáng truyền thống, không chỉ mang đến sự thoải mái mà còn là điểm nhấn cho phong cách thời trang đẳng cấp.
                    Thiết kế cổ áo Polo và phom dáng ôm vừa vặn của chiếc áo này tạo nên sự lịch lãm và tinh tế, là lựa chọn hoàn hảo để tỏa sáng trong mọi dịp, từ những buổi gặp gỡ nhẹ nhàng đến những sự kiện trang trọng.</p>
                <a href="#">Đọc tiếp</a>    
            </div>
            <h1>20/10</h1>
        </div>
        <div class="blog-box">
            <div class="blog-img">
                <img src="hinh_sp/b3.jpg" alt="">
            </div>
            <div class="blog-details">
                <h4>Áo Sơ Mi Linen Casual</h4>
                <p>với chất liệu nhẹ và thoải mái, là sự lựa chọn hoàn hảo để tỏa sáng trong bất kỳ dịp nào. Thiết kế đơn giản nhưng trang nhã giúp áo dễ dàng phối hợp, là điểm nhấn tuyệt vời cho phong cách cá nhân của bạn.
                    Cho dù bạn đi chơi cuối tuần hay tham gia các sự kiện nhẹ nhàng, Áo Sơ Mi Linen Casual sẽ làm nổi bật vẻ ngoại hình của bạn, tạo nên sự tự tin và thoải mái.</p>
                <a href="#">Đọc tiếp</a>    
            </div>
            <h1>20/11</h1>
        </div>
        <div class="blog-box">
            <div class="blog-img">
                <img src="hinh_sp/b4.jpg" alt="">
            </div>
            <div class="blog-details">
                <h4>Áo Polo Striped Vintage</h4>
                <p>với sọc ngang tinh tế và chất liệu cotton thoáng khí, là sự lựa chọn hoàn hảo để thể hiện phong cách trẻ trung và độc đáo. Thiết kế cổ áo Polo và màu sắc tươi sáng tạo nên một diện mạo thời trang năng động, phù hợp cho nhiều dịp khác nhau.
                    Cho dù bạn đi chơi cùng bạn bè hay tham gia các sự kiện nhẹ nhàng, Áo Polo Striped Vintage sẽ là điểm nhấn phong cách độc đáo, giúp bạn tỏa sáng và tự tin.</p>
                <a href="#">Đọc tiếp</a>    
            </div>
            <h1>24/12</h1>
        </div>
        <div class="blog-box">
            <div class="blog-img">
                <img src="hinh_sp/b6.jpg" alt="">
            </div>
            <div class="blog-details">
                <h4>Áo Hoodie Oversized Streetwear</h4>
                <p>với phong cách rộng lớn và chất liệu vải cotton mềm mại, là nguồn cảm hứng hoàn hảo cho những người yêu thích sự thoải mái và phong cách độc đáo.
                    Thiết kế đơn giản nhưng đầy cá tính của chiếc áo này tạo nên một tuyên bố thời trang, làm nổi bật phong cách tự do và sự độc lập trong mọi hoàn cảnh, từ những buổi chill tại nhà đến những sự kiện năng động ngoại ô.</p>
                <a href="#">Đọc tiếp</a>    
            </div>
            <h1>30/12</h1>
        </div>
    </section>


    <section class="pagination">
        <!-- <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class='bx bx-right-arrow-alt'></i></a> -->
        <button id="prevPage" style="position: relative; left:4px; top: 3px; padding: 0.6rem 0.4rem 0.4rem 0.4rem"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 24 24"><path fill="#00000" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225L16 22Z"/></svg></a></button>
        <button id="p1"><a href="#">1</a></button>
        <button id="p2"><a href="#">2</a></button>
        
        <button id="nextPage" style="position: relative; right:4px; top: 3px; padding: 0.6rem 0.4rem 0.4rem 0.4rem"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 20"><path fill="#00000" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg></a></button>
    </section>
    <section id="newsletter">
        <div class="newstext">
            <h4>Đăng Ký Để Nhận Tin Tức Mới Nhất</h4>
            <p>Nhận cập nhật qua E-mail về cửa hàng mới nhất của chúng tôi và <span>các ưu đãi đặc biệt.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal" onclick="window.location.href='register_form.php'">Đăng ký</button>
        </div>
    </section>
    <?php 
    include 'footer.php'; 
    include 'header.php';
    ?>
    <script>
        var currentPage = 1;
        var totalPages = 2;
        if (currentPage===totalPages) {
            var nextPageElement = document.getElementById("nextPage");
            if (nextPageElement) {
                nextPageElement.style.backgroundColor = "#b7bab6";
            }
        }
        if (currentPage === 1) {
            var prevPageElement = document.getElementById("prevPage");
            if (prevPageElement) {
                prevPageElement.style.backgroundColor = "#b7bab6";
            }
        }

    </script>
</body>
</html>