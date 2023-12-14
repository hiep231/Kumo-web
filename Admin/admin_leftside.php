<?php
// session_start();
// if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
//     $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Clothes Shopping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Titillium Web' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_leftside.css">
    <style>
        .left-side-content .nav a:nth-child(<?php echo $nth ?>) {
            background-color: rgba(255,255,255,0.4);
            width: 100%;
            position: relative;
            left:-4px;
        }
    </style>
</head>

<body>
    <div class="left-side">
        <div class="left-side-content">
            <!-- <div class="LOGO"><div class="logo">GEN<span class="logo-Z">Z</span></div></div> -->
            <div class="LOGO"><img src="logo.png" alt="" onclick="redirectToHome()"></div>
            <div class="nav">
                <a href="admin_home.php" id="home-link">
                    <div class="choose">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="30" viewBox="0 0 24 18" style="position: relative; bottom: 2px;">
                            <path fill="currentColor" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7H4Z"/>
                        </svg>
                        <p>Home</p>
                    </div>   
                </a>
                <a href="listed_ao.php" id="ao-link">
                    <div class="choose">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="30" viewBox="0 0 50 38" style="position: relative; top: -2px;">
                            <path fill="currentColor" d="M47.36 14.75c.08.29-.021.61-.19.86l-5.39 8.02c-.2.31-.62.48-.971.48c-.1 0-.38-.02-.489-.05L36 23v19c0 .58-.41 1-1 1H14c-.59 0-1-.42-1-1V23l-3.88 1.07c-.45.14-.84-.04-1.09-.43l-5.35-8c-.17-.26-.22-.55-.14-.84c.07-.3.28-.5.55-.64L14 9h5c.59 0 1 .41 1 1c0 2.06 2.89 3.52 4.95 3.52S30 12.07 30 10c0-.58.41-1 1-1h5l10.8 5.06c.28.14.48.39.56.69z"/>
                        </svg>
                        <p>Áo</p>
                    </div>   
                </a>
                <a href="listed_quan.php" id="quan-link">
                    <div class="choose">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="30" viewBox="0 0 512 450" style="position: relative; top: 5px;">
                            <path fill="currentColor" d="M250.45 19.767c-44.556.187-87.24 7.376-118.562 21c-16.176 147.458-28.792 298.827-46.72 425.75l123.344 24.814l34.157-262.844h20.63l34.25 263.75h.218l129.063-26.28c-15.71-141.714-31.023-283.473-46.724-425.19c-38.697-14.307-85.098-21.17-129.655-21z"/>
                        </svg>
                        <p>Quần</p>
                    </div>
                </a>
                <a href="add_product.php" id="add-link">
                    <div class="choose">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="30" viewBox="0 0 12 16" style="position: relative; right: 3px;">
                            <path fill="currentColor" d="M3 10h11v2H3v-2zm0-2h11V6H3v2zm0 8h7v-2H3v2zm15.01-3.13l.71-.71a.996.996 0 0 1 1.41 0l.71.71c.39.39.39 1.02 0 1.41l-.71.71l-2.12-2.12zm-.71.71l-5.3 5.3V21h2.12l5.3-5.3l-2.12-2.12z"/>
                        </svg>
                        <p>Thêm mới</p>
                    </div>
                </a>
                <a href="admin_statistics.php" id="thongke-link">
                    <div class="choose">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="30" viewBox="0 0 24 20">
                            <path fill="currentColor" d="M4 19v1h18v2H2V2h2v15c3 0 6-2 8.1-5.6c3-5 6.3-7.4 9.9-7.4v2c-2.8 0-5.5 2.1-8.1 6.5C11.3 16.6 7.7 19 4 19Z"/>
                        </svg>
                        <p>Thông kê</p>
                    </div>
                </a>
                <a href="listed_order.php" id="quanli-link">
                    <div class="choose">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="30" viewBox="0 0 24 20">
                            <path fill="currentColor" d="M19 2h-4.18C14.4.84 13.3 0 12 0S9.6.84 9.18 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1s-1-.45-1-1s.45-1 1-1zm7 18H5V4h2v3h10V4h2v16z"/>
                        </svg>
                        <p>Quản lí đơn</p>
                    </div>
                </a>
                <a href="listed_account.php" id="account-link">
                    <div class="choose">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="30" viewBox="0 0 20 18" style="position: relative; bottom: 1px;">
                            <path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <p>Tài Khoản</p>
                    </div>
                </a>
                <a href="../home.php" id="web-link">
                    <div class="choose">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="30" viewBox="0 0 24 10" style="position: relative; bottom: 5px;">
                            <path fill="currentColor" d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/>
                        </svg>
                        <p>Website GenZ</p>
                    </div>
                </a>
            </div>
            <a href="../logout.php" id="logout">Đăng xuất</a>
        </div>
        <div class="name-page" onclick="myFunction()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2 3h20v3H2V3zm7 5h13v3H9V8zm0 5h13v3H9v-3zm-7 5h20v3H2v-3zM6 8l-4 4l4 4h1V8H6z" /></svg>
            <p>Admin<span id="page-content"> / <?php echo $content; ?></span></p>
        </div>
    </div>
    <div id="preloader"></div>
    <script>
    function redirectToHome() {
        window.location.href = "../home.php";
    }
</script>
</body>

</html>