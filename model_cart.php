<?php
ob_start();
?>
<script>


function display_search() {
    event.preventDefault();
    let display_input = document.getElementsByClassName("search-form")[0];
    if (display_input.style.opacity === "1") {
        // display_input.style.display = "none";
        display_input.style.opacity = "0";
    } else {
        // display_input.style.display = "block";
        display_input.style.opacity = "1";
        display_input.style.transition = "opacity .5s";
    }
}




function themvaogiohang(x) {
    // var showcart = JSON.parse(localStorage.getItem("showcart")) || [];
    // console.log(showcart);
    var boxsp = x.parentElement;
    // console.log(boxsp);
    var hinh = boxsp.querySelector('input[name="anh"]').value;
    var tensp = boxsp.querySelector('input[name="tensp"]').value; // Chỉnh sửa "tensp" thay vì "gia" như trước
    var soluong = parseInt(boxsp.querySelector('input[name="soluong"]').value); // Chỉnh sửa "soluong" thay vì "gia" như trước
    var gia = boxsp.querySelector('input[name="gia"]').value;
    var id = boxsp.querySelector('input[name="id"]').value;
    var size = boxsp.querySelector('select[name="size"]').value;
    var mau = boxsp.querySelector('input[name="mau"]').value;
    // console.log(id);
    // console.log(size);
    // console.log(soluong);
    // console.log(hinh);
    // console.log(gia);
    // console.log(tensp);
    // var sp = new Array(hinh, gia, tensp, soluong, size,id);

    var isexist = false;

    for (var i = 0; i < showcart.length; i++) {
        if (showcart[i][2] === tensp && showcart[i][4] === size) {
            showcart[i][3] = parseInt(showcart[i][3]) + soluong;
            isexist = true;
            break;
        }
    }

    if (!isexist) {
        // Thêm sản phẩm mới vào giỏ hàng vì không tìm thấy sản phẩm có cùng tên và kích thước
        var sp = new Array(hinh, gia, tensp, soluong, size, id, mau);
        showcart.push(sp);
    }
    alert("Đã thêm vào giỏ hàng.");
    localStorage.setItem("showcart", JSON.stringify(showcart));
}


