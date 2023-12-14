<?php

include "connectDB.php";
session_start();
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
   $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
}

if(isset($_POST['submit'])){
   
   $email = $_POST['email'];
   // $email = filter_var($email, FILTER_SANITIZE_STRING);
   
   $userName = $_POST['name'];
   // $userName = filter_var($userName, FILTER_SANITIZE_STRING);
   
   $passwords = md5($_POST['pass']);
   // $passwords = filter_var($passwords, FILTER_SANITIZE_STRING);

   $cpasswords = md5($_POST['cpass']);
   // $cpasswords = filter_var($cpasswords, FILTER_SANITIZE_STRING);

   if ($_POST['user_type'] == 'admin'){
      $isAdmin = true;
      $isUser = false;
   }else {
      $isAdmin = false;
      $isUser = true;
   }
   
   $avatar = $_FILES['image']['name'];
   // $avatar = filter_var($avatar, FILTER_SANITIZE_STRING);
   $avatar_size = $_FILES['image']['size'];
   $avatar_tmp_name = $_FILES['image']['tmp_name'];
   $avatar_folder = '../avatar_img/'.$avatar ;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   // Fetch the result before checking the number of rows
   $result = $select->fetch();

   if($result){
      $registerMessage[] = 'Email này đã tạo tài khoản trước đó!';
   }else{
      if($passwords != $cpasswords){
         $registerMessage[] = 'Mật khẩu xác nhận không đúng';
      }else{
         $insert = $conn->prepare("INSERT INTO `users` (email, userName, passwords, avatar,isAdmin,isUser,gender,addressesList,phone) VALUES (?, ?, ?, ?, ?, ?, '', '', '')");
         $insert->execute([$email, $userName, $passwords, $avatar, $isAdmin, $isUser]);
         $registerMessage[] = 'Đăng ký thành công';
         if($insert){
            if($avatar_size > 2000000){
               $registerMessage[] = 'Kích thước ảnh quá lớn!';
            }else{
               move_uploaded_file($avatar_tmp_name, $avatar_folder);
               // $registerMessage[] = 'registered successfully!';
               // header('location:login_form.php');
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
   <title>register form admin</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
   <div class="form-container">
      <a href="listed_account.php" class="dialog-close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#888888" d="m12 12.708l-5.246 5.246q-.14.14-.344.15q-.204.01-.364-.15t-.16-.354q0-.194.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344q-.01-.204.15-.364t.354-.16q.194 0 .354.16L12 11.292l5.246-5.246q.14-.14.344-.15q.204-.01.364.15t.16.354q0 .194-.16.354L12.708 12l5.246 5.246q.14.14.15.344q.01.204-.15.364t-.354.16q-.194 0-.354-.16L12 12.708Z"/></svg></a>

      <form action="" method="post" enctype="multipart/form-data">
         <h3>Đăng ký</h3>
         <?php
            if(isset($registerMessage)){
               foreach($registerMessage as $message){
                  echo '
                  <div class="message">
                     <span>'.$message.'</span>
                  </div>
                  ';
               }
            }
         ?>
         <input type="text" name="name" required placeholder="Nhập tên">
         <input type="email" name="email" required placeholder="Nhập email">
         <input type="password" name="pass" required placeholder="Nhập mật khẩu">
         <input type="password" name="cpass" required placeholder="Nhập lại mật khẩu">
         <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
         <select name="user_type">
            <option value="user">user</option>
            <option value="admin">admin</option>
         </select>
         <input type="submit" name="submit" value="Đăng ký" class="form-btn">
         <p>Bạn đã có tài khoản? <a href="../login_form.php">Đăng nhập ngay</a></p>
      </form>

   </div>

</body>
</html>