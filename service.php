<?php
// Kết nối cơ sở dữ liệu
require_once('./model/db.php'); // Thêm đúng đường dẫn đến file db.php

// Lấy kết nối từ Database Singleton
$db = Database::getInstance();
$conn = $db->getConnection();

// Truy vấn dữ liệu từ bảng 'dichvu'
$sql = "SELECT * FROM dichvu";
$result = $conn->query($sql);
?>

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Dịch vụ bạn đang quan tâm</h2>
</div><!-- End Section Title -->

<div class="container">

    <div class="row gy-4">
        <?php
        if ($result->num_rows > 0) {
            // Duyệt qua kết quả và hiển thị từng dịch vụ
            $delay = 100;
            while ($row = $result->fetch_assoc()) {
                // Hiển thị dịch vụ với hình ảnh
                echo '<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="' . $delay . '">';
                echo '<div class="service-item position-relative">';
                echo '<img src="./Admin/img/service/' . htmlspecialchars($row['image_path']) . '" width="100%">';
                echo '</div>';
                echo '</div>';
                $delay += 100; // Tăng độ trễ cho từng dịch vụ
            }
        } else {
            echo '<p>Không có dịch vụ nào.</p>';
        }
        ?>
    </div>

</div>

<!-- /Services Section -->