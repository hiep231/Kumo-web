<?php 
$nth = 2;
$content = "Áo";
session_start();
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
    $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
}
include 'admin_leftside.php';
$fileName = "listed_ao.php";
require_once 'connectDB.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
// Check for a database connection error
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Clothes Shopping</title>
    <!-- Use correct Bootstrap URLs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="listed.css">
    <style>
        .page-<?php echo $page ?> {
            background: #6fcb6c;
        }
    </style>
</head>
<body>
    <!-- <div id="preloader"></div> -->
    <div class="rightside">
        <div class="container mt-3"> 
            <form  id="searchForm" method="post" action="listed_ao.php">
                <input type="text" name="search" id="searchInput" value="<?php echo isset($_POST["search"]) ? $_POST["search"] : ''; ?>" placeholder="Sản phẩm">
                <button type="submit" name="submit" onclick="submitForm()" class="search btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 0 24 24" style="position: relative;bottom:2px;"><path fill="#00000" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.612 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.313T14 9.5q0-1.875-1.313-3.188T9.5 5Q7.625 5 6.312 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z"/></svg></button>
            </form>
            <?php
                $sql = "SELECT * FROM product WHERE category IN ('Áo phông', 'Áo polo', 'Sơ mi')";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                $elementOfPages = 10;
                $totalPages = ceil($num / $elementOfPages);

                $startingLimit = ($page - 1) * $elementOfPages;


                if (isset($_GET["search"])) {
                    $searchValue = '%' . $_GET["search"] . '%';
                    // echo $searchValue;
                }
                    if (isset($searchValue)) {
                        // $startingLimit = 0;
                        $lietke_sql = "SELECT product.id,name,product.price,images,specName,brand,promotion.price as pro_price,describes,ratingStar FROM product JOIN promotion ON product.salePromotion  = promotion.id WHERE product.name LIKE ? AND category IN ('Áo phông', 'Áo polo', 'Sơ mi') LIMIT $startingLimit, $elementOfPages";
                        $stmt = mysqli_prepare($conn, $lietke_sql);
                        mysqli_stmt_bind_param($stmt, "s", $searchValue);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        // var_dump($lietke_sql);

                        $count_sql = "SELECT COUNT(*) as count FROM product WHERE name LIKE ? and category IN ('Áo phông', 'Áo polo', 'Sơ mi')";
                        $count_stmt = mysqli_prepare($conn, $count_sql);
                        mysqli_stmt_bind_param($count_stmt, "s", $searchValue);
                        mysqli_stmt_execute($count_stmt);
                        $count_result = mysqli_stmt_get_result($count_stmt);
                        $count_row = mysqli_fetch_assoc($count_result);
                        $num = $count_row['count'];
    
                        
                        $totalPages = ceil($num / $elementOfPages);
                }else {
                    $lietke_sql = "SELECT product.id,name,product.price,images,specName,brand,promotion.price as pro_price,describes,ratingStar FROM product JOIN promotion ON product.salePromotion  = promotion.id WHERE category IN ('Áo phông', 'Áo polo', 'Sơ mi') LIMIT $startingLimit, $elementOfPages";
                    $result = mysqli_query($conn, $lietke_sql);
                }
            ?>
            <button class="btn btn-color my-1 p-1" id="prevPage">
                <?php if ($page > 1) : ?>
                    <a href="listed_ao.php?page=<?php echo ($page - 1); ?>&search=<?php echo (isset($_GET['search']) ? urlencode($_GET['search']) : ''); ?>" class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 24 24"><path fill="#00000" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225L16 22Z"/></svg></a>
                <?php else :?>
                    <a class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 24 24"><path fill="#00000" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225L16 22Z"/></svg></a>
                <?php endif; ?>
            </button>
                <?php
                for ($btn = 1; $btn <= $totalPages; $btn++) {
                    echo '<button class="btn btn-color mx-md-1 my-1 p-1 page-' . $btn . '"><a href="listed_ao.php?page=' . $btn . '&search=' . (isset($_GET['search']) ? urlencode($_GET['search']) : '') . '" class="text-dark fw-bold text-decoration-none py-1 px-3">' . $btn . '</a></button>';
                }
            ?>
            <button class="btn btn-color my-1 p-1" id="nextPage">
                <?php if ($page < $totalPages) : ?>
                    <a href="listed_ao.php?page=<?php echo ($page + 1); ?>&search=<?php echo (isset($_GET['search']) ? urlencode($_GET['search']) : ''); ?>" class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 20"><path fill="#00000" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg></a>
                    <?php else :?>
                        <a class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 20"><path fill="#00000" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg></a>
                    <?php endif; ?>
            </button>
            
            <div style="overflow-x:auto;" class="sticky-table">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:10%;">#</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Id</th>
                            <th>Tên viết tắt</th>
                            <th>Thương hiệu</th>
                            <th>Giá</th>
                            <th>Khuyến mãi</th>
                            <th>Mô tả</th>
                            <th>Đánh giá</th>
                            <th style="width:10%;"><span>Chức năng</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php
                        $index = 1;
                        while ($r = mysqli_fetch_array($result)) {
                            $array_image = explode(",", $r['images']);
                            $image1 = $array_image[0];
                            $image2 = $array_image[1];
                            ?>
                            <tr>
                                <td id="td" style="width:10%;"><?php echo $index ?></td>
                                <td><?php echo $r['name'] ?></td>
                                <td>
                                    <?php echo '<img src="http://localhost/Kumo/' . $image1 . '" alt="Ảnh 1" />' ?>
                                    <?php echo '<img src="http://localhost/Kumo/' . $image2 . '" alt="Ảnh 2" />' ?>
                                </td>
                                <td><?php echo $r['id'] ?></td>
                                <td><?php echo $r['specName'] ?></td>
                                <td><?php echo $r['brand'] ?></td>
                                <td><?php echo number_format($r['price'], 0, ',', '.') ?> VND</td>
                                <td><?php echo number_format($r['pro_price'], 0, ',', '.') ?> VND</td>
                                <td><?php echo $r['describes'] ?></td>
                                <td><?php echo $r['ratingStar'] ?> Sao</td>

                                <td class="icon-operation" style="width:10%;">
                                    <span>
                                        <a href="edit_product.php?sid=<?php echo $r['id'];?>" class="btn btn-outline-success"><svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24"><path fill="currentColor" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75L3 17.25Z"/></svg></a>
                                        <a href="../product.php?id=<?php echo $r['id'];?>" class="btn btn-outline-info"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M4 6.49L.79 9.67a1 1 0 0 0 0 1.42l2.12 2.12a1 1 0 0 0 1.42 0L7.51 10M10 7.51l3.18-3.18a1 1 0 0 0 0-1.42L11.09.79a1 1 0 0 0-1.42 0L6.49 4M9 5L5 9"/></svg></a>
                                        <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không.')" href="delete_product.php?productid=<?php echo $r['id'];?>" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg></a>
                                    </span>
                                </td>
                            </tr>
                            <?php
                            $index++;
                        }
                        
                        if (mysqli_num_rows($result) == 0) {
                            echo 'No results found.';
                        }

                        
                        ?>
                    </tbody>
                </table>     
            </div>
        </div>
    </div>
    <script src="change.js"></script>
    <script>
        var currentPage = <?php echo $page; ?>;
        var totalPages = <?php echo $totalPages; ?>;
        
        // function prevPage() {
        //     if (currentPage > 1) {
        //         currentPage--;
        //         changePage(currentPage);
        //     }
        // }

        // function nextPage() {
        //     if (currentPage < totalPages) {
        //         currentPage++;
        //         changePage(currentPage);
        //     }
        // }

        // function changePage(page) {
        //     window.location.href = 'listed_ao.php?page=' + page + '&search=' + encodeURIComponent(document.getElementById('searchInput').value);
        // }
        // if (currentPage===totalPages) {
        //     var nextPageElement = document.getElementById("nextPage");
        //     if (nextPageElement) {
        //         nextPageElement.style.backgroundColor = "#b7bab6";
        //     }
        // }
        // if (currentPage === 1) {
        //     var prevPageElement = document.getElementById("prevPage");
        //     if (prevPageElement) {
        //         prevPageElement.style.backgroundColor = "#b7bab6";
        //     }
        // }

        function submitForm() {
            var searchInputValue = document.getElementById('searchInput').value;
            var formAction = 'listed_ao.php?search=' + encodeURIComponent(searchInputValue);
            document.getElementById('searchForm').action = formAction;
            document.getElementById('searchForm').submit();
        }

    </script>

</body>
</html>
