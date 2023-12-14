<?php
$id = $_GET['sid'];
session_start();
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
    $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
}


require_once 'connectDB.php';

$id = $_GET['sid'];
$edit_sql = "SELECT * FROM product WHERE id='$id'";

$result = mysqli_query($conn,$edit_sql);
$row = mysqli_fetch_array($result);
$mangAnh = explode(",",$row['images']);
$path1 = explode("/",$mangAnh[0]);
$path2 = explode("/",$mangAnh[1]);
$img1 = $path1[1];
$img2 = $path2[1];
$backpage = ($row['category'] == "Quần") ? 'listed_quan.php' : 'listed_ao.php';

// echo $img1;

$isTrue = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['price'])) {
        $price = intval($_POST['price']);
        if ($price < 0) {
            // echo "<script>alert('Giá phải lớn hơn hoặc bằng 0');</script>";
            $message[] = "Giá phải lớn hơn hoặc bằng 0";
            $isTrue = false;
        }
    }
    $promotion = intval($_POST['promotion']);
    $id = $_POST['sid'];
    $brand = $_POST['brands'];
    $nameproduct = $_POST['nameproduct'];
    $specproduct = $_POST['specproduct'];
    $category = $_POST['categorys'];
    $xuatxu = $_POST['xuatxu'];
    $material = $_POST['material'];
    $lengthh = $_POST['lengthh'];
    $color = $_POST['color'];
    $desc = $_POST['xuatxu']. ", " . $_POST['material']. ", " . $_POST['lengthh']. ", " . $_POST['color'];
    $location = "hinh_sp/";

    if (isset($_FILES['img1']) && $_FILES['img1']['error'] == UPLOAD_ERR_OK) {
        $fileImg1 = $_FILES['img1']['name'];
        $tempImg1 = $_FILES['img1']['tmp_name'];
        move_uploaded_file($tempImg1, $location . $fileImg1); 
    }else {
        $fileImg1 = $img1;
    }

    

    if (isset($_FILES['img2']) && $_FILES['img2']['error'] == UPLOAD_ERR_OK) {
        $fileImg2 = $_FILES['img2']['name'];
        $tempImg2 = $_FILES['img2']['tmp_name'];
        move_uploaded_file($tempImg2, $location . $fileImg2);
    }else {
        $fileImg2 = $img2;
    }


    // if (isset($fileImg1, $fileImg2)) {
        $images = "hinh_sp/" . $fileImg1 . "," . "hinh_sp/" . $fileImg2;


    // if ($isTrue) {
    $sql = "UPDATE product SET point = 0,images = '$images',salePromotion = '$promotion',category = '$category',specName = '$specproduct',name = '$nameproduct',describes = '$desc',price = '$price', brand = '$brand' WHERE id = $id";

    $all = "SELECT * FROM product";
    $result = mysqli_query($conn, $all);
    
    if ($isTrue) {
        mysqli_query($conn, $sql);
        echo "<script>alert('Cập nhật dữ liệu thành công');</script>";
        
        header('Location: ' . $backpage);
        exit();

    }
}

