<?php
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
// include "PHPMailer/src/OAuth.php";
// include "PHPMailer/src/POP3.php";
include "PHPMailer/src/SMTP.php";
include "../connectDB.php";
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true); 
$email = $_SESSION['register'][1];
$userName = $_SESSION['register'][0];
$code = $_SESSION['register'][2];
$passwords = $_SESSION['register'][3];
// print_r($_SESSION);
// print_r($mail);
if(isset($_POST['submit'])){
    $checkcode = $_POST['checkcode'];
    // echo $checkcode;
    // echo $code;
    if ($checkcode == $code){
        $insert = $conn->prepare("INSERT INTO `users` (phone, email, userName, passwords, avatar,gender,addressesList,isAdmin,status) VALUES ('',?, ?, ?, ?, '', '', 0, 'Hoạt động')");
        $insert->execute([$email, $userName, md5($passwords), 'man-user.png']);
        // $update = "UPDATE users SET status = 'Hoạt động' WHERE email = $email";
        // $result = mysqli_query($conn, $update);
        header('Location: ../login_form.php?success=1');
    }else {
        $registerMessage= "OTP không đúng";
    }
}else{
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'dotuanhiep231@gmail.com';                 // SMTP username
        $mail->Password = 'jggrawzwbwrjnujy';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('dotuanhiep231@gmail.com', 'Kumo');

        $mail->addAddress($email, $userName);     // Add a recipient
        $mail->addAddress('dotuanhiep231@gmail.com', 'Tuấn Hiệp');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        // //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mail->isHTML(true);   
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';   
        $mail->Subject = 'Xác nhận đăng ký tài khoản website Kumo';
        // $mail->Body    = 'Mã xác minh của bạn là: ' . $code;  
        $mail->Body = '<p style="font-family: Arial, sans-serif; font-size: 20px;">Mã xác minh của bạn là: <span style="color: red; font-size: 30px;">' . $code . '</span></p>';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        // echo 'Message has been sent';
        
    } catch (Exception $e) {
        // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
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
<link rel="stylesheet" href="../css/style.css">

</head>
<body>
<div class="form-container">
    <a href="home.php" class="dialog-close-btn-register-sendmail"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#888888" d="m12 12.708l-5.246 5.246q-.14.14-.344.15q-.204.01-.364-.15t-.16-.354q0-.194.16-.354L11.292 12L6.046 6.754q-.14-.14-.15-.344q-.01-.204.15-.364t.354-.16q.194 0 .354.16L12 11.292l5.246-5.246q.14-.14.344-.15q.204-.01.364.15t.16.354q0 .194-.16.354L12.708 12l5.246 5.246q.14.14.15.344q.01.204-.15.364t-.354.16q-.194 0-.354-.16L12 12.708Z"/></svg></a>

    <form action="" method="post" enctype="multipart/form-data">
        <h3>Xác minh tài khoản</h3>
        <!-- Hiển thị thông báo đăng ký -->
        <?php if(!empty($registerMessage)): ?>
            <div><?php echo $registerMessage; ?></div>
        <?php endif; ?>
        <p>Chúng tôi đã gửi mã xác nhận vào mail- <?php echo $email ?></p>
        <input type="text" name="checkcode" required placeholder="Nhập mã xác nhận">

        <input type="submit" name="submit" value="Đăng ký" class="form-btn">
        <p>Bạn đã có tài khoản? <a href="login_form.php">Đăng nhập ngay</a></p>
    </form>

</div>

</body>
</html>
