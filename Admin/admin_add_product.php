<?php
$nth = 4;
$content = "Thêm mới";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'add_product.php'; ?>
    <?php include 'admin_leftside.php'; ?>
    <script src="change.js"></script>
</body>
</html>

<!-- <script>
    const open = document.querySelector('.name-page');
    const leftside = document.querySelector('.left-side');
    const rightside = document.querySelector('.rightside');

    function myFunction() {
        if (leftside.classList.contains('left-side') && rightside.classList.contains('rightside')) {
            leftside.classList.remove('left-side');
            leftside.classList.add('left-side-short');
            rightside.classList.remove('rightside');
            rightside.classList.add('rightside_max');
        } else {
            leftside.classList.remove('left-side-short');
            leftside.classList.add('left-side');
            rightside.classList.remove('rightside_max');
            rightside.classList.add('rightside');
        }
    }
</script> -->



