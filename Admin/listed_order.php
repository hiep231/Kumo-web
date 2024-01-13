<?php 
    $nth = 6;
    $content = "Quản lí đơn hàng";
    session_start();
    if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
        $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
    }
    include 'admin_leftside.php';
    $fileName = "order.php";
    require_once '../connectDB.php';

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/listed.css">
    <style>
        .page-<?php echo $page ?> {
            background: #6fcb6c;
        }

    </style>
</head>
<body>
    <div class="rightside">
        <div class="container mt-3">
            <form  id="searchForm" method="post" action="listed_order.php">
                <input type="text" name="search" id="searchInput" value="<?php echo isset($_POST["search"]) ? $_POST["search"] : ''; ?>" placeholder="Sản phẩm">
                <button type="submit" name="submit" onclick="submitForm()" class="search btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 0 24 24" style="position: relative;bottom:2px;"><path fill="#00000" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.612 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.313T14 9.5q0-1.875-1.313-3.188T9.5 5Q7.625 5 6.312 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z"/></svg></button>
            </form>
            <?php
                $sql = "SELECT * FROM orders";
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
                    $lietke_sql = "SELECT * FROM orders WHERE customer LIKE ? LIMIT $startingLimit, $elementOfPages";
                    $stmt = mysqli_prepare($conn, $lietke_sql);
                    mysqli_stmt_bind_param($stmt, "s", $searchValue);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    $count_sql = "SELECT COUNT(*) as count FROM orders WHERE customer LIKE ?";
                    $count_stmt = mysqli_prepare($conn, $count_sql);
                    mysqli_stmt_bind_param($count_stmt, "s", $searchValue);
                    mysqli_stmt_execute($count_stmt);
                    $count_result = mysqli_stmt_get_result($count_stmt);
                    $count_row = mysqli_fetch_assoc($count_result);
                    $num = $count_row['count'];

                    $totalPages = ceil($num / $elementOfPages);
               }else {
                    $lietke_sql = "SELECT * FROM orders LIMIT $startingLimit, $elementOfPages";
                    $result = mysqli_query($conn, $lietke_sql);
               }
            ?>
            <button class="btn btn-color my-1 p-1" id="prevPage">
                <?php if ($page > 1) : ?>
                    <a href="listed_order.php?page=<?php echo ($page - 1); ?>&search=<?php echo (isset($_GET['search']) ? urlencode($_GET['search']) : ''); ?>" class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 24 24"><path fill="#00000" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225L16 22Z"/></svg></a>
                <?php else :?>
                    <a class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 24 24"><path fill="#00000" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225L16 22Z"/></svg></a>
                <?php endif; ?>
            </button>
                <?php
                for ($btn = 1; $btn <= $totalPages; $btn++) {
                    echo '<button class="btn btn-color mx-md-1 my-1 p-1 page-' . $btn . '"><a href="listed_order.php?page=' . $btn . '&search=' . (isset($_GET['search']) ? urlencode($_GET['search']) : '') . '" class="text-dark fw-bold text-decoration-none py-1 px-3">' . $btn . '</a></button>';
                }
            ?>
            <button class="btn btn-color my-1 p-1" id="nextPage">
                <?php if ($page < $totalPages) : ?>
                    <a href="listed_order.php?page=<?php echo ($page + 1); ?>&search=<?php echo (isset($_GET['search']) ? urlencode($_GET['search']) : ''); ?>" class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 20"><path fill="#00000" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg></a>
                    <?php else :?>
                        <a class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 20"><path fill="#00000" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg></a>
                    <?php endif; ?>
            </button>
            

            <div style="overflow-x:auto;" class="sticky-table">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:10%;">#</th>
                            <th>Mã code</th>
                            <th>Khách hàng</th>
                            <th>Trạng thái</th>
                            <th>Số điện thoại</th>
                            <th>Ghi chú</th>
                            <th>Địa chỉ</th>
                            <th>Tổng trước giảm</th>
                            <th>Giảm giá</th>
                            <th>Tổng tiền</th>
                            <th>Thời gian</th>
                            <th style="width:10%;"><span>Chi tiết sản phẩm</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        while ($r = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td id="td" style="width:10%;"><?php echo $index ?></td>
                                <td><?php echo $r['orderCode'] ?></td>
                                <td><?php echo $r['customer'] ?></td>
                                <td>
                                    <button class="btn <?php 
                                        if ($r['statusName'] == 'Huỷ đơn hàng') {
                                            echo 'btn-danger';
                                        } elseif ($r['statusName'] == 'Đã giao thành công') {
                                            echo 'btn-success';
                                        }elseif ($r['statusName'] == 'Đang xử lí') {
                                            echo 'btn-info';
                                        } else {
                                            echo 'btn-primary';
                                        }
                                    ?>" id="status_<?php echo $r['id']; ?>">
                                        <?php echo $r['statusName'] ?>
                                    </button>
                                </td>
                                <td><?php echo $r['phone'] ?></td>
                                <td><?php echo $r['note'] ?></td>
                                <td><?php echo $r['location'] ?></td>
                                <td><?php echo number_format($r['totalAmountTemporary'], 0, ',', '.') ?> VND</td>
                                <td><?php echo number_format($r['totalPromotion'], 0, ',', '.') ?> VND</td>
                                <td><?php echo number_format($r['totalAmount'], 0, ',', '.') ?> VND</td>
                                <td><?php echo $r['time'] ?></td>
                                <td class="icon-operation" style="width:10%;">
                                    <span>
                                        <a href="listed_order.php?id=<?php echo $r['id'];?>" class="btn view btn-outline-info" onclick="toggleDetailOrder(<?php echo $r['id']; ?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3z"/></svg>
                                        </a>
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
    <?php
        if (isset($_GET['id'])){

        $id = $_GET['id'];
    ?>
    <div class="detail-order" id="detail-order" >
        <div  class="sticky-table">
            <div class="header-detail-order">
                <div class="total-detail">
                    <?php
                        $queryTotal_sql = "SELECT * FROM orders where id = $id";
                        $result = mysqli_query($conn, $queryTotal_sql);
                        while ($r = mysqli_fetch_array($result)) {
                            ?>
                            <p><b>- Tên khách hàng: </b><?php echo $r['customer'] ?></p>
                            <p><b>- Địa chỉ: </b><?php echo $r['location'] ?></p>
                            <p><b>- Sđt: </b><?php echo $r['phone'] ?></p>

                            <p><b>- Email: </b><?php echo $r['email'] ?></p>
                            <p><b>- Giảm giá: </b><?php echo number_format($r['totalPromotion'], 0, ",", ".") ?> VND</p>
                            <b>Tổng hóa đơn: <?php echo number_format($r['totalAmount'], 0, ",", ".") ?> VND</b>
                            
                        <?php
                        echo '<script>
                            let id = "' . $id . '";
                        </script>';
                        ?>

                </div>
                <a href="listed_order.php" class="dialog-close-btn" onclick="saveDropdownContent()"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#888888" d="m12 12.708l-5.246 5.246q-.14.14-.344.15q-.204.01-.364-.15t-.16-.354q0-.194.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344q-.01-.204.15-.364t.354-.16q.194 0 .354.16L12 11.292l5.246-5.246q.14-.14.344-.15q.204-.01.364.15t.16.354q0 .194-.16.354L12.708 12l5.246 5.246q.14.14.15.344q.01.204-.15.364t-.354.16q-.194 0-.354-.16L12 12.708Z"/></svg></a>
                <div class="btn-status">
                    <button class="dropbtn" id="dropdownBtn"><?php echo $r['statusName'] ?></button>
                    <div class="dropdown-content">
                        <a class="btn " onclick="changeButtonText(this)">Đã xử lí</a>
                        <a class="btn" onclick="changeButtonText(this)">Đang xử lí</a>
                        <a class="btn" onclick="changeButtonText(this)">Đã giao thành công</a>
                        <a class="btn" onclick="changeButtonText(this)">Huỷ đơn hàng</a>
                    </div>
                </div>
            </div>
            
            <table class="table table-bordered table-hover">
                <thead>
                    <tr >
                        <th>#</th>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Kích thước</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $id = $_GET['id'];
                        $detailOrder_sql = "
                        SELECT  product, price, quantity, size, images FROM orderitem  WHERE orders = ?";
                        $stmt = mysqli_prepare($conn, $detailOrder_sql);
                        mysqli_stmt_bind_param($stmt, "s", $id);
                        mysqli_stmt_execute($stmt);
                        $resultOderitem = mysqli_stmt_get_result($stmt);

                        $indexOderitem = 1;
                        while ($r = mysqli_fetch_array($resultOderitem)) {
                            $image = $r['images'];


                            ?>
                            <tr>
                                <td><?php echo $indexOderitem ?></td>
                                <td>
                                    <?php echo '<img src="' . $image . '" alt="Ảnh"  style="object-fit: contain; width: 100px; height: 100px;" />' ?>
                                </td>
                                <td  style="white-space: normal;"><?php echo $r['product'] ?></td>
                                <td><?php echo number_format($r['price'], 0, ",", ".") ?> VND </td>
                                <td><?php echo $r['quantity'] ?></td>
                                <td><?php echo $r['size'] ?></td>
                                
                            </tr>
                            <?php
                            $indexOderitem++;
                        }
                    
                        if (mysqli_num_rows($result) == 0) {
                            echo 'No results found.';
                        }
                    ?>
                    
                </tbody>
            </table>
            <!-- <div class="delete-order">
                <a onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không.')" href="delete_product.php?orderid=<?php echo $id;?>" class="btn btn-danger">HỦY ĐƠN HÀNG</a>
            </div> -->
        </div>
        <?php } ?>
    </div>
    <?php
        }
    ?>
    <script src="change.js"></script>
    <script>
        var currentPage = <?php echo $page; ?>;
        var totalPages = <?php echo $totalPages; ?>;
        
        function changeButtonText(element) {
            var buttonText = element.innerText;
            document.getElementById('dropdownBtn').innerText = buttonText;
        }
        //Hàm lưu status 
        function saveDropdownContent() {
            var dropdownContent = document.getElementById('dropdownBtn').innerText.trim();

            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_status.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Gửi dữ liệu
            xhr.send('dropdownContent=' + encodeURIComponent(dropdownContent) + '&id=' + encodeURIComponent(id));

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
        }

        function submitForm() {
            var searchInputValue = document.getElementById('searchInput').value;
            var formAction = 'listed_order.php?search=' + encodeURIComponent(searchInputValue);
            document.getElementById('searchForm').action = formAction;
            document.getElementById('searchForm').submit();
        }
    </script>

</body>
</html>

