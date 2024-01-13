<?php
    session_start();
    include "thuvien.php";
    include "model_cart.php";
    include "connectDB.php";
    $spid = $_GET['id'];
    // if (isset($_SESSION['user_id'])) {
    //     $user_id = $_SESSION['user_id'];
    // }
    if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
        $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
    }
    // if(!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];
    
    // // //Lam rong gio hang
    // // if(isset($_GET['delcart'])&&($_GET['delcart']==1)) {
    // //     unset($_SESSION['giohang']);
    // //     header('Location: product.php');
    // //     exit();infoproducts
    // // }
    
    // //Xoa sp trong gio hang
    // if(isset($_GET['delid']) && $_GET['delid'] >= 0){
    //     if(isset($_SESSION['giohang'][$_GET['delid']])) {
    //         array_splice($_SESSION['giohang'], $_GET['delid'], 1);
    //     }
    //     // header('Location: product.php');
    //     // exit();
    // }

    // if(isset($_POST['addcart'])&&($_POST['addcart'])) {
    //     $id = $_POST['id'];
    //     $hinh = $_POST["anh"];
    //     $tensp = $_POST["tensp"];
    //     $gia = $_POST["gia"];
    //     $soluong = $_POST["soluong"];
    //     $size = $_POST["size"];

    //     //Kiem tra sp co trong gi hang hay khong
    //     $fl = 0; //kiem tra sp co bi trung khong
    //     for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
    //         if($_SESSION['giohang'][$i][1] == $tensp && $_SESSION['giohang'][$i][4] == $size) {
    //                 $fl = 1;
    //                 $_SESSION['giohang'][$i][3] += $soluong;
    //                 break;
    //             }
    //         }
    //     if ($fl==0){ //neu khong trung thi them moi
    //         //Them moi sp vao gio hang
    //         $sp = [$hinh,$tensp,$gia,$soluong,$size,$id];

    //         $_SESSION["giohang"][] = $sp;
    //     }
    //     print_r($_SESSION["giohang"]);
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Clothes Shopping</title>
    <link rel="stylesheet" href="css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet"
