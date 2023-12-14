<?php
require_once 'connectDB.php';

$idpage = isset($_GET['page']) ? $_GET['page'] : 1;
session_start();
// if (isset($_SESSION['user_id'])) {
//     $user_id = $_SESSION['user_id'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        .pagination button#page-<?php echo $idpage ?> {
            background: #ed975b;
        }
    </style>
</head>
<body>
    
    <section id="page-header">           
            <h1>#TietKiem</h1> <br>
            <p>Tiết kiệm hơn với mã giảm giá và giảm giá lên đến 70%!!</p>
    </section>

    <!-- trending-products-section -->
    <section class="trending-product" id="trending">
        <!-- <div class="center-text">
            <h2>Sản phẩm <span>Nổi bật</span></h2>
        </div> -->
        <div class="products">
            <?php
                // $sql = "SELECT * FROM product LIMIT 80";
                // $sresult = mysqli_query($conn, $sql);
                // $num = mysqli_num_rows($sresult);
                // $numberpages = 16;
                // $totalPages = ceil($num / $numberpages);
                // // Check if 'page' parameter is set in the URL
                // if (isset($_GET['page'])) {
                //     $page = $_GET['page'];
                // } else {
                //     $page = 1;
                // }
                // $startingLimit = ($page - 1) * $numberpages;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $numberpages = 8;
                $startingLimit = ($page - 1) * $numberpages;
                
                if (isset($_GET['category'])) {
                    $category = $_GET['category'];      
                    $lietke_sql = "SELECT product.id as id, name, product.price, ratingStar, images, specName, brand, promotion.price as pro_price, describes, ratingStar 
                        FROM product 
                        JOIN promotion ON product.salePromotion = promotion.id 
                        WHERE category = ? 
                        ORDER BY product.id 
                        LIMIT ?, ?";
                    
                    $stmt = mysqli_prepare($conn, $lietke_sql);
                    mysqli_stmt_bind_param($stmt, "sii", $category, $startingLimit, $numberpages);
                    mysqli_stmt_execute($stmt);
                    
                    $result = mysqli_stmt_get_result($stmt); 

                    $count_sql = "SELECT COUNT(*) as count FROM product WHERE category = ?";
                    $count_stmt = mysqli_prepare($conn, $count_sql);
                    mysqli_stmt_bind_param($count_stmt, "s", $category);
                    mysqli_stmt_execute($count_stmt);
                    $count_result = mysqli_stmt_get_result($count_stmt);
                    $count_row = mysqli_fetch_assoc($count_result);
                    $num = $count_row['count'];

                    
                    $totalPages = ceil($num / $numberpages);
                    

                } 
                else{
                    $lietke_sql = "SELECT product.id as id,name,product.price,ratingStar,images,specName,brand,promotion.price as pro_price,describes,ratingStar FROM product JOIN promotion ON product.salePromotion  = promotion.id ORDER BY product.id LIMIT $startingLimit, $numberpages ";
                    $result = mysqli_query($conn, $lietke_sql);

                    $sql = "SELECT * FROM product ";
                    $sresult = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($sresult);
                    // $numberpages = 16;
                    $totalPages = ceil($num / $numberpages);
                    // Check if 'page' parameter is set in the URL
                    // if (isset($_GET['page'])) {
                    //     $page = $_GET['page'];
                    // } else {
                    //     $page = 1;
                    // }
                    // $startingLimit = ($page - 1) * $numberpages;

                    
                }

                
                
                if (isset($_POST["submit"])) {
                    $searchValue = '%' . $_POST["search"] . '%';
                    if ($searchValue != '') {
                        $lietke_sql = "SELECT product.id as id,name,product.price,ratingStar,images,specName,brand,promotion.price as pro_price,describes,ratingStar FROM product JOIN promotion ON product.salePromotion  = promotion.id and name LIKE ? LIMIT $startingLimit, $numberpages";
                        $stmt = mysqli_prepare($conn, $lietke_sql);
                        mysqli_stmt_bind_param($stmt, "s", $searchValue);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                    }
                }

                $index = 1;
                while ($r = mysqli_fetch_array($result)) {
                    $array_image = explode(",", $r['images']);
                    $image = $array_image[0];
                    ?>
                    <div class="row" onclick="window.location.href='product.php?id=<?php echo $r['id']; ?>';">
                        <div class="img">
                            <?php echo '<img src="http://localhost/Kumo/' . $image . '" alt="Ảnh 1" />' ?>
                        </div>
                        <div class="product-text">
                            <h5>Sale</h5>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bxs-heart'></i>
                        </div>
                        <div class="cart-icon">
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
                        </div>
                        <button class="Order" onclick="window.location.href='product.php?id=<?php echo $r['id']; ?>'">Đặt hàng</button>
                    </div>
                    <?php
                }
                    
            ?>

        </div>
    </section>
    
    <?php
        // $sql = "SELECT * FROM product ";
        // $sresult = mysqli_query($conn, $sql);
        

        
    ?>
    <div class="pagination">
        <button id="prevPage" style="position: relative; left:4px; padding: 6px 10px"><a  onclick="prevPage()"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" style="position: relative; top: 2px;"><path fill="#00000" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225L16 22Z"/></svg></a></button>
        <?php
            for ($btn = 1; $btn <= $totalPages; $btn++) {
                
                
                
                if (isset($_GET['category'])) {
                    echo '<button id="page-' . $btn . '"><a href="shop.php?category=' . $category . '&page=' . $btn . '">' . $btn . '</a></button>';
                } else {
                    echo '<button id="page-' . $btn . '" ><a href="shop.php?page=' . $btn . '">' . $btn . '</a></button>';
                }
                
            }
        ?>
        <button id="nextPage" style="position: relative; right:4px; padding: 6px 10px"><a onclick="nextPage()"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 20 20" style="position: relative; top: 2px;"><path fill="#00000" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg></a></button>
    </div>
    
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

    <script>
        var currentPage = <?php echo $page; ?>;
        var totalPages = <?php echo $totalPages; ?>;

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                changePage(currentPage);
            }
        }

        function nextPage() {
            if (currentPage < totalPages) {
                currentPage++;
                changePage(currentPage);
            }
        }
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
        function changePage(page) {
            window.location.href = 'shop.php?page=' + page;
        }
    </script>
</body>
</html>
