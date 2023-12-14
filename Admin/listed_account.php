<?php 
ob_start();
$nth = 7;
$content = "Quản lý tài khoản";
session_start();
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
    $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
}
// include 'add_product.html';
include 'admin_leftside.php';
$fileName = "account_admin.php";
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
$registerMessage = '';
function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
if (isset($_GET['success']) && $_GET['success'] == 1) {
    // Display the success message
    echo '<script>alert("Tài khoản đã đăng ký thành công!");</script>';
}

if(isset($_POST['submit-register'])){
   
    $email = $_POST['email'];
    // $email = filter_var($email, FILTER_SANITIZE_STRING);
    
    $userName = $_POST['name'];
    // $userName = filter_var($userName, FILTER_SANITIZE_STRING);
    
    $passwords = $_POST['pass'];
    // $passwords = filter_var($passwords, FILTER_SANITIZE_STRING);
 
    $cpasswords = $_POST['cpass'];
    // $cpasswords = filter_var($cpasswords, FILTER_SANITIZE_STRING);
    $passwordPattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{5,}$/';

 
    // if ($_POST['user_type'] == 'admin'){
    //    $isAdmin = true;
    //    $isUser = false;
    // }else {
    //    $isAdmin = false;
    //    $isUser = true;
    // }
    $isAdmin = ($_POST['user_type'] == 'admin')? true: false;
    

    if (!preg_match($passwordPattern, $passwords)) {
        $registerMessage = 'Mật khẩu phải có ít nhất 5 kí tự, bao gồm ít nhất một chữ hoa, một chữ thường, một số và một kí tự đặc biệt.';
    } else {
        $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select->execute([$email]);
    
        // Fetch the result before checking the number of rows
        $result = $select->fetch();
    
        if($result){
        $registerMessage = 'Email này đã tạo tài khoản trước đó!';
        }else{
            if($passwords != $cpasswords){
                $registerMessage = 'Mật khẩu xác nhận không đúng';
            } else {
                if($passwords != $cpasswords){
                   $registerMessage = 'Mật khẩu xác nhận không đúng';
                } else {
                //    $insert = $conn->prepare("INSERT INTO `users` (phone, email, userName, passwords, avatar,gender,addressesList,isAdmin,isUser) VALUES ('',?, ?, ?, ?, '', '', ?, ?)");
                //    $insert->execute([$email, $userName, md5($passwords), 'man-user.png', $isAdmin, $isUser]);
                   
                //    // Đặt thông báo vào session
                //    $_SESSION['registerMessage'] = 'Tài khoản đã đăng ký thành công!';
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        // Kiểm tra xem email có kết thúc bằng "@gmail.com" không
                        if (endsWith($email, "@gmail.com")) {
                            //   // echo "Địa chỉ email hợp lệ!";
                            //   $insert = $conn->prepare("INSERT INTO `users` (phone, email, userName, passwords, avatar,gender,addressesList,isAdmin,isUser) VALUES ('',?, ?, ?, ?, '', '', 0, 1)");
                            //   $insert->execute([$email, $userName, md5($passwords), 'man-user.png']);
                                
                            //   // Đặt thông báo vào session
                            //   $_SESSION['registerMessage'] = 'Tài khoản đã đăng ký thành công!';
                                
                            //   // Chuyển hướng đến trang đăng nhập
                            //   header('Location: login_form.php?success=1');
                            $code = rand(0000,9999);
                            $info = [$userName, $email, $code, $passwords, $isAdmin];   
                            $_SESSION['register'] = $info; 
                            header('Location: ../email/confirm_account.php');
                            exit();
                        } else {
                            $registerMessage= "Địa chỉ email không kết thúc bằng @gmail.com!";
                        }
                    } else {
                        $registerMessage= "Địa chỉ email không hợp lệ!";
                    }
                }
             }
        }
    }
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
    <div class="rightside">
        <div class="container mt-3">  <!-- class="container" -->
            <!-- <a href="add-account-admin.php"><button class="btn btn-primary" id="create-admin">Tạo tài khoản</button></a> -->
            <button class="btn btn-primary" id="create-admin" popovertarget="modal">Tạo tài khoản</button>
            <div class="form-login-admin" id="modal" popover>
                <div class="form-container">
                    <!-- <a href="listed_account.php" class="dialog-close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#888888" d="m12 12.708l-5.246 5.246q-.14.14-.344.15q-.204.01-.364-.15t-.16-.354q0-.194.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344q-.01-.204.15-.364t.354-.16q.194 0 .354.16L12 11.292l5.246-5.246q.14-.14.344-.15q.204-.01.364.15t.16.354q0 .194-.16.354L12.708 12l5.246 5.246q.14.14.15.344q.01.204-.15.364t-.354.16q-.194 0-.354-.16L12 12.708Z"/></svg></a> -->

                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>Đăng ký</h3>
                        <?php if(!empty($registerMessage)): ?>
                            <div><?php echo $registerMessage; ?></div>
                        <?php endif; ?>
                        <input type="text" name="name" required placeholder="Nhập tên">
                        <input type="email" name="email" required placeholder="Nhập email">
                        <input type="password" name="pass" required placeholder="Nhập mật khẩu">
                        <input type="password" name="cpass" required placeholder="Nhập lại mật khẩu">
                        <!-- <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png"> -->
                        <select name="user_type">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                        <input type="submit" name="submit-register" value="Đăng ký" class="form-btn">
                        <!-- <p>Bạn đã có tài khoản? <a href="../login_form.php">Đăng nhập ngay</a></p> -->
                    </form>

                </div>
            </div>
            <form  id="searchForm" method="post" action="listed_account.php">
                <input type="text" name="search" id="searchInput" value="<?php echo isset($_POST["search"]) ? $_POST["search"] : ''; ?>" placeholder="Sản phẩm">
                <button type="submit" name="submit" onclick="submitForm()" class="search btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 0 24 24" style="position: relative;bottom:2px;"><path fill="#00000" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.612 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.313T14 9.5q0-1.875-1.313-3.188T9.5 5Q7.625 5 6.312 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z"/></svg></button>
            </form>
            <?php
                $sql = "SELECT * FROM users";
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
                    $lietke_sql = "SELECT * FROM users WHERE UserName LIKE ? LIMIT $startingLimit, $elementOfPages";
                    $stmt = mysqli_prepare($conn, $lietke_sql);
                    mysqli_stmt_bind_param($stmt, "s", $searchValue);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    $count_sql = "SELECT COUNT(*) as count FROM users WHERE UserName LIKE ?";
                    $count_stmt = mysqli_prepare($conn, $count_sql);
                    mysqli_stmt_bind_param($count_stmt, "s", $searchValue);
                    mysqli_stmt_execute($count_stmt);
                    $count_result = mysqli_stmt_get_result($count_stmt);
                    $count_row = mysqli_fetch_assoc($count_result);
                    $num = $count_row['count'];

                    $totalPages = ceil($num / $elementOfPages);
                }else {
                    $lietke_sql = "SELECT * FROM users LIMIT $startingLimit, $elementOfPages";
                    $result = mysqli_query($conn, $lietke_sql);
                }
            ?>
            <button class="btn btn-color my-1 p-1" id="prevPage">
                <?php if ($page > 1) : ?>
                    <a href="listed_account.php?page=<?php echo ($page - 1); ?>&search=<?php echo (isset($_GET['search']) ? urlencode($_GET['search']) : ''); ?>" class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 24 24"><path fill="#00000" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225L16 22Z"/></svg></a>
                <?php else :?>
                    <a class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 24 24"><path fill="#00000" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225L16 22Z"/></svg></a>
                <?php endif; ?>
            </button>
                <?php
                for ($btn = 1; $btn <= $totalPages; $btn++) {
                    echo '<button class="btn btn-color mx-md-1 my-1 p-1 page-' . $btn . '"><a href="listed_account.php?page=' . $btn . '&search=' . (isset($_GET['search']) ? urlencode($_GET['search']) : '') . '" class="text-dark fw-bold text-decoration-none py-1 px-3">' . $btn . '</a></button>';
                }
            ?>
            <button class="btn btn-color my-1 p-1" id="nextPage">
                <?php if ($page < $totalPages) : ?>
                    <a href="listed_account.php?page=<?php echo ($page + 1); ?>&search=<?php echo (isset($_GET['search']) ? urlencode($_GET['search']) : ''); ?>" class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 20"><path fill="#00000" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg></a>
                    <?php else :?>
                        <a class="text-dark fw-bold text-decoration-none py-1 px-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 20"><path fill="#00000" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg></a>
                    <?php endif; ?>
            </button>
            

            <div style="overflow-x:auto;" class="sticky-table">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:10%;">#</th>
                            <th>Ảnh đại diện</th>
                            <th>Tên</th>
                            <th>Giới tính</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <!-- <th>Chức năng</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        while ($r = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td id="td" style="width:10%;"><?php echo $index ?></td>
                                <td><?php echo '<img src="http://localhost/Kumo/avatar_img/' . $r['avatar'] . '" alt="Ảnh 1" />' ?></td>
                                <td><?php echo $r['userName'] ?></td>
                                <td><?php echo $r['gender'] ?></td>
                                <td><?php echo $r['phone'] ?></td>
                                <td><?php echo $r['addressesList'] ?></td>
                                <td><?php echo $r['email'] ?></td>
                                <td>
                                    <button onclick="updateRole(this, <?php echo $r['id']; ?>)" class="btn <?php 
                                        echo ($r['isAdmin'] == 1) ? 'btn-danger' : 'btn-primary';
                                    ?>" id="role_<?php echo $r['id']; ?>">
                                        <?php echo ($r['isAdmin'] == 1) ? 'Admin' : 'Khách hàng'; ?>
                                    </button>
                                </td>
                                <!-- <td class="icon-operation">
                                    <span>
                                        <a onclick="return confirm('Bạn có muốn xóa tài khoản này không.')" href="delete_product.php?accountid=<?php echo $r['id'];?>" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg></a>
                                    </span>
                                </td> -->
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

        // function changePage(page) {
        //     // Chuyển đến trang mới bằng cách cập nhật URL
        //     window.location.href = 'account_admin.php?page=' + page;
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
        function updateRole(element, userId) {
            var confirmation = confirm('Bạn có chắc muốn thay đổi không?');
            
            if (confirmation) {
                // Gửi yêu cầu AJAX để cập nhật vai trò dựa trên userId
                var buttonText = element.innerText;
                var newButtonText = (buttonText === 'Admin') ? 'Khách hàng' : 'Admin';
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Xử lý kết quả nếu cần
                        console.log(xhr.responseText);
                        // Cập nhật giao diện người dùng nếu cần
                        element.innerHTML = newButtonText; // Update the content immediately
                        element.className = 'btn ' + ((newButtonText === 'Admin') ? 'btn-danger' : 'btn-primary');
                    }
                };
                
                // Thiết lập yêu cầu POST đến một tập lệnh PHP xử lý việc cập nhật
                xhr.open('POST', 'update_role.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('userId=' + userId);
            }
        }
        function submitForm() {
            var searchInputValue = document.getElementById('searchInput').value;
            var formAction = 'listed_account.php?search=' + encodeURIComponent(searchInputValue);
            document.getElementById('searchForm').action = formAction;
            document.getElementById('searchForm').submit();
        }
    </script>

</body>
</html>
<?php
ob_end_flush();
?>
