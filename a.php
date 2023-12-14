<?php

include "connectDB.php";

session_start();

$registerMessage = '';

if(isset($_POST['submit'])){
   
   $email = $_POST['email'];
   // $email = filter_var($email, FILTER_SANITIZE_STRING);
   
   $userName = $_POST['name'];
   // $userName = filter_var($userName, FILTER_SANITIZE_STRING);
   
   $passwords = $_POST['pass'];
   // $passwords = filter_var($passwords, FILTER_SANITIZE_STRING);

   $cpasswords = $_POST['cpass'];
   // $cpasswords = filter_var($cpasswords, FILTER_SANITIZE_STRING);

   // Kiểm tra mật khẩu theo yêu cầu
   $passwordPattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{5,}$/';

   
   if (!preg_match($passwordPattern, $passwords)) {
      $registerMessage = 'Mật khẩu phải có ít nhất 5 kí tự, bao gồm ít nhất một chữ hoa, một chữ thường, một số và một kí tự đặc biệt.';
   } else {
      $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
      $select->execute([$email]);

      // Fetch the result before checking the number of rows
      $result = $select->fetch();

      if($result){
         $registerMessage= 'Email này đã tạo tài khoản trước đó!';
      } else {
         if($passwords != $cpasswords){
            $registerMessage= 'Mật khẩu xác nhận không đúng';
         } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Kiểm tra xem email có kết thúc bằng "@gmail.com" không
                if (endsWith($email, "@gmail.com")) {
                    // echo "Địa chỉ email hợp lệ!";
                    $insert = $conn->prepare("INSERT INTO `users` (phone, email, userName, passwords, avatar,gender,addressesList,isAdmin,isUser) VALUES ('',?, ?, ?, ?, '', '', 0, 1)");
                    $insert->execute([$email, $userName, md5($passwords), 'man-user.png']);
                    
                    // Đặt thông báo vào session
                    $_SESSION['registerMessage'] = 'Tài khoản đã đăng ký thành công!';
                    
                    // Chuyển hướng đến trang đăng nhập
                    header('Location: login_form.php?success=1');
                    exit();
                } else {
                    echo "Địa chỉ email không kết thúc bằng @gmail.com!";
                }
            } else {
                echo "Địa chỉ email không hợp lệ!";
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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   <div class="form-container">
      <a href="home.php" class="dialog-close-btn-register"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#888888" d="m12 12.708l-5.246 5.246q-.14.14-.344.15q-.204.01-.364-.15t-.16-.354q0-.194.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344q-.01-.204.15-.364t.354-.16q.194 0 .354.16L12 11.292l5.246-5.246q.14-.14.344-.15q.204-.01.364.15t.16.354q0 .194-.16.354L12.708 12l5.246 5.246q.14.14.15.344q.01.204-.15.364t-.354.16q-.194 0-.354-.16L12 12.708Z"/></svg></a>

      <form action="" method="post" enctype="multipart/form-data">
         <h3>Đăng ký</h3>
         <!-- Hiển thị thông báo đăng ký -->
         <?php if(!empty($registerMessage)): ?>
            <div><?php echo $registerMessage; ?></div>
         <?php endif; ?>
         <input type="text" name="name" required placeholder="Nhập tên">
         <input type="text" name="email" required placeholder="Nhập email" pattern="[a-zA-Z0-9._%+-]+@gmail\.com">
         <input type="password" name="pass" required placeholder="Nhập mật khẩu">
         <input type="password" name="cpass" required placeholder="Nhập lại mật khẩu">
         <input type="submit" name="submit" value="Đăng ký" class="form-btn">
         <p>Bạn đã có tài khoản? <a href="login_form.php">Đăng nhập ngay</a></p>
      </form>

   </div>

</body>
</html>

