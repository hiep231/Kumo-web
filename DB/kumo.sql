-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 12:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kumo`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `salePromotion` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `decs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`salePromotion`, `name`, `decs`) VALUES
(10, 'Áo phông', 'Áo phông này là sự thể hiện của sự đơn giản và thoải mái, với kiểu dáng tối giản và chất liệu mềm mịn, là lựa chọn tuyệt vời cho ngày hằng ngày.'),
(15, 'Áo polo', 'Áo polo này kết hợp giữa sự sang trọng và thoải mái với thiết kế cổ polo truyền thống và chất liệu cao cấp, là sự lựa chọn hoàn hảo cho cả công việc và giải trí.'),
(35, 'Quần', 'Chiếc quần này là sự kết hợp hoàn hảo giữa phong cách và thoải mái, với chất liệu mềm mịn và kiểu dáng hiện đại, là sự lựa chọn hoàn hảo cho mọi dịp.'),
(20, 'Sơ mi', 'Chiếc áo sơ mi này mang đến sự lịch lãm và thanh lịch với kiểu dáng cổ điển, là sự lựa chọn tuyệt vời cho bất kỳ tình huống nào.');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `id` int(11) NOT NULL,
  `orders` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(20) NOT NULL,
  `images` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`id`, `orders`, `product`, `price`, `quantity`, `size`, `images`) VALUES