function showcart1() {
    event.preventDefault();
    var x = document.getElementById("showcart");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
    showmycart();
}
function showmycart() {
    // var showcart = JSON.parse(localStorage.getItem("showcart")) || [];
    var thongtingiohang = "";
    if (showcart.length > 0 ) {
        thongtingiohang += `<div class="cart-product">`;
        var tong = 0;
        for (var i = 0; i < showcart.length; i++) {
            var thanhtien = parseInt(showcart[i][1]) * parseInt(showcart[i][3]);
            tong += thanhtien;
            thongtingiohang += `
                <div class="product">
                    <img src="${showcart[i][0]}" onclick="window.location.href='product.php?id=${showcart[i][5]}'" alt="">
                    <div class="product-info">
                        <p class="product-name">${showcart[i][2]}</p>
                        <p class="product-size">Size: ${showcart[i][4]}</p>
                        <div class="product-details">
                            <div class="product-quantity-count">
                                <p class="quantity">Số lượng</p>
                                <div class="num">
                                    <a class="minus" onclick="minus(${i})"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path fill="#888888" d="M18 12.998H6a1 1 0 0 1 0-2h12a1 1 0 0 1 0 2z"/></svg></a>
                                    <input type="number" id="count-${i}" readonly value="${showcart[i][3]}">
                                    <a class="plus" onclick="plus(${i})"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path fill="#888888" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2v-6Z"/></svg></a>
                                </div>
                            </div>
                            <div class="product-price">
                                <p class="price">${number_format(showcart[i][1], 0, ",", ".")} VND</p>
                                <a onclick="xoasp(${i}, this)">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>`;
        }
        thongtingiohang += `
        </div>
            <div class="pay">
                <div class="total">
                    <p>Tổng tiền</p>
                    <p>${number_format(tong, 0, ",", ".")} VND</p>
                </div>
                <a href="cart.php"><input type="submit" value="ĐẶT HÀNG" name="dongydathang"></a>
            </div>`;
        
    }else {
        thongtingiohang += `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 201.387 201.387" style="enable-background:new 0 0 201.387 201.387; width: 80px; margin: 15px; position: relative; left: 30%;" xml:space="preserve"> <g> <g> <path d="M129.413,24.885C127.389,10.699,115.041,0,100.692,0C91.464,0,82.7,4.453,77.251,11.916    c-1.113,1.522-0.78,3.657,0.742,4.77c1.517,1.109,3.657,0.78,4.768-0.744c4.171-5.707,10.873-9.115,17.93-9.115    c10.974,0,20.415,8.178,21.963,19.021c0.244,1.703,1.705,2.932,3.376,2.932c0.159,0,0.323-0.012,0.486-0.034    C128.382,28.479,129.679,26.75,129.413,24.885z"/> </g> </g> <g> <g> <path d="M178.712,63.096l-10.24-17.067c-0.616-1.029-1.727-1.657-2.927-1.657h-9.813c-1.884,0-3.413,1.529-3.413,3.413    s1.529,3.413,3.413,3.413h7.881l6.144,10.24H31.626l6.144-10.24h3.615c1.884,0,3.413-1.529,3.413-3.413s-1.529-3.413-3.413-3.413    h-5.547c-1.2,0-2.311,0.628-2.927,1.657l-10.24,17.067c-0.633,1.056-0.648,2.369-0.043,3.439s1.739,1.732,2.97,1.732h150.187    c1.231,0,2.364-0.662,2.97-1.732S179.345,64.15,178.712,63.096z"/> </g> </g> <g> <g> <path d="M161.698,31.623c-0.478-0.771-1.241-1.318-2.123-1.524l-46.531-10.883c-0.881-0.207-1.809-0.053-2.579,0.423    c-0.768,0.478-1.316,1.241-1.522,2.123l-3.509,15c-0.43,1.835,0.71,3.671,2.546,4.099c1.835,0.43,3.673-0.71,4.101-2.546    l2.732-11.675l39.883,9.329l-6.267,26.795c-0.43,1.835,0.71,3.671,2.546,4.099c0.263,0.061,0.524,0.09,0.782,0.09    c1.55,0,2.953-1.062,3.318-2.635l7.045-30.118C162.328,33.319,162.176,32.391,161.698,31.623z"/> </g> </g> <g> <g> <path d="M102.497,39.692l-3.11-26.305c-0.106-0.899-0.565-1.72-1.277-2.28c-0.712-0.56-1.611-0.816-2.514-0.71l-57.09,6.748    c-1.871,0.222-3.209,1.918-2.988,3.791l5.185,43.873c0.206,1.737,1.679,3.014,3.386,3.014c0.133,0,0.27-0.009,0.406-0.024    c1.87-0.222,3.208-1.918,2.988-3.791l-4.785-40.486l50.311-5.946l2.708,22.915c0.222,1.872,1.91,3.202,3.791,2.99    C101.379,43.261,102.717,41.564,102.497,39.692z"/> </g> </g> <g> <g> <path d="M129.492,63.556l-6.775-28.174c-0.212-0.879-0.765-1.64-1.536-2.113c-0.771-0.469-1.696-0.616-2.581-0.406L63.613,46.087    c-1.833,0.44-2.961,2.284-2.521,4.117l3.386,14.082c0.44,1.835,2.284,2.964,4.116,2.521c1.833-0.44,2.961-2.284,2.521-4.117    l-2.589-10.764l48.35-11.626l5.977,24.854c0.375,1.565,1.775,2.615,3.316,2.615c0.265,0,0.533-0.031,0.802-0.096    C128.804,67.232,129.932,65.389,129.492,63.556z"/> </g> </g> <g> <g> <path d="M179.197,64.679c-0.094-1.814-1.592-3.238-3.41-3.238H25.6c-1.818,0-3.316,1.423-3.41,3.238l-6.827,133.12    c-0.048,0.934,0.29,1.848,0.934,2.526c0.645,0.677,1.539,1.062,2.475,1.062h163.84c0.935,0,1.83-0.384,2.478-1.062    c0.643-0.678,0.981-1.591,0.934-2.526L179.197,64.679z M22.364,194.56l6.477-126.293h143.701l6.477,126.293H22.364z"/> </g> </g> <g> <g> <path d="M126.292,75.093c-5.647,0-10.24,4.593-10.24,10.24c0,5.647,4.593,10.24,10.24,10.24c5.647,0,10.24-4.593,10.24-10.24    C136.532,79.686,131.939,75.093,126.292,75.093z M126.292,88.747c-1.883,0-3.413-1.531-3.413-3.413s1.531-3.413,3.413-3.413    c1.882,0,3.413,1.531,3.413,3.413S128.174,88.747,126.292,88.747z"/> </g> </g> <g> <g> <path d="M75.092,75.093c-5.647,0-10.24,4.593-10.24,10.24c0,5.647,4.593,10.24,10.24,10.24c5.647,0,10.24-4.593,10.24-10.24    C85.332,79.686,80.739,75.093,75.092,75.093z M75.092,88.747c-1.882,0-3.413-1.531-3.413-3.413s1.531-3.413,3.413-3.413    s3.413,1.531,3.413,3.413S76.974,88.747,75.092,88.747z"/> </g> </g> <g> <g> <path d="M126.292,85.333h-0.263c-1.884,0-3.413,1.529-3.413,3.413c0,0.466,0.092,0.911,0.263,1.316v17.457    c0,12.233-9.953,22.187-22.187,22.187s-22.187-9.953-22.187-22.187V88.747c0-1.884-1.529-3.413-3.413-3.413    s-3.413,1.529-3.413,3.413v18.773c0,15.998,13.015,29.013,29.013,29.013s29.013-13.015,29.013-29.013V88.747    C129.705,86.863,128.176,85.333,126.292,85.333z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>`;
        thongtingiohang += `<p style="text-align: center;">Không có sản phẩm nào trong giỏ hàng của bạn</p>`;
    }
    document.getElementById("showcart").innerHTML = thongtingiohang;
    
}
function number_format(number, soThapPhan, dauPhayPhanCach, dauChamThapPhan) {
    number = parseFloat(number);

    // Kiểm tra xem số có hợp lệ hay không
    if (!isFinite(number) || isNaN(number)) return '';

    if (soThapPhan === undefined) soThapPhan = 2;
    if (dauPhayPhanCach === undefined) dauPhayPhanCach = ',';
    if (dauChamThapPhan === undefined) dauChamThapPhan = '.';

    // Sử dụng toFixed để giữ số thập phân cố định
    var chuoiSo = number.toFixed(soThapPhan);

    var [phanNguyen, phanThapPhan] = chuoiSo.split('.');

    var ketQua = '';
    while (phanNguyen.length > 3) {
        ketQua = dauPhayPhanCach + phanNguyen.slice(-3) + ketQua;
        phanNguyen = phanNguyen.slice(0, -3);
    }

    return (number < 0 ? '-' : '') + phanNguyen + ketQua + (phanThapPhan ? (dauChamThapPhan + phanThapPhan) : '');
}



