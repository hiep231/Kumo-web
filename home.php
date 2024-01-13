<?php
require_once 'connectDB.php';
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet"
href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <section class="main-home">
        <div class="main-text">
            <h5>Bộ sưu tập mùa hè</h5>
            <h1>Bộ sưu tập <br> Mùa Hè mới 2023</h1> <br>
            <p>Giá mới hấp dẫn nhiều khuyến mãi</p>

            <a href="shop.php" class="main-btn">Mua ngay <i class='bx bx-right-arrow-alt'></i></a>
        </div>

        <div class="down-arrow">
            <a href="#trending" class="down"><i class='bx bx-down-arrow-alt' ></i></a>
        </div>
    </section>


    <section class="trending-product" id="trending">
        <div class="center-text">
            <h2>Sản phẩm <span>Nổi bật</span></h2>
        </div>

        <div class="products">
            <?php
                $sql = "SELECT product.id as id,name,product.price,images,specName,brand,promotion.price as pro_price,describes,ratingStar FROM product JOIN promotion ON product.salePromotion  = promotion.id ORDER BY product.id LIMIT 0,8";
                $result = mysqli_query($conn, $sql);
                while ($r = mysqli_fetch_array($result)) {
                    $array_image = explode(",", $r['images']);
                    $image = $array_image[0];
                    ?>
                    <div class="row">
                        <?php echo '<img src="http://localhost/Kumo/' . $image . '" alt="Ảnh 1" onclick="window.location.href=\'product.php?id=' . $r['id'] . '\';" />'; ?>


                        <div class="product-text">
                            <h5>Sale</h5>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bxs-heart'></i>
                        </div>
                        <div class="cart-icon" onclick="window.location.href='product.php?id=<?php echo $r['id']; ?>';">
                            <i class='bx bxs-cart'></i>
                        </div>
                        <div class="star">
                            <?php
                                $count = 0;
                                $star = $r['ratingStar'];
                                while ($star >= 1) {
                                    $star -= 1;
                                    echo '<i class="fas fa-star"></i>';
                                    $count += 1;
                                }
                                if ($star > 0) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                    $count += 1;
                                }
                                while ($count < 5) {
                                    echo '<i class="fa-regular fa-star"></i>';
                                    $count += 1;
                                }
                            ?>
                        </div>
                        <div class="price">
                            <h4><?php echo $r['name'] ?></h4>
                            <p>Giá chưa giảm: <del><?php echo number_format($r['price'], 0, ',', '.') ?>đ</del> <br> Giá đã giảm: <?php echo number_format($r['price']-$r['pro_price'], 0, ',', '.') ?>đ</p>
                            <form action="" method="POST">
                                <input type="hidden" name="anh" value="http://localhost/Kumo/<?php echo $image ?>">
                                <input type="hidden" name="tensp" value="<?php echo $r['name'] ?>">
                                <input type="hidden" name="soluong" value="1">
                                <input type="hidden" name="gia" value="<?php echo $r['price']-$r['pro_price'] ?>">
                            </form>
                        </div>
                        <button class="Order" onclick="window.location.href='product.php?id=<?php echo $r['id']; ?>'">Đặt hàng</button>
                    </div>
                    <?php
                }      
            ?>
        </div>
    </section>

    <section id="banner">
        <h4>Dịch vụ sửa chữa</h4>
        <h2>Giảm đến <span>70% </span>- Tất cả Áo thun & Phụ kiện</h2>
        <a href="shop.php" class="normal">Khám phá thêm</a>
    </section>

    <!-- update-news-section -->
    <section class="Update-news">
        <div class="up-center-text">
            <h2>Những thông tin cập nhật mới</h2>
        </div>

        <div class="update-cart">
            <div class="cart">
                <img src="hinh_sp/1.jpg" alt="">
                <h5>20 Tháng 6 năm 2023</h5>
                <h4>Hãy bắt đầu chương trình khuyến mãi trong kì nghỉ hè này.</h4>
                <p>Chào mừng đến với chương trình khuyến mãi hè đặc biệt của chúng tôi! Hãy sẵn sàng để tận hưởng mùa hè này với những ưu đãi không thể tốt hơn.</p>

                <h6>Đọc tiếp...</h6>
            </div>

            <div class="cart">
                <img src="hinh_sp/27.jpg" alt="">
                <h5>21 Tháng 7 năm 2023</h5>
                <h4>Hãy cùng bắt đầu mùa hè này với chương trình khuyến mãi hấp dẫn từ chúng tôi!</h4>
                <p>Mùa hè đã đến, và chúng tôi không thể chờ đợi để chia sẻ với bạn những ưu đãi tuyệt vời. Hãy sẵn sàng cho một mùa hè đích thực với chương trình khuyến mãi độc đáo của chúng tôi.</p>

                <h6>Đọc tiếp...</h6>
            </div>

            <div class="cart">
                <img src="hinh_sp/28.jpg" alt="">
                <h5>22 Tháng 8 năm 2023</h5>
                <h4>Hãy chuẩn bị cho những ngày nghỉ hè vui vẻ bằng việc tham gia vào chương trình khuyến mãi độc đáo của chúng tôi.</h4>
                <p>Mùa nghỉ hè đã tới, và đó là lúc chúng tôi mang đến cho bạn cơ hội tuyệt vời để mua sắm với giá ưu đãi và ưu đãi hấp dẫn. Hãy cùng chúng tôi tạo nên một kỳ nghỉ đáng nhớ!</p>

                <h6>Đọc tiếp...</h6>
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
    
</body>
</html>