$edit_sql = "SELECT * FROM product WHERE id=$id";
$result = mysqli_query($conn,$edit_sql);
$row = mysqli_fetch_array($result);
$describes = explode(", ",$row['describes']);
$xuatxu = $describes[0];
$material = $describes[1];
$lengthh = $describes[2];
$color = $describes[3];
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
        .content {
            position: absolute;
            right: 0px;
            top: 0;
            width: 100%;
            height: 100vh;
            background-color: linear
        }
        @media only screen and (min-width: 1800px) and (min-height: 800px) {
            .form {
                margin-left: 14.5rem !important;
            }
        }
        .content .back {
            font-size: 1rem;
            position: relative;
            left: 2%;
            top: -5%;
            margin-left: 10px;
            color: black;
            background-color: white;
            border: none;
            padding: 2px 5px;
        }
        .content h2{
            text-align: center;
            margin-top: 5rem;
        }
        .form {
            margin-top: 3rem;
            margin-left: 2.5rem;
            display: grid;
            grid-template-columns: repeat(2, 36rem);
            gap: 2rem 10rem;
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
        }
        .input input,select {
            margin-left:2px;
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
            background-color: #465692;
            border: 0.5px solid #272626;
            padding: 2px 5px;
        }
        .content .cancel{
            color: #000000;
            background-color: #ffffff;
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
        .alert-danger {
            width: 27%;
            justify-content: center;
        }
        .content .back svg {
            width: 17px;
            height: 17px;
        }
        .message {
            text-align: center;
        }
        
    </style>
</head>

<body>
    <div class="content">
        <h2>Cập nhật sản phẩm</h2>
        <?php
        // echo $passwords;
        // echo $_SESSION['user_id'];
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
        <a href="<?php echo $backpage; ?>" class="back"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M16 22L6 12L16 2l1.775 1.775L9.55 12l8.225 8.225L16 22Z"/></svg>Back</a>
        <form  method="post" enctype="multipart/form-data">
            <input type="hidden" name="sid" value="<?php echo $id;?>" id="">
            <div class="form">
                <div class="input g-col-6">
                    <label for="categorys">Loại sản phẩm:</label>
                    <select name="categorys" id="categorys" autofocus required>
                        <option value="">--Hãy chọn một loại sản phẩm--</option>
                        <option value="Quần" <?php if ($row['category'] === 'Quần') echo 'selected'; ?>>Quần</option>
                        <option value="Sơ mi" <?php if ($row['category'] === 'Sơ mi') echo 'selected'; ?>>Sơ mi</option>
                        <option value="Áo polo" <?php if ($row['category'] === 'Áo polo') echo 'selected'; ?>>Áo polo</option>
                        <option value="Áo phông" <?php if ($row['category'] === 'Áo phông') echo 'selected'; ?>>Áo phông</option>
                    </select>
                </div>
                <div class="input g-col-6">
                    <label for="img1">Link ảnh 1:</label>
                    <input type="file" name="img1" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="input g-col-6">
                    <label for="brands">Hãng sản phẩm:</label>
                    <select name="brands" id="brands" required>
                        <option value="">--Hãy chọn một hãng sản phẩm--</option>
                        <option value="Teelab" <?php if ($row['brand'] === 'Teelab') echo 'selected'; ?>>Teelab</option>
                        <option value="Swevn" <?php if ($row['brand'] === 'Swevn') echo 'selected'; ?>>Swevn</option>
                        <option value="Roway" <?php if ($row['brand'] === 'Roway') echo 'selected'; ?>>Roway</option>
                        <option value="Levents" <?php if ($row['brand'] === 'Levents') echo 'selected'; ?>>Levents</option>
                    </select>
                </div>
                <div class="input g-col-6">
                    <label for="img2">Link ảnh 2:</label>
                    <input type="file" name="img2" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="input g-col-6">
                    <label for="nameproduct">Tên sản phẩm:</label>
                    <input type="text" name="nameproduct" required value="<?php echo $row['name'] ?>">
                </div>
                <div class="input g-col-6">
                    <label for="xuatxu">Xuất xứ:</label>
                    <select name="xuatxu" id="xuatxu" required>
                        <option value="">--Hãy chọn nơi xuất xứ--</option>
                        <option value="Vietnam" <?php if ($xuatxu === 'Vietnam') echo 'selected'; ?>>Vietnam</option>
                        <option value="ThaiLan" <?php if ($xuatxu === 'ThaiLan') echo 'selected'; ?>>ThaiLan</option>
                        <option value="USA" <?php if ($xuatxu === 'USA') echo 'selected'; ?>>USA</option>
                        <option value="Korea" <?php if ($xuatxu === 'Korea') echo 'selected'; ?>>Korea</option>
                    </select>
                </div>
                <div class="input g-col-6">
                    <label for="specproduct">Tên đặc biệt:</label>
                    <input type="text" name="specproduct" required value="<?php echo $row['specName'] ?>">
                </div>    
                <div class="input g-col-6">
                    <label for="material">Chất liệu:</label>
                    <select name="material" id="material" required>
                    <option value="">--Hãy chọn chất liệu sản phẩm--</option>
                    <option value="Kaki" <?php if ($material === 'Kaki') echo 'selected'; ?>>Kaki</option>
                    <option value="jean" <?php if ($material === 'jean') echo 'selected'; ?>>jean</option>
                    <option value="len" <?php if ($material === 'len') echo 'selected'; ?>>Len</option>
                    <option value="Cotton" <?php if ($material === 'Cotton') echo 'selected'; ?>>Cotton</option>
                    <option value="Nhung tăm" <?php if ($material === 'Nhung tăm') echo 'selected'; ?>>Nhung tăm</option>
                    <option value="Lụa" <?php if ($material === 'Lụa') echo 'selected'; ?>>Lụa</option>
                    <option value="Polyester" <?php if ($material === 'Polyester') echo 'selected'; ?>>Polyester</option>
                    <option value="Bông" <?php if ($material === 'Bông') echo 'selected'; ?>>Bông</option>
                    </select>
                </div>
                <div class="input g-col-6" style="display: flex; justify-content: center; align-items: center;margin-left: 28px;">
                    <div style="display: flex; flex-direction: row; width: 88%;">
                    <label for="price">Giá sản phẩm:</label>
                    <input type="text" name="price" required value="<?php echo $row['price'] ?>">
                    </div>
                    <div style="width: 12%;margin-left: 7px;">VND</div>
                </div>
                <div class="input g-col-6">
                    <label for="lengthh">Chiều dài:</label>
                    <select name="lengthh" id="lengthh" required>
                        <option value="">--Hãy chọn độ dài sản phẩm--</option>
                        <option value="Tay dài" <?php if ($lengthh === 'Tay dài') echo 'selected'; ?>>Tay dài</option>
                        <option value="Tay ngắn" <?php if ($lengthh === 'Tay ngắn') echo 'selected'; ?>>Tay ngắn</option>
                        <option value="Quần dài" <?php if ($lengthh === 'Quần dài') echo 'selected'; ?>>Quần dài</option>
                        <option value="Quần ngắn" <?php if ($lengthh === 'Quần ngắn') echo 'selected'; ?>>Quần ngắn</option>
                    </select>
                </div>
                <div class="input g-col-6">
                    <label for="promotion">Mã giảm giá:</label>
                    <select name="promotion" required value="<?php echo $row['promotion'] ?>"> 
                        <?php
                        $queryPromotion = "SELECT * FROM promotion";
                        $result = mysqli_query($conn, $queryPromotion);
                        while ($r = mysqli_fetch_array($result)) {
                            echo '<option value="' . $r['id'] . '">' . $r['code'] . " - " . $r['price'] . "VND" . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="input g-col-6">
                    <label for="color">Màu sắc:</label>
                    <select name="color" id="color" required>
                        <option value="">--Chọn màu sắc--</option>
                        <option value="Đỏ" <?php if ($color === 'Đỏ') echo 'selected'; ?>>Đỏ</option>
                        <option value="Xanh dương" <?php if ($color === 'Xanh dương') echo 'selected'; ?>>Xanh dương</option>
                        <option value="Xanh lá cây" <?php if ($color === 'Xanh lá cây') echo 'selected'; ?>>Xanh lá cây</option>
                        <option value="Vàng" <?php if ($color === 'Vàng') echo 'selected'; ?>>Vàng</option>
                        <option value="Tím" <?php if ($color === 'Tím') echo 'selected'; ?>>Tím</option>
                        <option value="Hồng" <?php if ($color === 'Hồng') echo 'selected'; ?>>Hồng</option>
                        <option value="Cam" <?php if ($color === 'Cam') echo 'selected'; ?>>Cam</option>
                        <option value="Nâu" <?php if ($color === 'Nâu') echo 'selected'; ?>>Nâu</option>
                        <option value="Xám" <?php if ($color === 'Xám') echo 'selected'; ?>>Xám</option>
                        <option value="Đen" <?php if ($color === 'Đen') echo 'selected'; ?>>Đen</option>
                        <option value="Trắng" <?php if ($color === 'Trắng') echo 'selected'; ?>>Trắng</option>
                    </select>      
                </div>
            </div>
            <button class="submit" type="submit" name="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M4 3h14l2.707 2.707a1 1 0 0 1 .293.707V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm3 1v5h9V4H7Zm-1 8v7h12v-7H6Zm7-7h2v3h-2V5Z"/></svg>Lưu</button>
            <button class="cancel" type="reset" href="<?php echo $backpage; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z"/></svg>Hủy</button>
            
        </form>
    </div>
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
                    if (option.value === 'Kaki' || option.value === 'jean' || option.value === 'Len') {
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
                select_meterial.style.display = 'none'; // Ẩn select_meterial nếu không có lựa chọn hợp lệ
            }
        });
    </script>

</body>