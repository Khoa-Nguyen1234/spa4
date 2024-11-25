-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 22, 2024 lúc 05:41 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `spa4`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Khoa', 'Khoa@gmail.com', '123', '2024-11-22 03:45:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id_banner` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id_banner`, `title`, `image_path`, `status`, `created_at`) VALUES
(7, 'banner1', 'banner1.png', 'active', '2024-11-20 06:00:25'),
(10, 'banner2', 'banner2.png', 'active', '2024-11-20 18:04:23'),
(13, 'banner3', 'banner3.png', 'active', '2024-11-20 18:06:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_images`
--

CREATE TABLE `customer_images` (
  `id_customer_images` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dichvu`
--

CREATE TABLE `dichvu` (
  `id_dichvu` int(11) NOT NULL,
  `ten_dichvu` varchar(255) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dichvu`
--

INSERT INTO `dichvu` (`id_dichvu`, `ten_dichvu`, `gia`, `image_path`) VALUES
(1, 'Xóa nốt ruồi mụn thịt', '39000.00', 'service1.png'),
(2, 'Triệt lông super nano light', '79000.00', 'service2.png'),
(3, 'Trẻ hóa thâm nách', '399000.00', 'service3.png'),
(4, 'Chăm sóc da kim cương', '199000.00', 'service4.png'),
(5, 'Chăm sóc da mụn chuẩn y khoa', '349000.00', 'service5.png'),
(6, 'Ủ trắng nano face', '399000.00', 'service6.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieu_dat`
--

CREATE TABLE `phieu_dat` (
  `id` int(11) NOT NULL,
  `id_dichvu` int(11) NOT NULL,
  `ten_dichvu` varchar(255) NOT NULL,
  `ho_va_ten` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(15) NOT NULL,
  `thoi_gian_dat` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phieu_dat`
--

INSERT INTO `phieu_dat` (`id`, `id_dichvu`, `ten_dichvu`, `ho_va_ten`, `so_dien_thoai`, `thoi_gian_dat`) VALUES
(1, 1, 'Xóa nốt ruồi mụn thịt', 'Khoa', '0903145032', '2024-11-22 09:40:53'),
(2, 3, 'Trẻ hóa thâm nách', 'Đạt', '0914265890', '2024-11-22 09:41:22'),
(3, 3, 'Trẻ hóa thâm nách', 'Đạt', '0835444761', '2024-11-22 09:43:29'),
(4, 4, 'Chăm sóc da kim cương', 'Hoàng', '0903145032', '2024-11-22 09:43:44'),
(5, 4, 'Chăm sóc da kim cương', 'Hoàng', '0909444143', '2024-11-22 10:16:45'),
(6, 6, 'Ủ trắng nano face', 'Hiệp', '0358293198', '2024-11-22 17:30:57'),
(7, 5, 'Chăm sóc da mụn chuẩn y khoa', 'Hùng', '0909444143', '2024-11-22 17:31:14'),
(8, 4, 'Chăm sóc da kim cương', 'Thanh', '0792515165', '2024-11-22 17:32:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services_view`
--

CREATE TABLE `services_view` (
  `id_service` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `services_view`
--

INSERT INTO `services_view` (`id_service`, `service_name`) VALUES
(1, 'Cắt mí'),
(2, 'Chăm sóc da'),
(3, 'Phun mày'),
(4, 'Phun môi');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id_banner`);

--
-- Chỉ mục cho bảng `customer_images`
--
ALTER TABLE `customer_images`
  ADD PRIMARY KEY (`id_customer_images`),
  ADD KEY `service_id` (`service_id`);

--
-- Chỉ mục cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  ADD PRIMARY KEY (`id_dichvu`);

--
-- Chỉ mục cho bảng `phieu_dat`
--
ALTER TABLE `phieu_dat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dichvu` (`id_dichvu`);

--
-- Chỉ mục cho bảng `services_view`
--
ALTER TABLE `services_view`
  ADD PRIMARY KEY (`id_service`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `customer_images`
--
ALTER TABLE `customer_images`
  MODIFY `id_customer_images` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dichvu`
--
ALTER TABLE `dichvu`
  MODIFY `id_dichvu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `phieu_dat`
--
ALTER TABLE `phieu_dat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `services_view`
--
ALTER TABLE `services_view`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `customer_images`
--
ALTER TABLE `customer_images`
  ADD CONSTRAINT `customer_images_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services_view` (`id_service`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phieu_dat`
--
ALTER TABLE `phieu_dat`
  ADD CONSTRAINT `phieu_dat_ibfk_1` FOREIGN KEY (`id_dichvu`) REFERENCES `dichvu` (`id_dichvu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
