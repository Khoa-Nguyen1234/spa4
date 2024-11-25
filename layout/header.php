<style>
    .btn-price-table {
        background-image: linear-gradient(90deg, rgb(213, 128, 1), rgb(246, 182, 57));
        border: none;
        padding: 10px 40px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        transition: background 0.3s;
        border-radius: 35px;
    }

    .btn-price-table:hover {
        background-image: linear-gradient(90deg, rgb(246, 182, 57), rgb(213, 128, 1));
    }

    .form-container {
        max-width: 400px;
        margin: 20px auto;
        padding: 30px;
        background: linear-gradient(135deg, #ffffff, #f8f8f8);
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        display: none;
        /* Ẩn form mặc định */
    }

    .form-title {
        text-align: center;
        color: #B38B4B;
        margin-bottom: 25px;
        font-size: 24px;
        font-weight: bold;
        line-height: 1.4;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #D4AA6C;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #B38B4B;
        box-shadow: 0 0 0 2px rgba(179, 139, 75, 0.2);
    }

    .submit-btn {
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(120deg, rgb(212, 170, 108), rgb(179, 139, 75));
        color: white;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }

    .submit-btn:hover {
        opacity: 0.9;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23B38B4B' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 40px;
    }

    .success-message {
        padding: 15px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 18px;
    }
</style>
<?php
// Include the database connection class
require_once('./model/db.php');

// Get the database connection instance
$db = Database::getInstance();
$conn = $db->getConnection();

// Initialize success message
$successMessage = "";

// Process form submission (if any)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $ho_va_ten = $_POST['ho_va_ten'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $dich_vu_id = $_POST['dich_vu_id'];

    // Insert the data into the 'phieu_dat' table
    $stmt = $conn->prepare("INSERT INTO phieu_dat (id_dichvu, ten_dichvu, ho_va_ten, so_dien_thoai) 
                            VALUES (?, (SELECT ten_dichvu FROM dichvu WHERE id_dichvu = ?), ?, ?)");
    $stmt->bind_param("isss", $dich_vu_id, $dich_vu_id, $ho_va_ten, $so_dien_thoai);

    if ($stmt->execute()) {
        // Set success message
        $successMessage = "Lịch hẹn đã được gửi thành công!";
    } else {
        $successMessage = "Có lỗi xảy ra, vui lòng thử lại!";
    }
}

// Fetch services from the database
$result = $conn->query("SELECT * FROM dichvu");
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tư vấn ngay</title>
    <link rel="stylesheet" href="path_to_your_stylesheet.css"> <!-- Replace with your CSS path -->
</head>

<body>
    <!-- Header -->
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
            <img src="./assets/img/logo-size-big.png" width="300px" alt="">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#footer" class="active">Ưu đãi</a></li>
                    <li><a href="#services">Dịch vụ</a></li>
                    <li><a href="#customer">Khách hàng</a></li>
                    <!-- <li><a href="#portfolio">Địa chỉ gần nhất</a></li> -->
                    <li><a href="#team">Đội ngũ bác sĩ</a></li>
                    <button id="BUTTON6198" class="btn-price-table" onclick="toggleForm()">Nhận tư vấn ngay!</button>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <!-- Success Message -->
    <?php if ($successMessage): ?>
        <div id="success-message" class="success-message">
            <?php echo $successMessage; ?>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 2000); // Hide after 2 seconds
        </script>
    <?php endif; ?>

    <!-- Form Đặt Lịch -->
    <div id="form-container" class="form-container">
        <form action="" method="POST">
            <div class="form-title">Đăng ký nhận tư vấn</div>

            <div class="form-group">
                <input type="text" class="form-control" name="ho_va_ten" placeholder="Họ và tên" required>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control" name="so_dien_thoai" placeholder="Số điện thoại" pattern="(\+84|0){1}(9|8|7|5|3){1}[0-9]{8}" required>
            </div>

            <div class="form-group">
                <select class="form-control" name="dich_vu_id" id="dich_vu_id" required>
                    <option value="" disabled selected>Chọn dịch vụ</option>
                    <?php
                    // Display services in the select dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id_dichvu'] . '">' . $row['ten_dichvu'] . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled>Không có dịch vụ</option>';
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="submit-btn">GỬI NGAY</button>
        </form>
    </div>

    <!-- JavaScript to toggle the form visibility -->
    <script>
        function toggleForm() {
            var form = document.getElementById('form-container');
            form.style.display = form.style.display === 'block' ? 'none' : 'block';
          // Cuộn về đầu trang với hiệu ứng mượt
          window.scrollTo({
            top: 0,
            behavior: 'smooth'
            });
        }
    </script>

</body>

</html>