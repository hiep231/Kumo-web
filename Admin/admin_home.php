<?php
    session_start();
    $nth = 1;
    $content = "Home";
    include 'admin_leftside.php';
    date_default_timezone_set("Asia/Ho_Chi_Minh");
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
    <style>
        /* .left-side {
            height: 46.3rem;
        } */
        .rightside {
            position: absolute;
            right: 0;
            top: 3.5%;
            width: 84%;
            height: 96%;
            transition: all 1s ease;
            background-color:#739072;
            z-index: 100;
        }
        .rightside_max {
            position: absolute;
            right: 0;
            top: 3.5%;
            width: 93.65%;
            height: 95.9%;
            transition: all 1s ease;
            background-color:#739072;
            z-index: 100;
        }
        .content{
            height: 99.37%;

        }
        .rightside_max .content{
            height: 100%;
        }
        
        .home-video {
            /* width: 100%; */
            filter: contrast(100%);
            overflow: hidden;
            opacity: 0.5;
            object-fit: contain;
            width: 100%;
            height: 100%;
        }
        .content .welcome {
            position: relative;
            top:0;
            text-align: center;
            color: white;
            margin-top: -37rem;
            font-family: "Roboto","Helvetica Neue",Arial,sans-serif;
        }
        .content .welcome p {
            font-size: 35px;
            padding-bottom: 1rem;
        }
        .content .welcome h1 {
            /* font-size: 5rem; */
            padding: 1rem 0 0.5rem 0;
            font-weight: bold;
        }
        .content .welcome h2,h5 {
            margin-top: 2rem;
            font-weight: 300;
            font-size: 36px;
        }
        .content .welcome h5 {
            font-size: 18px;
            font-weight: 400;
        }
        .left-side-short {
            position: relative;
            background-color: #343A3F;
            width: 7%;
            height: 100vh;
            right: 10px;
            top: 0px;
            transition: all 1s ease;
        }
    </style>
</head>
<body>
    <div class="rightside">
        <div class="content">
            <video class="home-video" src="home-video.mp4" type="video/mp4" autoplay loop muted></video>
            <div class="welcome">
                <p>ADMIN</p>
                <p>Kumo</p>
                <h1>XIN CHÀO</h1>
                <h2>CHÚC BẠN MỘT NGÀY LÀM VIỆC TỐT LÀNH.</h2>
                <h5><span id="current-time"><?php echo date("h:i:s") ?></span> - HCM, Ngày <?php echo date("d") ?> Tháng <?php echo date("m") ?> Năm <?php echo date("Y") ?> </h5>
            </div>
        </div>
    </div>
    <script>

        function updateTime() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById("current-time").textContent = timeString; // Corrected ID here
        }

        // Call updateTime function on page load to display the current time
        updateTime();

        // Update the time every second
        setInterval(updateTime, 1000);


    </script>
    <script src="change.js"></script>
</body>
</html>