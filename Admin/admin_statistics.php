<?php 
$nth = 5;
$content = "Thống kê";
session_start();
if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
    $user_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_SESSION['user_id'];
}

// include 'add_product.html';
include 'admin_leftside.php';
require_once 'connectDB.php';

$sql = "SELECT category, AVG(price) AS 'TB', count(*) AS `COUNT` FROM `product` group by category";
$result1 = mysqli_query($conn,$sql);
// $r = mysqli_fetch_array($result);
$name_category = array();
$avgPrice = array();
$quantity = array();

if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        $name_category[] = $row['category'];
        $avgPrice[] = round($row['TB']);
        $quantity[] = $row['COUNT'];
    }

} else {
    echo "Không có dữ liệu.";
}


$category = json_encode($name_category);
$avgPrice = json_encode($avgPrice);
$quantity = json_encode($quantity);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Clothes Shopping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="listed.css">
    <style>
        *{
            font-family: "Roboto","Helvetica Neue",Arial,sans-serif;
        }
        .rightside {
            position: absolute;
            right: 0;
            top: 0;
            width: 80%;
            /* height: 90%; */
            margin-top: 4%;
            transition: all 1s ease;
        }

        .rightside_max {
            position: absolute;
            right: 0;
            top: 0;
            width: 90%;
            /* height: 100vh; */
            margin-top: 4%;
            transition: all 1s ease;
        }
        .rightside .small-table {
            /* height: 180px;
            width: 1100px; */
            left: 30%;
            height: 25%;
            width: 80%;
        }
        .contain {
            width: 98%;
            margin: 0;
            display: flex;
            margin-top: 50px;
            transition: all 1s ease; 
        }
        
        .rightside_max .contain {
            width: 100%;
            transition: all 1s ease;
        } 
        .small-table {
            margin-top: 10px;
        }
        .table{
            /* width: 95%; */
            margin-left: 6%;
        }
        .table tr th,tr td {
            width: 50%;
            padding: 3px !important;
        }
        #myChart,#myChart1 {
            position: relative;
            top: 0.1rem;
            width: 80% !important;
            height: 40% !important;
        }
        #myChart {
            top: 0;
            width: 96% !important;
            height: 80% !important;
        }
        /* .chart1,.chart2 {
            margin-top: 10px;
        } */
        .chart1 {
            width: 80%;
            height: 90%; 
        }
        .chart1 #myChart {
            margin-top: 5%;
        }
        .chart2 {
            margin-left:5%;
            width: 50%;
            height: 80%;
        }
        .chart2 h2{
            width: 27rem;
        }
        #myChart1 {
            position: relative;
        }
    </style>
</head>
<body>
<div class="rightside">
    <div class="small-table">
        <table id="priceTable" class="table">
            <thead>
                <tr>
                    <th scope="col">Loại sản phẩm</th>
                    <th scope="col">Giá trung bình</th>
                    <th scope="col">Số lượng</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
        <div class="contain"> 
            <div class="chart1">
                <h2>Giá trung bình sản phẩm</h2>
                <canvas id="myChart"></canvas>
            </div> 
            
            <div class="chart2">
                <h2>Số lượng từng sản phẩm</h2>
                <canvas id="myChart1"></canvas>
            </div> 
            
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var category = <?php echo $category;?>;
                var avgPrice = <?php echo $avgPrice;?>;
                var countCategory = <?php echo $quantity;?>;
                var data = avgPrice;
                
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: category,
                        datasets: [{
                            label: 'Giá trung bình sản phẩm: ',
                            data: avgPrice,
                            backgroundColor: [
                                    "#3C97DA","#F6C85F","#7A5EBC","#32A865"
                            ],
                            borderColor: 'black',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                ticks: {
                                    callback: function(value) {
                                        return 'VND' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }
                                }
                            }
                        }
                    }
                });

                var tableBody = document.getElementById('priceTable').getElementsByTagName('tbody')[0];
                for (var i = 0; i < category.length; i++) {
                    var newRow = tableBody.insertRow(tableBody.rows.length);
                    var cell1 = newRow.insertCell(0);
                    var cell2 = newRow.insertCell(1);
                    var cell3 = newRow.insertCell(2);
                    cell1.innerHTML = category[i];
                    cell2.innerHTML = avgPrice[i].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' VND';
                    cell3.innerHTML = countCategory[i];
                }

                var ctx1 = document.getElementById('myChart1').getContext('2d');


                var myChart = new Chart(ctx1, {
                    type: 'pie',
                    data: {
                        labels: category,
                        datasets: [{
                            label: 'Số lượng sản phầm: ',
                            data: countCategory,
                            backgroundColor: [
                                "#3C97DA","#F6C85F","#7A5EBC","#32A865"
                            ],
                            borderColor: 'black',
                            borderWidth: 1
                        }]
                    },
                });
            </script>  
            <script src="change.js"></script>
        </div>
    </div>
    
</body>
</html>
