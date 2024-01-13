<?php

@include 'config.php';
include "connectDB.php";

session_start();

// $user_id = $_SESSION['user_id'];
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
   $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
}
// echo $user_id;

if(!isset($user_id)){
   header('location:login.php');
};
$isUpdate = false;
if(isset($_POST['update_profile'])){

   $name = $_POST['name'];

   $email = $_POST['email'];
   $gender = $_POST['gender'];
   $phone = $_POST['phone'];
   $address = $_POST['address'];
   

   // echo $a;
   // $update_profile = $conn->prepare("UPDATE `users` SET userName = ?, email = ?, phone = ?, addressesList = ?, gender = ? WHERE id = ?");
   // $update_profile->execute([$name, $email, $phone, $address, $gender, $user_id]);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'avatar_img/'.$image;
   $old_image = $_POST['old_image'];

   if(!empty($image)){

         $update_image = $conn->prepare("UPDATE `users` SET avatar = ? WHERE id = ?");
         $update_image->execute([$image, $user_id]);
         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/'.$old_image);
            $isUpdate = true;
         };
   };

   $db_pass = $_POST['db_pass'];
   $old_pass = isset($_POST['old_pass']) && !empty($_POST['old_pass']) ? md5($_POST['old_pass']) : $db_pass;
   $new_pass = isset($_POST['new_pass']) ? md5($_POST['new_pass']) : $db_pass;
   $confirm_pass = isset($_POST['confirm_pass']) ? md5($_POST['confirm_pass']) : $db_pass;

   // if(!empty($old_pass) && !empty($new_pass) AND !empty($confirm_pass)){
   if($db_pass != $old_pass){
      $message[] = 'Mật khẩu cũ không đúng!!!';
   }elseif($new_pass != $confirm_pass){
      $message[] = 'Mật khẩu xác nhận không đúng!';
   }else{
      $update_pass_query = $conn->prepare("UPDATE `users` SET userName = ?, email = ?, phone = ?, addressesList = ?, gender = ?, passwords = ? WHERE id = ?");
      $update_pass_query->execute([$name, $email, $phone, $address, $gender, $confirm_pass, $user_id]);
      if(!empty($image)){

         $update_image = $conn->prepare("UPDATE `users` SET avatar = ? WHERE id = ?");
         $update_image->execute([$image, $user_id]);
         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/'.$old_image);
            // $isUpdate = true;
         };
      };
      $isUpdate = true;
      // $message[] = 'password updated successfully!';
   }
}
if ($isUpdate) {
   $message[] = 'Cập nhật thành công!';
}

// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fashion Clothes Shopping</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="update-profile">
   <a href="home.php" class="option-btn"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="20" viewBox="0 0 24 24"><path fill="#888888" d="M10 22L0 12L10 2l1.775 1.775L3.55 12l8.225 8.225L10 22Z"/></svg></a>

   <h2 class="title">Cập nhật thông tin</h2>

   <form action="" method="POST" enctype="multipart/form-data">
      <img src="avatar_img/<?= $fetch_profile['avatar']; ?>" alt="">
      <?php

         if(isset($message)){
            foreach($message as $message){
               echo '
               <div class="message">
                  <span>'.$message.'</span>
               </div>
               ';
            }
         }

         ?>
      <div class="form-update">
         <div class="flex">
            <div class="inputBox">
               <div class="input">
                  <label for="name">Họ tên:</label>
                  <input type="text" name="name" value="<?= $fetch_profile['userName']; ?>" placeholder="Họ và Tên" required class="box">
               </div>
               <div class="input">
                  <label for="email">Email:</label>
                  <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" placeholder="Email" required class="box">
               </div>
               <div class="input">
                  <label for="phone">Số điện thoại:</label>
                  <input type="text" name="phone" value="<?= $fetch_profile['phone']; ?>" placeholder="09xxxxxxxx" required class="box" pattern="0[0-9]{8,}" minlength="9" maxlength="10">
               </div>
               <div class="input">
                  <label for="address">Địa chỉ:</label>
                  <input type="text" name="address" value="<?= $fetch_profile['addressesList']; ?>" placeholder="Địa chỉ" required class="box">
               </div>
               
            </div>
            <div class="inputBox">
               
               <div class="input">
                  <label for="image">Ảnh đại diện:</label>
                  <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" style="border: none; padding: 0.5rem 0.1rem;">
               </div>
               <input type="hidden" name="old_image" value="<?= $fetch_profile['avatar']; ?>">

               
               <div class="input">
                  <label for="old_pass">Mật khẩu cũ:</label>
                  <input type="password" name="old_pass" placeholder="mật khẩu cũ" class="box">
                  <input type="hidden" name="db_pass" value="<?= $fetch_profile['passwords']; ?>">
               </div>
               <div class="input">
                  <label for="new_pass">Mật khẩu mới:</label>
                  <input type="password" name="new_pass" placeholder="mật khẩu mới" class="box">
               </div>
               <div class="input">
                  <label for="confirm_pass">Xác nhận mật khẩu:</label>
                  <input type="password" name="confirm_pass" placeholder="Xác nhận mật khẩu mới" class="box">
               </div>
               
            </div>
         </div>
         <div class="input-gender">
            <!-- <label for="confirm_pass">Giới tính:</label>
            <input type="password" name="confirm_pass" placeholder="nam/nu" required class="box"> -->
            <p>Giới tính:</p>
            <div class="gender">
               <div class="gender-radio">
                  <input type="radio" id="gender1" name="gender" value="Nam" <?php echo ($fetch_profile['gender'] == 'Nam') ? 'checked' : ''; ?> >
                  <label for="gender1">Nam</label>
               </div>
               <div class="gender-radio">
                  <input type="radio" id="gender2" name="gender" value="Nữ" <?php echo ($fetch_profile['gender'] == 'Nữ') ? 'checked' : ''; ?> >
                  <label for="gender2">Nữ</label> 
               </div>
               <div class="gender-radio">
                  <input type="radio" id="gender3" name="gender" value="Khác" <?php echo ($fetch_profile['gender'] == 'Khác') ? 'checked' : ''; ?>>
                  <label for="gender3">Khác</label><br>
               </div>
            </div>
         </div>
      </div>
      
      <div class="flex-btn">
         <input type="submit" class="btn btn-update" value="Cập nhập thông tin" name="update_profile">
      </div>
   </form>

</section>
<?php include 'footer.php'; ?>

</body>
</html>