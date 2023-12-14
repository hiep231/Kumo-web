<?php
require_once 'connectDB.php';
session_start();
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
    $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
}
$nth = 4;
$content = "Thêm mới";
include 'admin_leftside.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Clothes Shopping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Titillium Web' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        * {
            margin:0;
            padding: 0;
            font-family: "Roboto","Helvetica Neue",Arial,sans-serif;
        }
        .rightside {
            position: absolute;
            right: 0;
            top: 0;
            width: 84%;
            height: 100%;
            transition: all 1s ease;
        }
        .rightside_max {
            position: absolute;
            right: 0;
            top: 0;
            width: 94.7%;
            height: 100%;
            transition: all 1s ease;
        }

        .content {
            position: relative;
        }

        .rightside .content h2 {
            /* margin-left: 40%; */
            position: relative;
            left: 40%;
            margin-top: 89px;
            width: 28%;
            background: linear-gradient(to right, #324131 , #739072);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            transition: all 1s ease; /* Chỉ áp dụng transition cho background */
        }

        .rightside_max .content h2 {
            position: relative;
            left: 40%;
            margin-top: 89px;
            width: 24%; /* Giữ nguyên giá trị width */
            background: linear-gradient(to right, #324131 , #739072);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            transition: all 1s ease; /* Chỉ áp dụng transition cho background */
        }
        .form_add {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(2, 44%);
            gap: 2rem 4rem;
            font-size: 6rem;
            transition: all 1s ease;
        }
        .rightside_max .form_add {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(2, 44%);
            font-size: 6rem;
            gap: 2rem 10rem;
            transition: all 1s ease;
        }
        .input {
            align-items: center;
            font-size: 1.1rem;
            margin-bottom: 10px;
            display: flex;
        }

        .input label {
            width: 200px;
            text-align: end;
            margin-left: 8px;
            size: 2rem;
        }

        .input input,
        select {
            margin-left: 2px;
            width: 350px;
            flex-direction: column;
        }

        .content button {
            font-size: 1rem;
            position: relative;
            top: 3rem;
            left: 45%;
            margin-left: 10px;
            color: #ffffff;
            padding: 3px 7px 3px 5px;
            border-radius: 8px;
        }
        .content svg {
            position: relative;
            bottom: 2px;
        }
        .price {
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 350px;
            border: 1px;
            border-style: solid;
            border-color: rgb(158, 157, 157), rgb(154, 152, 152);
        }
        .rightside_max #price {
            width: 297px; 
            margin-right: 2px;
        }
        
    </style>
</head>

<body>
    <div class="rightside">
        <div class="content">
            <h2>Thêm mới sản phẩm</h2>
            <form  method="post" enctype="multipart/form-data">
                <div class="form_add">
                    <div class="input g-col-6">
                        <label for="categorys">Loại sản phẩm:</label>
                        <select name="categorys" id="categorys" autofocus required>
                            <option value="">--Hãy chọn một loại sản phẩm--</option>
                            <option value="Quần">Quần</option>
                            <option value="Sơ mi">Sơ mi</option>
                            <option value="Áo polo">Áo polo</option>
                            <option value="Áo phông">Áo phông</option>
                        </select>
                    </div>
                    <div class="input g-col-6">
                        <label for="img1">Link ảnh 1:</label>
                        <input type="file" name="img1" accept="image/png, image/gif, image/jpeg" required>
                    </div>
                    <div class="input g-col-6">
                        <label for="brands">Hãng sản phẩm:</label>
                        <select name="brands" id="brands" required>
                            <option value="">--Hãy chọn một hãng sản phẩm--</option>
                            <option value="Teelab">Teelab</option>
                            <option value="Swevn">Swevn</option>
                            <option value="Roway">Roway</option>
                            <option value="Levents">Levents</option>
                        </select>
                    </div>
                    <div class="input g-col-6">
                        <label for="img2">Link ảnh 2:</label>
                        <input type="file" name="img2" accept="image/png, image/gif, image/jpeg" required>
                    </div>
                    <div class="input g-col-6">
                        <label for="nameproduct">Tên sản phẩm:</label>
                        <input type="text" name="nameproduct" required>
                    </div>
                    <div class="input g-col-6">
                        <label for="xuatxu">Xuất xứ:</label>
                        <select name="xuatxu" id="xuatxu" required>
                            <option value="">--Hãy chọn nơi xuất xứ--</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="ThaiLan">ThaiLan</option>
                            <option value="USA">USA</option>
                            <option value="Korea">Korea</option>
                        </select>
                    </div>
                    <div class="input g-col-6">
                        <label for="specproduct">Tên đặc biệt:</label>
                        <input type="text" name="specproduct" required>
                    </div>    
                    <div class="input g-col-6">
                        <label for="material">Chất liệu:</label>
                        <select name="material" id="material" required>
                        <option value="">--Hãy chọn chất liệu sản phẩm--</option>
                        <option value="Kaki">Kaki</option>
                        <option value="jean">jean</option>
                        <option value="cargo">cargo</option>
                        <option value="len">Len</option>
                        <option value="Cotton">Cotton</option>
                        <option value="Nhung tăm">Nhung tăm</option>
                        <option value="Lụa">Lụa</option>
                        <option value="Polyester">Polyester</option>
                        <option value="Bông">Bông</option>
                        </select>
                    </div>
                    <div class="input g-col-6" style="display: flex; align-items: center;">
                        <label for="price" style="width: 200px; text-align: end; margin-right: -1px;">Giá sản phẩm:</label>
                        <input type="text" name="price" id="price" required style="width: 306px; margin-right: 2px;">
                        <div style="margin-left: 7px;">VND</div>
                    </div>
                    <div class="input g-col-6">
                        <label for="lengthh">Chiều dài:</label>
                        <select name="lengthh" id="lengthh" required>
                            <option value="">--Hãy chọn độ dài sản phẩm--</option>
                            <option value="Tay dài">Tay dài</option>
                            <option value="Tay ngắn">Tay ngắn</option>
                            <option value="Quần dài">Quần dài</option>
                            <option value="Quần ngắn">Quần ngắn</option>
                        </select>
                    </div>
                    <div class="input g-col-6">
                        <label for="promotion">Mã giảm giá:</label>
                        <select name="promotion" required> 
                            <?php
                            $queryPromotion = "SELECT * FROM promotion";
                            $result = mysqli_query($conn, $queryPromotion);
                            while ($r = mysqli_fetch_array($result)) {
                                echo '<option value="' . $r['id'] . '">' . $r['code'] . " - " . number_format($r['price'],0,",",".") . " VND" . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input g-col-6">
                        <label for="color">Màu sắc:</label>
                        <select name="color" id="color" required>
                        <option value="">--Chọn màu sắc--</option>
                        <option value="Đỏ">Đỏ</option>
                        <option value="Xanh dương">Xanh dương</option>
                        <option value="Xanh lá cây">Xanh lá cây</option>
                        <option value="Vàng">Vàng</option>
                        <option value="Tím">Tím</option>
                        <option value="Hồng">Hồng</option>
                        <option value="Cam">Cam</option>
                        <option value="Nâu">Nâu</option>
                        <option value="Xám">Xám</option>
                        <option value="Đen">Đen</option>
                        <option value="Trắng">Trắng</option>
                        <option value="Hồng nhạt">Hồng nhạt</option>
                        <option value="Xanh rêu">Xanh rêu</option>
                        <option value="Kem">Kem</option>
                        <option value="Nâu đất">Nâu đất</option>
                        <option value="Lục bảo">Lục bảo</option>
                        <option value="Nâu caramen">Nâu caramen</option>
                        <option value="Lavender">Lavender</option>
                        <option value="Xanh cobalt">Xanh cobalt</option>
                        <option value="Vàng nhạt">Vàng nhạt</option>
                        <option value="Hồng đậm">Hồng đậm</option>
                        </select>      
                    </div>
                </div>
                <button class="submit btn btn-primary" type="submit" name="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M4 3h14l2.707 2.707a1 1 0 0 1 .293.707V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm3 1v5h9V4H7Zm-1 8v7h12v-7H6Zm7-7h2v3h-2V5Z"/></svg>Lưu</button>
                <button class="cancel btn btn-secondary" type="reset"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z"/></svg>Hủy</button>
            </form>
        </div>
    </div>
    <script src="change.js"></script>
    <script>
        const select_category = document.getElementById('categorys');
        const select_meterial = document.getElementById('material');
        const select_length = document.getElementById('lengthh');
        // Ẩn select_meterial ban đầu
        select_meterial.style.display = 'inline';

        select_category.addEventListener('change', function() {
            if (select_category.value === 'Quần') {
                // Nếu người dùng chọn "Quần", hiển thị các tùy chọn áo và ẩn các tùy chọn quần
                select_meterial.style.display = 'inline';
                select_length.style.display = 'inline';

                // Đặt các tùy chọn quần thành ẩn
                Array.from(select_meterial.options).forEach(option => {
                    if (option.value === 'Kaki' || option.value === 'jean' || option.value === 'Len' || option.value === 'cargo') {
                        option.style.display = 'inline';
                    } else {
                        option.style.display = 'none';
                    }
                });
                Array.from(select_length.options).forEach(option => {
                    if (option.value === 'Quần dài' || option.value === 'Quần ngắn') {
                        option.style.display = 'inline';
                    } else {
                        option.style.display = 'none';
                    }
                });
            } else if (select_category.value === 'Sơ mi') {
                // Nếu người dùng chọn "Sơ mi", hiển thị các tùy chọn quần và ẩn các tùy chọn áo sơ mi
                select_meterial.style.display = 'inline';
                // Đặt các tùy chọn áo sơ mi thành ẩn
                Array.from(select_meterial.options).forEach(option => {
                    if (option.value === 'Cotton' || option.value === 'Nhung tăm'|| option.value === 'Lụa') {
                        option.style.display = 'inline';
                    } else {
                        option.style.display = 'none';
                    }
                });
                Array.from(select_length.options).forEach(option => {
                    if (option.value === 'Tay dài' || option.value === 'Tay ngắn') {
                        option.style.display = 'inline';
                    } else {
                        option.style.display = 'none';
                    }
                });
            } else if (select_category.value === 'Áo polo') {
                // Nếu người dùng chọn "Áo polo", hiển thị các tùy chọn quần và ẩn các tùy chọn áo polo
                select_meterial.style.display = 'inline';
                // Đặt các tùy chọn áo polo thành ẩn
                Array.from(select_meterial.options).forEach(option => {
                    if (option.value === 'Polyester' || option.value === 'Cotton') {
                        option.style.display = 'inline';
                    } else {
                        option.style.display = 'none';
                    }
                });
                Array.from(select_length.options).forEach(option => {
                    if (option.value === 'Tay dài' || option.value === 'Tay ngắn') {
                        option.style.display = 'inline';
                    } else {
                        option.style.display = 'none';
                    }
                });
            } else if (select_category.value === 'Áo phông') {
                // Nếu người dùng chọn "Áo phông", hiển thị các tùy chọn quần và ẩn các tùy chọn áo phông
                select_meterial.style.display = 'inline';
                // Đặt các tùy chọn áo phông thành ẩn
                Array.from(select_meterial.options).forEach(option => {
                    if (option.value === 'Bông' || option.value === 'Lụa' || option.value === 'Cotton') {
                        option.style.display = 'inline';
                    } else {
                        option.style.display = 'none';
                    }
                });
                Array.from(select_length.options).forEach(option => {
                    if (option.value === 'Tay dài' || option.value === 'Tay ngắn') {
                        option.style.display = 'inline';
                    } else {
                        option.style.display = 'none';
                    }
                });
            } else {
                select_meterial.style.display = 'none';
            }
        });
    </script>
</body>
</html>
<?php
require_once 'connectDB.php';

$isTrue = true;
$isExits = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['price'])) {
        $price = intval($_POST['price']);
        if ($price <= 0 || !is_numeric($_POST['price'])) {
            echo "<div class='error'>Giá phải lớn hơn 0</div>";
            $isTrue = false;
        }
    }
    $brand = $_POST['brands'];
    $nameproduct = $_POST['nameproduct'];
    $specproduct = $_POST['specproduct'];

    $promotion = $_POST['promotion'];
    $category = $_POST['categorys'];
    $xuatxu = $_POST['xuatxu'];
    $material = $_POST['material'];
    $lengthh = $_POST['lengthh'];
    $color = $_POST['color'];
    $desc = $_POST['xuatxu']. ", " . $_POST['material']. ", " . $_POST['lengthh']. ", " . $_POST['color'];
    if (isset($_FILES['img1']) && $_FILES['img1']['error'] == UPLOAD_ERR_OK) {
        $fileImg1 = $_FILES['img1']['name'];
        $tempImg1 = $_FILES['img1']['tmp_name'];
    }

    if (!empty($fileImg1)) {
        $location = "C:/xampp/htdocs/Kumo/hinh_sp/";
        if (!move_uploaded_file($tempImg1, $location . $fileImg1)) {
            echo "<div class='error'>Upload không thành công</div>";
            $isTrue = false;
        }
    }

    if (isset($_FILES['img2']) && $_FILES['img2']['error'] == UPLOAD_ERR_OK) {
        $fileImg2 = $_FILES['img2']['name'];
        $tempImg2 = $_FILES['img2']['tmp_name'];
    }

    if (!empty($fileImg2)) {
        $location = "C:/xampp/htdocs/Kumo/hinh_sp/";
        if (!move_uploaded_file($tempImg2, $location . $fileImg2)) {
            echo "<div class='error'>Upload không thành công</div>";
            $isTrue = false;
        }
    }

    // if (isset($fileImg1, $fileImg2)) {
        $images = "hinh_sp/" . $_FILES['img1']['name'] . "," . "hinh_sp/" . $_FILES['img2']['name'];


    // if ($isTrue) {
    $sql = "INSERT INTO product(`point`, `images`, `ratingStar`, `salePromotion`, `category`, `specName`, `name`, `describes`, `price`, `brand`) VALUES (5, '$images', 5, '$promotion', '$category', '$specproduct', '$nameproduct', '$desc', '$price', '$brand')";

    $all = "SELECT * FROM product";
    $result = mysqli_query($conn, $all);
    while ($r = mysqli_fetch_array($result)) {
        if ($r['point'] == 0 && $r['images'] == $images && $r['ratingStat'] == 0 && $r['salePromotion'] == $promotion && $r['category'] == $category && $r['specName'] == $specproduct && $r['name'] == $nameproduct && $r['describes'] == $desc && $r['price'] == $price){
            $isExits = true;
        };
    }
    if ($isTrue) {
        if ($isExits == true) {
            echo "<script>alert('Dữ liệu đã có tồn tại.');</script>";
        }else{
            mysqli_query($conn, $sql);
            echo "<script>alert('Thêm dữ liệu thành công.');</script>";
        }
        echo "<script>location.href = 'admin_add_product.php';</script>";

    } else {
        echo "<script>alert('Thêm dữ liệu không thành công.');</script>";
        echo "<script>location.href = 'admin_add_product.php';</script>";
        echo error_get_last_error();
    }
}?>