var showcart = JSON.parse(localStorage.getItem("showcart")) || [];
function plus(i) {
    if (showcart[i] && showcart[i].length >= 4) {
        showcart[i][3] = parseInt(showcart[i][3]) + 1;
        var num = document.getElementById(`count-${i}`);
        num.value = showcart[i][3];
        updateLocalStorage();
        showmycart();
    }
    // showmycart();
}

function minus(i,element) {
    if (showcart[i] && showcart[i].length >= 4 && showcart[i][3] > 1){
        showcart[i][3] = parseInt(showcart[i][3]) - 1;
        var num = document.getElementById(`count-${i}`);
        num.value = showcart[i][3]; 
        updateLocalStorage();
        showmycart();
    }else if (showcart[i][3] == 1) {
        showcart.splice(i, 1);
        updateLocalStorage();
        showmycart();
    }
    
    // showmycart();
}
function updateLocalStorage() {
    localStorage.setItem("showcart", JSON.stringify(showcart));
}
function xoasp(index, element) {
    var tr = element.parentElement.parentElement.parentElement;
    var tensp = tr.querySelector('.product-name').innerText;
    var size = tr.querySelector('.product-size').innerText.replace('Size: ', '');
    console.log(tensp);
    console.log(size);
    tr.remove();
    for (var i = 0; i < showcart.length; i++) {
        if (showcart[i][2] === tensp && showcart[i][4] === size) {
            showcart.splice(i, 1);
            break; // Exit the loop after removing the item
        }
    }
    updateLocalStorage();
    showmycart();
}
function clearShowCartLocalStorage() {
    localStorage.removeItem("showcart");
}




// function xoatatca() {
//     showcart = [];
//     showmycart();
//     showcountsp();
// }

// function dongydathang() {
//     var ttnh = document.getElementById("thongtinnhanhang");
//     var hoten = ttnh[0].children[1].children[0].value;
//     var diachi = ttnh[1].children[1].children[0].value;
//     var dienthoai = ttnh[2].children[1].children[0].value;
//     var email = ttnh[3].children[1].children[0].value;

//     var nguoinhan = [hoten, diachi, dienthoai, email];

//     console.log(nguoinhan);

//     localStorage.setItem("nguoinhan", JSON.stringify(nguoinhan));

//     window.location.assign("donhang.html");
// }

// function showthongtinnguoinhan() {
//     var nguoinhan = localStorage.getItem("nguoinhan");
//     var thongtin = JSON.parse(nguoinhan);

//     var tt = '';
//     // Bạn cần thêm mã HTML hoặc tạo các phần tử HTML ở đây dựa trên thông tin người nhận và gán vào biến "tt".

//     document.getElementById("thongtinnhanhang").innerHTML = tt;
// }

// menu.onclick = () => {
//     menu.classList.toggle('bx-x');
//     navmenu.classList.toggle('open');
// }

// const heartIcons = document.querySelectorAll('.heart-icon');

// heartIcons.forEach(function(heartIcon) {
//     var isRed = false;

//     heartIcon.addEventListener('click', function() {
//         const icon = heartIcon.querySelector('i');
//         if (isRed) {
//             icon.style.color = 'black';
//         } else {
//             icon.style.color = 'red'; // Chỉnh sửa "style.color" thành "style.color"
//         }
//         isRed = !isRed;
//     });
// });



</script>