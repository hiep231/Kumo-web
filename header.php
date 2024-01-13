<?php
    include "model_cart.php";
    include "connectDB.php";
    $loginMessage = [];
    $registerMessage = [];
    
    
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="#" class="logo"><img src="hinh_sp/logo.png" alt=""></a>

        <ul class="navmenu">
            <li><a href="home.php">Trang chủ</a></li>
            <li><a href="shop.php">Sản phẩm</a>
                <ul>
                    <li><a href="shop.php?category=Sơ mi">Áo sơ mi</a></li>
                    <li><a href="shop.php?category=Áo polo">Áo polo</a></li>
                    <li><a href="shop.php?category=Áo phông">Áo phông </a></li>
                    <li><a href="shop.php?category=Quần">Quần </a></li>
                </ul>
            </li>
            <li><a href="blog.php">Bài viết</a></li>
            <li><a href="about.php">Giới thiệu</a></li>
            <li><a href="contact.php">Liên hệ</a></li>
        </ul>

        <div class="nav-icon">
            <form action="shop.php" method="POST" class="search-form">
                <!-- <input type="search" name="" placeholder="Tìm kiếm sản phẩm..." id="search-box">
                input -->
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit" name="submit" class=" search btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="position: relative;top: 1.5px;"><path fill="#00000" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.612 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.313T14 9.5q0-1.875-1.313-3.188T9.5 5Q7.625 5 6.312 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z"/></svg></button>
            </form>
            <a href="#" onclick="display_search()"><i class='bx bx-search'></i></a>
            <a href="#" onclick="showcart1()"><i class='bx bx-cart'></i></a>
            <!-- <a href="#"><i class='bx bxs-heart'></i></a> -->
            <!-- <div class="bx bx-menu" id="menu-icon"></div> -->
            <?php if(isset($user_id)) { ?>
                <div class="profile">
                    <a href="#"><i class='bx bx-user' id="user"></i></a>
                    <?php
                    
                    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_profile->bind_param("s", $user_id);
                    $select_profile->execute();
                    $fetch_profile = $select_profile->get_result()->fetch_assoc();
                    
                    if ($fetch_profile) {
                        ?>
                        <div class="infoUser" id="infoUser" style="display:none;">
                            <div class="img-user">
                                <img src="avatar_img/<?= $fetch_profile['avatar']; ?>" alt="">
                            </div>
                            <p>Xin chào <?= $fetch_profile['userName']; ?></p>
                            <a href="user_profile_update.php" class="btn">Cập nhật thông tin</a>
                            <a href="logout.php" class="delete-btn">Đăng xuất</a>
                            <a href="bill.php">Đơn hàng</a>
                            <?php
                                if (isset($_SESSION['admin_id'])) {
                                    ?>
                                        <a href="Admin/admin_home.php">Admin</a>
                                    <?php
                                }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- <a href="#" onclick="showcart1()"><i class='bx bx-cart'></i></a> -->
            <?php } else { ?>
                <a href="#"><i class='bx bx-user' id="user"></i></a>
                <div class="display-user-login" id="display-user-login">
                    <div>
                    <!-- <button class="link-login-form"> -->
                        <a href="login_form.php" class="link-login-form">Đăng nhập</a>
                    <!-- </button> -->
                    <!-- <button class="link-login-form"> -->
                        <a href="register_form.php" class="link-login-form">Đăng ký</a>
                    <!-- </button> -->
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
       
    </header>
    <div class="cart-list" id="showcart" style="display:none;"></div>
    <script>
        // var loginForm = document.getElementById('loginForm');
        // var registerForm = document.getElementById('registerForm');
        var infoUser = document.getElementById('infoUser');

        if (infoUser) {
            document.getElementById('user').addEventListener('click', function (event) {
                event.preventDefault();

                if (infoUser.style.display === 'none') {
                    infoUser.style.display = 'block';
                } else {
                    infoUser.style.display = 'none';
                }

                // if (loginForm.style.display === 'none' && registerForm.style.display === 'none') {
                //     loginForm.style.display = 'block';
                //     registerForm.style.display = 'none';
                //     console.log("login block");
                // } else {
                //     loginForm.style.display = 'none';
                //     registerForm.style.display = 'none';
                //     console.log("2 block");
                // }
            });
        }
        var display_user_login = document.getElementById('display-user-login');

        // if (infoUser) {
        document.getElementById('user').addEventListener('click', function (event) {
            event.preventDefault();

            // var targetDiv = document.getElementById('targetDiv');
            display_user_login.classList.toggle('display-user-login-visible');
            display_user_login.classList.toggle('display-user-login');
        });
        // else {
        //     document.getElementById('user').addEventListener('click', function (event) {
        //         event.preventDefault();
        //         if (loginForm.style.display === 'none' && registerForm.style.display === 'none') {
        //             loginForm.style.display = 'block';
        //             registerForm.style.display = 'none';
        //             console.log("login block");
        //         } else {
        //             loginForm.style.display = 'none';
        //             registerForm.style.display = 'none';
        //             console.log("2 block");
        //         }
        //     });
        // }


        // document.getElementById('display-user-login').addEventListener('click', function() {
        //     document.getElementById('loginForm').style.display = 'none';
        //     document.getElementById('registerForm').style.display = 'block';
        // });

        // document.getElementById('login').addEventListener('click', function() {
        //     document.getElementById('loginForm').style.display = 'block';
        //     document.getElementById('registerForm').style.display = 'none';
        // });
    </script>
</body>
</html>