href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <?php
    
    $sql = "SELECT product.id as id, name, product.price as price, images, promotion.price as pro_price, describes, ratingStar FROM product JOIN promotion ON product.salePromotion = promotion.id WHERE product.id = '$spid'";
    $result = mysqli_query($conn, $sql);
    while ($r = mysqli_fetch_array($result)) {
        $array_image = explode(",", $r['images']);
        $image1 = $array_image[0];
        $image2 = $array_image[1];
        $price = $r['price']-$r['pro_price'];
        $array_describes = explode(",", $r['describes']);
        $xuatxu = $array_describes[0];
        $chatlieu = $array_describes[1];
        $chieudai = $array_describes[2];
        $mau = $array_describes[3];
        ?>
        <section id="prodetails">
            <div class="single-pro-image">
                <?php echo '<img src="http://localhost/Kumo/' . $image1 . '" width="100%" id="MainImg" alt="Ảnh chính"/>' ?>
                <div class="small-img-group">
                    <div class="small-img-col">
                        <?php echo '<img src="http://localhost/Kumo/' . $image1 . '" width="100%" class="small-img" alt="Ảnh"/>' ?>
                    </div>
                    <div class="small-img-col">
                        <?php echo '<img src="http://localhost/Kumo/' . $image2 . '" width="100%" class="small-img" alt="Ảnh"/>' ?>
                    </div>
                    <div class="small-img-col">
                        <?php echo '<img src="http://localhost/Kumo/' . $image1 . '" width="100%" class="small-img" alt="Ảnh"/>' ?>
                    </div>
                    <div class="small-img-col">
                        <?php echo '<img src="http://localhost/Kumo/' . $image2 . '" width="100%" class="small-img" alt="Ảnh"/>' ?>
                    </div>
                </div>
            </div>

            <div class="single-pro-details">
                <h6>Home / T-shirt</h6>
                <h4><?php echo $r['name'] ?></h4>
                <h2><?php echo number_format($price, 0, ',', '.') ?>đ</h2>
                <del><?php echo number_format($r['price'], 0, ',', '.') ?>đ</del>
                <form action="" method="POST" onsubmit="return false;">
                    <input type="submit" name="addcart" value="Đặt hàng" class="normal" onclick="themvaogiohang(this)"></input>

                        <select name="size" style="width: 105px;">
                            <option value="XL">XL</option>
                            <option value="L">L</option>
                            <option value="M">M</option>
                            <option value="S">S</option>
                        </select>
                        <input type="number" name="soluong" value="1" min="1">
                        <input type="hidden" name="id" value="<?php echo $r['id'] ?>">
                        <input type="hidden" name="anh" value="http://localhost/Kumo/<?php echo $image1 ?>">
                        <input type="hidden" name="tensp" value="<?php echo $r['name'] ?>">
                        <input type="hidden" name="gia" value="<?php echo $r['price']-$r['pro_price'] ?>">
                        <input type="hidden" name="mau" value="<?php echo $mau ?>">

                    <!-- </form> -->
                </form>
                
                <h4>Product details</h4>
                <span>
                    <p>Xuất xứ: <span><?php echo $xuatxu ?></span></p>
                    <p>Chất liệu: <span><?php echo $chatlieu ?></span></p>
                    <p>Chiều dài: <span><?php echo $chieudai ?></span></p>
                    <p>Màu: <span><?php echo $mau ?></span></p>
                    <p><span>Chi tiết áo:</span> <br>- Chất vải: <span>TC thoáng mát, thấm hút, không nhăn</span> <br>- Phom áo: <span> Suông che khuyết điểm tốt và dễ dàng hoạt động </span> <br>- Hoàn thiện: <span>tỉ mỉ cao</span></p>
                </span>
            </div>
        </section>
    <?php
    }
    ?>
    
    

    <section class="trending-product" id="trending">
        <div class="center-text">
            <h2>Sản phẩm <span>Nổi bật</span></h2>
        </div>

        <div class="products">
            <?php
                $sql = "SELECT product.id as id,name,product.price,images,specName,brand,promotion.price as pro_price,describes,ratingStar FROM product JOIN promotion ON product.salePromotion  = promotion.id and product.id <> $spid LIMIT 0,4";
                $result = mysqli_query($conn, $sql);
                while ($r = mysqli_fetch_array($result)) {
                    $array_image = explode(",", $r['images']);
                    $image = $array_image[0];
                    ?>
                    <div class="row">
                        <div class="img">
                        <?php echo '<img src="http://localhost/Kumo/' . $image . '" alt="Ảnh 1" onclick="window.location.href=\'product.php?id=' . $r['id'] . '\';" />' ?>
                        </div>
                        <div class="product-text">
                            <h5>Sale</h5>
                        </div>
                        <div class="heart-icon">
                            <i class='bx bxs-heart'></i>
                        </div>
                        <div class="cart-icon">
                            <i class='bx bxs-cart'></i>
                        </div>
                        <div class="star">
                            <?php
                                $count = 0;
                                $star = $r['ratingStar'];
                                while ($star >= 1) {
                                    $star -= 1;
                                    echo '<i class="fas fa-star"></i>';
                                    $count += 1;
                                }
                                if ($star > 0) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                    $count += 1;
                                }
                                while ($count < 5) {
                                    echo '<i class="fa-regular fa-star"></i>';
                                    $count += 1;
                                }
                            ?>
                        </div>
                        <div class="price">
                            <h4><?php echo $r['name'] ?></h4>
                            <p>Giá chưa giảm: <del><?php echo number_format($r['price'], 0, ',', '.') ?>đ</del> <br> Giá đã giảm: <?php echo number_format($r['price']-$r['pro_price'], 0, ',', '.') ?></p>
                        </div>
                        <button class="Order" onclick="window.location.href='product.php?id=<?php echo $r['id']; ?>'">Đặt hàng</button>
                    </div>
                    <?php
                }
                    
            ?>

            
            </div>
        </div>
    </section>
    
    <section id="newsletter">
        <div class="newstext">
            <h4>Đăng Ký Để Nhận Tin Tức Mới Nhất</h4>
            <p>Nhận cập nhật qua E-mail về cửa hàng mới nhất của chúng tôi và <span>các ưu đãi đặc biệt.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal" onclick="window.location.href='register_form.php'">Đăng ký</button>
        </div>
    </section>
    
    <?php 
    include 'footer.php'; 
    include 'header.php';
    ?>
    
    <script>
        var MainImg = document.getElementById("MainImg");
        var smallimg = document.getElementsByClassName("small-img");

        smallimg[0].onclick = function(){
            MainImg.src = smallimg[0].src;
        }
        smallimg[1].onclick = function(){
            MainImg.src = smallimg[1].src;
        }
        smallimg[2].onclick = function(){
            MainImg.src = smallimg[2].src;
        }
        smallimg[3].onclick = function(){
            MainImg.src = smallimg[3].src;
        }
        //xử lí giỏ hàng

        //xử lí tăng giảm số lượng sản phẩm
        // function plus(index) {
        //     let input = document.getElementById("input-" + index);
        //     input.value = parseFloat(input.value) + 1;
        // }
        // function minus(index) {
        //     let input = document.getElementById("input-" + index);
        //     if (input.value > 1) {
        //         input.value = parseFloat(input.value) - 1;
        //     }
        // }
        function updateQuantity(index) {
            let input = document.getElementById("input-" + index);
            let newQuantity = parseFloat(input.value);

            // let xhr = new XMLHttpRequest();
            // xhr.open("POST", "update_cart.php", true);
            // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // xhr.onreadystatechange = function() {
            //     if (xhr.readyState === 4 && xhr.status === 200) {
            //     }
            // };
            // xhr.send("index=" + index + "&newQuantity=" + newQuantity);
            $_SESSION['giohang'][index][3] = newQuantity;
        }
        // let cart = [];
        // const addToCart = async (id) => {
        //     let storage = localstorage.getItem("cart")
        //     if (storage) {
        //         cart = JSON.parse(storage)
        //     }

        //     let product = await getProductbyID(id)

        //     let item = cart.find(c => c.product.id == id)
        //     if (item) {
        //         item.quantity += 1
        //     } else {
        //         cart.push({product,quantity:1})
        //     }
        //     localstorage.setItem('cart', JSON.stringify(cart));
        // }
    </script>

</body>
</html>