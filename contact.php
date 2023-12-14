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
    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet"
href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    
    <!-- <header>
        <a href="#" class="logo"><img src="hinh_sp/logo.png" alt=""></a>

        <ul class="navmenu">
            <li><a href="home.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>

        <div class="nav-icon">
            <a href="#"><i class='bx bx-search'></i></a>
            <a href="#"><i class='bx bx-user'></i></a>
            <a href="#"onclick="window.location.href='cart.php';"><i class='bx bx-cart'></i></a>
            <a href="#"><i class='bx bxs-heart'></i></a>

            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header> -->

    <section id="page-header" class="about-header">           
        <h2>#LiênHệ</h2>
        <p>Để lại một tin nhắn, chúng tôi rất vui được nghe từ bạn!</p>
    </section>

    <section id="contact-details">
        <div class="details">
            <span>LIÊN HỆ</span>
            <h2>Đến một trong các vị trí của chúng tôi hoặc liên hệ ngay hôm nay</h2>
            <h3>Văn Phòng Chính</h3>
            <div>
                <li>
                    <i class='bx bx-map-alt'></i>
                    <p>69/68 Đặng Thùy Trâm, phường 13, quận Bình Thạnh, Hồ Chí Minh</p>
                </li>
                <li>
                    <i class='bx bx-envelope'></i>
                    <p>FashionClothes@gmail.com</p>
                </li>
                <li>
                    <i class='bx bxs-phone'></i>
                    <p>0907631594</p>
                </li>
                <li>
                    <i class='far fa-clock'></i>
                    <p>Thứ Hai đến Thứ Bảy: 10.00 sáng đến 18.00 chiều</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.7862192228217!2d106.69990829999999!3d10.827665699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175288b721fd377%3A0x7c6608ca1477ab97!2zNjkgxJAuIMSQ4bq3bmcgVGh14buzIFRyw6JtLCBQaMaw4budbmcgMTMsIELDrG5oIFRo4bqhbmgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaA!5e0!3m2!1svi!2s!4v1698602903164!5m2!1svi!2s" 
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>


    <section id="form-details">
        <form action="">
            <span>Để lại tin nhắn</span>
            <h2>Chúng tôi rất vui được nghe từ bạn</h2>
            <input type="text" placeholder="Tên của bạn">
            <input type="text" placeholder="E-mail">
            <input type="text" placeholder="Chủ đề">
            <textarea name="" id="" cols="30" rows="10" placeholder="Tin nhắn của bạn"></textarea>
            <button class="normal">Gửi</button>
        </form>

        <div class="people">
            <div>
                <img src="avatar_img/avater_hiep.jpg" alt="">
                <p><span>Đỗ Tuấn Hiệp</span> Giám Đốc Tiếp Thị <br> Điện thoại: +84 862 204 453<br>Email: tuanhiep231@gmail.com</p>
            </div>
            <div>
                <img src="avatar_img/avatar_thien.jpg" alt="">
                <p><span>Trần Đình Thiện</span> Trưởng Bộ Phận Tiếp Thị <br> Điện thoại: +84 828 829 162 <br>Email: thien0311@gmail.com</p>
            </div>
            <div>
                <img src="avatar_img/avater_phu.jpg" alt="">
                <p><span>Đái Sỹ Phú</span> Chuyên Viên Tiếp Thị <br> Điện thoại: +84 923 835 216 <br>Email: phu234@gmail.com</p>
            </div>
        </div>
    </section>

    <section id="newsletter">
        <div class="newstext">
            <h4>Đăng Ký Nhận Tin Tức</h4>
            <p>Nhận cập nhật qua email về cửa hàng mới nhất của chúng tôi và <span>các ưu đãi đặc biệt.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Địa chỉ email của bạn">
            <button class="normal">Đăng ký</button>
        </div>
    </section>



    <?php 
    include 'footer.php'; 
    include 'header.php';
    ?>

    <script src="java.js"></script>
</body>
</html>