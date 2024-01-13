<?php
session_start();
// if (isset($_SESSION['user_id'])) {
//     $user_id = $_SESSION['user_id'];
// }
// if (isset($_SESSION['admin_id'])) {
//     $user_id = $_SESSION['admin_id'];
// }
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
    $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
}
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
            <h1>#ThôngTin</h1> <br>
            <!-- <p>Kumo Shop</p> -->
            <p>Sự kết hợp hoàn hảo giữa phong cách và chất lượng, để bạn trải nghiệm mua sắm đẳng cấp mỗi ngày</p>
    </section>

    <section id="about-head">
        <img src="hinh_sp/a6.jpg" alt="">
        <div>
            <h2>Chúng Tôi Là Ai?</h2><br><br>
            <p>Kumo là một địa chỉ đáng tin cậy cho các giải pháp công nghệ đổi mới. 
                Chúng tôi chuyên tạo ra những sản phẩm và dịch vụ tiên tiến, từ phần mềm đến phần cứng, 
                nhằm giải quyết các thách thức kỹ thuật. Với môi trường làm việc sáng tạo, 
                chúng tôi hướng đến việc thay đổi cách thế giới tương tác với công nghệ và xây dựng cộng đồng đối tác bền vững.
            </p><br>

            <abbr title="">Chúng tôi cam kết tạo nên không gian làm việc tích cực và đổi mới, khuyến khích sáng tạo và xây dựng cộng đồng chung. 
                Đến với Kumo, chúng ta cùng nhau mở ra những cơ hội mới và định hình tương lai công nghệ.</abbr>   
            
            <br><br>

            <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">Khám phá thế giới mới - 
                Trải nghiệm mua sắm đẳng cấp - Sáng tạo và phong cách độc đáo tại Kumo Shop!
            </marquee>
        </div>
    </section>

    <section id="about-app">
        <h1>Tải Ứng Dụng <a href="#">Của Chúng Tôi</a></h1>
        <div class="video">
            <video autoplay muted loop src="hinh_sp/1.mp4"></video>
        </div>
    </section>

    <section id="feature">
        <div class="fe-box">
            <img src="hinh_sp/f1.png" alt="">
            <h6>Miễn Phí Vận Chuyển</h6>
        </div>
        <div class="fe-box">
            <img src="hinh_sp/f2.png" alt="">
            <h6>Đặt Hàng Online</h6>
        </div>
        <div class="fe-box">
            <img src="hinh_sp/f3.png" alt="">
            <h6>Tiết Kiệm Chi Phí</h6>
        </div>
        <div class="fe-box">
            <img src="hinh_sp/f4.png" alt="">
            <h6>Ưu Đãi Hấp Dẫn</h6>
        </div>
        <div class="fe-box">
            <img src="hinh_sp/f5.png" alt="">
            <h6>Bán Hàng Hạnh Phúc</h6>
        </div>
        <div class="fe-box">
            <img src="hinh_sp/f6.png" alt="">
            <h6>Hỗ Trợ 24/7</h6>
        </div>
    </section>


    <section id="newsletter">
        <div class="newstext">
            <h4>Đăng Ký Nhận Tin</h4>
            <p>Nhận cập nhật qua email về cửa hàng mới nhất của chúng tôi và <span>các ưu đãi đặc biệt.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Địa chỉ email của bạn">
            <button class="normal">Đăng ký</button>
        </div>
    </section>



    <!-- contact-section -->
    <!-- <section class="contact">
        <div class="contact-info">
            <div class="first-info">
                <img src="hinh_sp/logo.png" alt="">
                <h4>Contact</h4>
                <p><strong>Địa chỉ liên hệ:</strong> 69/68 Đặng Thùy Trâm, phường 13, quận Bình Thạnh, Thành phố Hồ Chí Minh</p>
                <p><strong>Số điện thoại liên hệ:</strong> 0901566750</p>
                <p><strong>E-mail:</strong> fashionclothes@gmail.com</p>
                <p><strong>Hour:</strong> 10:00 - 18:00. Mon - Sun</p>

                <h4>Follow us</h4>
                <div class="social-icon">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-instagram' ></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxs-phone-call'></i></a>
                    <a href="#"><i class='bx bxl-gmail' ></i></a>
                </div>
            </div>

            <div class="second-info">
                <h4>Support</h4>
                <p>Contact us</p>
                <p>About page</p>
                <p>Size Guide</p>
                <p>Shopping & Returns</p>
                <p>Privacy</p>
            </div>

            <div class="third-info">
                <h4>Shop</h4>
                <p>Men's Shopping</p>
                <p>Women's Shopping</p>
                <p>Kid's Shopping</p>
                <p>Discount</p>
                <p>Clothes</p>
            </div>

            <div class="fourth-info">
                <h4>Company</h4>
                <p>About</p>
                <p>Blog</p>
                <p>Affiliate</p>
                <p>Login</p>
            </div>

            <div class="col install">
                <h4>Install App</h4>
                <p>From App Store or Google Play</p>
                <div class="row">
                    <img src="hinh_sp/app.jpg" alt="">
                    <img src="hinh_sp/play.jpg" alt="">
                </div>
                <p>Secured Payment Gateways</p>
                <img src="hinh_sp/pay.png" alt="">
            </div>           
        </div>
    </section> -->
    <?php 
    include 'footer.php'; 
    include 'header.php';
    ?>
    <script src="java.js"></script>
</body>
</html>