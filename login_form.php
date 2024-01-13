<?php

include "connectDB.php";

session_start();

// // Kiểm tra nếu có thông báo trong session
// if(isset($_SESSION['registerMessage'])){
//    echo '<div>'.$_SESSION['registerMessage'].'</div>';

//    // Xóa thông báo khỏi session để đảm bảo rằng nó chỉ được hiển thị một lần
//    unset($_SESSION['registerMessage']);
// }
if (isset($_GET['success']) && $_GET['success'] == 1) {
   // Display the success message
   echo '<script>alert("Tài khoản đã đăng ký thành công!");</script>';
}

if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $password = $_POST['pass'];

   $sql = "SELECT * FROM `users` WHERE email = ?";
   $stmt = mysqli_prepare($conn, $sql);
   mysqli_stmt_bind_param($stmt, "s", $email);
   mysqli_stmt_execute($stmt);

   $result = mysqli_stmt_get_result($stmt);

   if ($result->num_rows > 0) {
      $row = mysqli_fetch_array($result);

      // Check if the password is correct
      if (md5($password) == $row['passwords']) {
         if ($row['isAdmin'] == '1') {
               $_SESSION['admin_id'] = $row['id'];
               header('location:Admin/admin_home.php');
               exit;
         } else if ($row['isAdmin'] == '0') {
               $_SESSION['user_id'] = $row['id'];
               header('location:home.php');
               exit;
         }
      } else {
         $loginMessage[] = 'Mật khẩu không đúng!';
      }
   } else {
      $loginMessage[] = 'Tài khoản không tồn tại!';
   }

   mysqli_stmt_close($stmt);
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/identified.css">

</head>
<body>

<div class="form-container">
   <a href="home.php" class="dialog-close-btn-login"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#888888" d="m12 12.708l-5.246 5.246q-.14.14-.344.15q-.204.01-.364-.15t-.16-.354q0-.194.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344q-.01-.204.15-.364t.354-.16q.194 0 .354.16L12 11.292l5.246-5.246q.14-.14.344-.15q.204-.01.364.15t.16.354q0 .194-.16.354L12.708 12l5.246 5.246q.14.14.15.344q.01.204-.15.364t-.354.16q-.194 0-.354-.16L12 12.708Z"/></svg></a>

   <form action="" method="post">
      <h3>Đăng nhập</h3>
      <?php
      // echo $passwords;
      // echo $_SESSION['user_id'];
         if(isset($loginMessage)){
            foreach($loginMessage as $message){
               echo '
               <div class="message">
                  <span>'.$message.'</span>
               </div>
               ';
            }
         }
      ?>
      <input type="email" name="email" required placeholder="Nhập email của bạn" pattern="[a-zA-Z0-9._%+-]+@gmail\.com">
      <input type="password" name="pass" required placeholder="Nhập mật khẩu của bạn">
      <input type="submit" name="submit" value="Đăng nhập" class="form-btn">
      <p>Bạn chưa có tài khoản? <a href="register_form.php">Đăng ký ngay</a></p>
   </form>

</div>

</body>
</html>