(504, 333, 'Áo Polo Phối Sọc', 270000, 2, 'XL', 'http://localhost/Kumo/hinh_sp/8.jpg'),
(505, 336, 'Sơ Mi Họa Tiết Cọ', 230000, 100, 'L', 'http://localhost/Kumo/hinh_sp/11.jpg'),
(506, 338, 'Sơ Mi Họa Tiết Bông Xanh', 270000, 1, 'XL', 'http://localhost/Kumo/hinh_sp/11.jpg'),
(507, 340, 'Quần Underwear Trunk Boxer AC076', 490000, 1, 'XL', 'http://localhost/Kumo/hinh_sp/teelab-3.webp'),
(508, 341, 'Áo Polo Phối Sọc', 270000, 3, 'XL', 'http://localhost/Kumo/hinh_sp/8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderCode` varchar(100) NOT NULL,
  `statusName` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `totalAmount` int(11) NOT NULL,
  `totalAmountTemporary` int(11) NOT NULL,
  `promotion` int(11) NOT NULL,
  `totalPromotion` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT '2023-11-23 00:00:00',
  `customer` varchar(255) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderCode`, `statusName`, `phone`, `note`, `location`, `email`, `totalAmount`, `totalAmountTemporary`, `promotion`, `totalPromotion`, `time`, `customer`, `user`) VALUES
(333, 'ORD63139', 'Huỷ đơn hàng', '0862204453', '', 'rsshr6h516eh', 'dotuanhiep231@gmail.com', 540000, 540000, 0, 0, '2023-12-09 00:27:27', 'hau', 28),
(336, 'ORD79549', 'Đang xử lí', '0989898987', '', 'GV', 'hau2803nch@gmail.com', 23000000, 23000000, 0, 0, '2023-12-09 09:41:21', 'Hau', 48),
(338, 'ORD12343', 'Đã giao thành công', '1111111111', '', 'rsshr6h516eh', 'dotuanhiep231@gmail.com', 270000, 270000, 0, 0, '2023-12-09 10:30:26', 'hao', 29),
(340, 'ORD23137', 'Đã giao thành công', '0927022731', '', '10', 'sinh121@gmail.com', 490000, 490000, 0, 0, '2023-12-09 10:39:54', 'hao', 29),
(341, 'ORD92923', 'Đang xử lí', '0862204453', '', 'rsshr6h516eh', 'hiep.2274802010242@vanlanguni.vn', 810000, 810000, 0, 0, '2023-12-09 18:00:43', 'hao', 49);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `ratingStar` float NOT NULL,
  `salePromotion` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `specName` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `describes` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `brand` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `point`, `images`, `ratingStar`, `salePromotion`, `category`, `specName`, `name`, `describes`, `price`, `brand`) VALUES
(68, 0, 'hinh_sp/2.jpg,hinh_sp/6.jpg', 4, 10, 'Sơ mi', 'Sơ Mi Ngân Hà', 'Sơ Mi Họa Tiết Ngân Hà', 'Vietnam, Lụa, Tay ngắn, Vàng', 280000, 'Roway'),
(70, 0, 'hinh_sp/4.jpg,hinh_sp/4.jpg', 4.5, 0, 'Áo polo', 'Polo Xanh Cổ Sọc', 'Áo Polo Xanh Cổ Sọc', 'Vietnam, Lụa, Tay ngắn, Xanh lá cây', 320000, 'Roway'),
(71, 0, 'hinh_sp/8.jpg,hinh_sp/8.jpg', 4, 50, 'Áo polo', 'Polo Sọc', 'Áo Polo Phối Sọc', 'Korea, Cotton, Tay ngắn, Đen', 320000, 'Roway'),
(72, 0, 'hinh_sp/11.jpg,hinh_sp/6.jpg', 5, 10, 'Sơ mi', 'Sơ Mi Bông Xanh', 'Sơ Mi Họa Tiết Bông Xanh', 'Korea, Cotton, Tay ngắn, Đen', 280000, 'Roway'),
(73, 0, 'hinh_sp/10.jpg,hinh_sp/10.jpg', 5, 0, 'Áo polo', 'Polo Cổ Đen', 'Áo Polo Trắng Cổ Đem', 'Korea, Cotton, Tay ngắn, Trắng', 280000, 'Roway'),
(74, 0, 'hinh_sp/11.jpg,hinh_sp/17.jpg', 5, 20, 'Áo polo', 'Sơ Mi Cọ', 'Sơ Mi Họa Tiết Cọ', 'Korea, Cotton, Tay ngắn, Đen', 250000, 'Roway'),
(75, 0, 'hinh_sp/18.jpg,hinh_sp/20.jpg', 4.5, 20, 'Áo polo', 'Sơ Mi Hoa Cúc', 'Sơ Mi Họa Tiết Hoa Cúc', 'Korea, Cotton, Tay ngắn, Đen', 250000, 'Roway'),
(76, 5, 'hinh_sp/levent-1.jpg,hinh_sp/levent-2.jpg', 4.5, 35, 'Áo phông', 'Polo Mini Popular/ Black', 'Áo Polo Levents Mini Popular/ Black', 'Korea, Cotton, Tay ngắn, Đen', 370000, 'Levents'),
(77, 4, 'hinh_sp/levent-4.jpg,hinh_sp/levent-3.jpg', 4, 50, 'Áo polo', 'Polo Stripe/ Black', 'Áo Polo Levents Stripe/ Black', 'USA, Cotton, Tay ngắn, Đen', 420000, 'Levents'),
(78, 5, 'hinh_sp/levent-5.jpg,hinh_sp/levent-6.png', 5, 45, 'Áo phông', 'Mini Popular Logo/ White', 'Áo Thun Levents Mini Popular Logo/ White', 'USA, Cotton, Tay ngắn, Trắng', 350000, 'Levents'),
(79, 0, 'hinh_sp/quan1.jpg,hinh_sp/quan2.jpg', 4.5, 0, 'Quần', 'Classic Line Track/ Black', 'Quần Levents Classic Line Track/ Black', 'USA, Kaki, Quần dài, Đen', 470000, 'Levents'),
(80, 5, 'hinh_sp/teelab-1,hinh_sp/teelab-2.webp', 5, 5, 'Áo phông', 'TS144', 'Unisex Cyborg Rabbit TS144', 'ThaiLan, Cotton, Tay ngắn, Kem', 185000, 'Teelab'),
(81, 0, 'hinh_sp/teelab-3.webp,hinh_sp/teelab-4.webp', 5, 0, 'Quần', 'AC076', 'Quần Underwear Trunk Boxer AC076', 'USA, Cotton, Quần ngắn, Đen', 490000, 'Teelab'),
(82, 5, 'hinh_sp/teelab-5.webp,hinh_sp/teelab-6.webp', 5, 15, 'Quần', 'GP008', 'Quần Jean Unisex Basic Denim GP008', 'USA, Cotton, Quần dài, Xám', 249000, 'Teelab'),
(84, 5, 'hinh_sp/swe-3.jpg,hinh_sp/swe-4.jpg', 5, 5, 'Áo phông', 'PINK', 'TEE - PINK', 'USA, Cotton, Tay ngắn, Hồng', 280000, 'Swevn'),
(85, 5, 'hinh_sp/levent-spooky1.jpg,hinh_sp/levent-spooky2.jpg', 5, 20, 'Áo phông', 'Spooky', 'Spooky Tee', 'ThaiLan, Cotton, Tay ngắn, Kem', 380000, 'Levents'),
(86, 5, 'hinh_sp/levent-air1.jpg,hinh_sp/levent-air2.jpg', 5, 40, 'Áo phông', 'Airplane', 'Airplane Tee', 'ThaiLan, Cotton, Tay ngắn, Đen', 380000, 'Levents'),
(87, 5, 'hinh_sp/levent-air1.jpg,hinh_sp/levent-air2.jpg', 5, 35, 'Áo phông', 'Inspire', 'Inspire Tee', 'USA, Cotton, Tay ngắn, Đen', 280000, 'Levents'),
(88, 5, 'hinh_sp/levent-air1.jpg,hinh_sp/levent-air2.jpg', 5, 45, 'Áo polo', 'KNIT', 'KNIT POLO', 'USA, Cotton, Tay ngắn, Nâu', 580000, 'Levents'),
(89, 5, 'hinh_sp/levent-aknit3.jpg,hinh_sp/levent-aknit4.jpg', 5, 45, 'Áo polo', 'KNIT', 'KNIT POLO', 'USA, Cotton, Tay ngắn, Kem', 580000, 'Levents'),
(91, 5, 'hinh_sp/roway-longJean1.jpg,hinh_sp/roway-longJean2.jpg', 5, 10, 'Quần', 'Đứng02', 'JEAN Đứng', 'Korea, jean, Quần dài, Xanh dương', 320000, 'Roway'),
(92, 5, 'hinh_sp/levent-Pants1.jpg,hinh_sp/levent-Pants2.jpg', 5, 5, 'Quần', 'PS060', 'short kaki túi hộp Basic PS060', 'ThaiLan, Kaki, Quần ngắn, Kem', 185000, 'Teelab'),
(93, 5, 'hinh_sp/teelab-shortkari3,hinh_sp/teelab-shortkari4', 5, 5, 'Quần', 'PS063', 'short kaki túi hộp Basic PS063', 'ThaiLan, Kaki, Quần ngắn, Xanh rêu', 185000, 'Teelab'),
(94, 5, 'hinh_sp/swe-sand1.jpg,hinh_sp/swe-sand2.jpg', 5, 5, 'Quần', 'SAND', 'HUNTER PANTS - SAND', 'ThaiLan, Kaki, Quần dài, Nâu', 295000, 'Teelab'),
(95, 5, 'hinh_sp/swe-black1.webp,hinh_sp/swe-black2.webp', 5, 5, 'Quần', 'BLACK01', 'HUNTER PANTS - BLACK', 'ThaiLan, Kaki, Quần dài, Đen', 295000, 'Teelab'),
(96, 5, 'hinh_sp/swe-ripped1.webp,hinh_sp/swe-ripped2.webp', 5, 20, 'Quần', 'RIPPED01', 'RIPPED CARGO JEANS - BLACK', 'Vietnam, cargo, Quần dài, Xanh dương', 300000, 'Swevn'),
(97, 5, 'hinh_sp/swe-ripped1.webp,hinh_sp/swe-ripped2.webp', 5, 5, 'Quần', 'NYLON01', 'TYPE NYLON SHORT - GREEN', 'Vietnam, Kaki, Quần ngắn, Xanh lá cây', 160000, 'Swevn'),
(98, 5, 'hinh_sp/swe-black3.webp,hinh_sp/swe-black4.webp', 5, 10, 'Áo phông', 'DEVIL2', 'DEVIL TEE - BLACK', 'Vietnam, Cotton, Tay ngắn, Đen', 150000, 'Swevn'),
(99, 5, 'hinh_sp/roway-pantbeige1.webp,hinh_sp/roway-pantbeige2.png', 5, 20, 'Quần', 'POCKET03', 'NAMELESS POCKET PANTS - BEIGE', 'USA, Kaki, Quần dài, Kem', 320000, 'Levents'),
(100, 5, 'hinh_sp/roway-destroyed1.webp,hinh_sp/roway-destroyed2.webp', 5, 20, 'Quần', 'DESTROYED05', 'DOUBLE DESTROYED BAGGY SHORT', 'ThaiLan, jean, Quần dài, Kem', 350000, 'Levents'),
(101, 5, 'hinh_sp/roway-disstressed1.webp,hinh_sp/roway-disstressed2.webp', 5, 20, 'Quần', 'DISSTRESSED04', 'BROWN DISSTRESSED CARGO SHORT', 'ThaiLan, cargo, Quần ngắn, Nâu', 270000, 'Roway'),
(102, 5, 'hinh_sp/roway-disstressed1.webp,hinh_sp/roway-disstressed2.webp', 5, 5, 'Quần', 'OLIVE02', 'MOUNTAIN SHORT OLIVE', 'ThaiLan, Kaki, Quần ngắn, Xanh rêu', 4900000, 'Roway'),
(103, 5, 'hinh_sp/levent-cargo1.webp,hinh_sp/levent-cargo2.webp', 5, 5, 'Quần', 'EVERYDAY03', '\"OUTDOOR EVERYDAY\" CARGO PANTS - TAN', 'ThaiLan, Kaki, Quần dài, Nâu', 385000, 'Levents'),
(105, 5, 'hinh_sp/levent-aknit3.jpg,hinh_sp/levent-inspire1.jpg', 5, 10, 'Sơ mi', 'beauti1', 'Áo polo siêu đẹp', 'Vietnam, Lụa, Tay ngắn, Lục bảo', 200000, 'Swevn'),
(112, 5, 'hinh_sp/3.png,hinh_sp/3.png', 5, 15, 'Quần', 'saaf', 'Áo polo siêu đẹp', 'USA, jean, Quần ngắn, Vàng', 300000, 'Swevn'),
(113, 5, 'hinh_sp/14.jpg,hinh_sp/12.jpg', 5, 10, 'Quần', 'short2', 'Quần short111', 'ThaiLan, jean, Quần ngắn, Nâu caramen', 500000, 'Swevn'),
(114, 5, 'hinh_sp/levent-air1.jpg,hinh_sp/levent-air2.jpg', 5, 50, 'Sơ mi', 'awd', 'ao polo', 'ThaiLan, Cotton, Tay ngắn, Lavender', 200000, 'Swevn');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `code`, `price`) VALUES
(0, 'sale0', 0),
(5, 'sale5', 5000),
(10, 'sale10', 10000),
(15, 'sale15', 15000),
(20, 'sale20', 20000),
(35, 'sale35', 35000),
(40, 'sale40', 40000),
(45, 'sale45', 45000),
(50, 'sale50', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `passwords` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `addressesList` varchar(100) NOT NULL,
  `isAdmin` bit(1) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `email`, `userName`, `passwords`, `avatar`, `gender`, `addressesList`, `isAdmin`, `status`) VALUES
(28, '0862204453', 'dotuanhiep231@gmail.com', 'Đỗ Tuấn Hiệp', 'd41d8cd98f00b204e9800998ecf8427e', 'avater_hiep.jpg', 'Khác', '201/20 Nguyễn Thái Sơn, p7, Gò Vấp', b'1', '0'),
(29, '', 'hao123@gmail.com', 'Trần Tử Hào', '698d51a19d8a121ce581499d7b701668', 'hao.png', '', '', b'1', '0'),
(30, '', 'Phu6666@gmail.com', 'Sỹ Phú', 'e9510081ac30ffa83f10b68cde1cac07', 'avater_phu.jpg', '', '', b'1', '0'),
(31, '0359677657', 'sinh121@gmail.com', 'Lê Nhất Sinh', 'd41d8cd98f00b204e9800998ecf8427e', 'avater_sinh.jpg', 'Nam', '104 Nguyễn Văn Nghi, p7, Gò Vấp', b'0', '1'),
(33, '', 'hau123@gmail.com', 'Hậu', '202cb962ac59075b964b07152d234b70', 'avater_hau.jpg', '', '', b'1', '0'),
(34, '0987654321', 'thien1103@gmail.com', 'Thiện', 'd41d8cd98f00b204e9800998ecf8427e', '2.png', 'Nam', '95 Dương Quảng Hàm, Gò Vấp', b'1', '0'),
(35, '', 'hoang02@gmail.com', 'Hoàng', 'a2ef406e2c2351e0b9e80029c909242d', '3.png', '', '', b'1', '0'),
(42, '', '12@gmail.com', '12', '069e95ae6372b9e084b889f3c4a245cb', 'man-user.png', '', '', b'0', '1'),
(46, '', 'tuanhiep231@gmail.com', 'Tuấn Hiệp', '069e95ae6372b9e084b889f3c4a245cb', 'man-user.png', '', '', b'1', 'Hoạt động'),
(48, '0946601833', 'hau2803nch@gmail.com', 'hau', 'd41d8cd98f00b204e9800998ecf8427e', 'dahyun.jpg', 'Nam', 'GV', b'0', 'Hoạt động'),
(49, '', 'tuhao011@gmail.com', 'Hào', 'fd4f1f3f07be2691425cc00c1f6de7d4', 'man-user.png', '', '', b'0', 'Hoạt động'),
(50, '', 'bomkilogam@gmail.com', 'Thiện', '069e95ae6372b9e084b889f3c4a245cb', 'man-user.png', '', '', b'0', 'Hoạt động');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_address_id` (`client`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`name`),
  ADD KEY `FK_category_salePromotion` (`salePromotion`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orderItem_orders` (`orders`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orders_promotion` (`promotion`),
  ADD KEY `FK_orders_user` (`user`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_salePromotion` (`salePromotion`),
  ADD KEY `FK_product_category` (`category`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_address_id` FOREIGN KEY (`client`) REFERENCES `users` (`id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_category_salePromotion` FOREIGN KEY (`salePromotion`) REFERENCES `promotion` (`id`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `FK_orderItem_orders` FOREIGN KEY (`orders`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_promotion` FOREIGN KEY (`promotion`) REFERENCES `promotion` (`id`),
  ADD CONSTRAINT `FK_orders_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category`) REFERENCES `category` (`name`),
  ADD CONSTRAINT `FK_product_salePromotion` FOREIGN KEY (`salePromotion`) REFERENCES `promotion` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
