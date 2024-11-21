<?php
// Kết nối cơ sở dữ liệu
require_once('../../model/db.php'); // Thêm đúng đường dẫn đến file db.php

// Lấy kết nối từ Database Singleton
$db = Database::getInstance();
$conn = $db->getConnection();

// Khởi tạo biến thông báo lỗi và thành công
$error = "";
$success = "";

// Kiểm tra nếu người dùng đã gửi form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_dichvu = $_POST['ten_dichvu'];
    $gia = $_POST['gia'];

    // Kiểm tra dữ liệu đầu vào
    if (empty($ten_dichvu) || empty($gia)) {
        $error = "Vui lòng nhập đầy đủ thông tin dịch vụ!";
    } else {
        // Chuẩn bị câu lệnh INSERT
        $sql = "INSERT INTO dichvu (ten_dichvu, gia) VALUES (?, ?)";

        // Sử dụng prepared statement để bảo vệ khỏi SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sd", $ten_dichvu, $gia);

        // Thực thi câu lệnh và kiểm tra kết quả
        if ($stmt->execute()) {
            $success = "Dịch vụ đã được thêm thành công!";
        } else {
            $error = "Đã có lỗi xảy ra khi thêm dịch vụ.";
        }

        // Đóng câu lệnh prepared
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style.css">
    <title>Thêm Dịch Vụ</title>
    <link href="../img/icons8-spa-flower-96.png" rel="icon">
</head>
<style>
    /* Form Heading */
    form h2 {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
    }

    /* Add Group for Form Fields */
    .add-group,
    .price-group {
        margin-bottom: 20px;
    }

    /* Label Styling */
    .add-group label,
    .price-group label {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }

    /* Input Field Styling */
    .form-control {
        width: 100%;
        padding: 12px 15px;
        font-size: 16px;
        color: #333;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-sizing: border-box;
        /* To make sure padding is included in width */
        transition: all 0.3s ease;
    }

    /* Focused Input Field Styling */
    .form-control:focus {
        border-color: #4CAF50;
        outline: none;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
    }

    /* Button Styling */
    .btn {
        width: 100%;
        padding: 15px;
        background-color: #4CAF50;
        color: white;
        font-size: 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-transform: uppercase;
        transition: background-color 0.3s ease;
    }

    /* Button Hover Effect */
    .btn:hover {
        background-color: #45a049;
    }

    /* Button Active State */
    .btn:active {
        background-color: #388e3c;
    }

    /* Placeholder Styling */
    .form-control::placeholder {
        color: #aaa;
        font-style: italic;
    }

    /* Error / Success Messages */
    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-top: 15px;
        text-align: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Style for the price input group */
    .input-group {
        position: relative;
    }

    .input-group-addon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #4CAF50;
    }

    .form-control {
        padding-left: 35px;
        /* Space for the currency symbol */
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
    }
</style>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand"><i class='bx bxs-smile icon'></i> AdminSite</a>
        <ul class="side-menu">
            <li><a href="../index.php" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="./service.php"><i class='bx bxs-inbox icon'></i> Trở về </i></a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>


            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php elseif ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form action="add_service.php" method="POST">
                <h2>Thêm Dịch Vụ</h2>

                <div class="add-group">
                    <label for="ten_dichvu">Tên Dịch Vụ</label>
                    <input type="text" name="ten_dichvu" id="ten_dichvu" class="form-control" placeholder="Nhập tên dịch vụ" required>
                </div>

                <div class="price-group">
                    <label for="gia">Giá Dịch Vụ</label>
                    <div class="input-group">
                        <span class="input-group-addon">₫</span>
                        <input type="number" name="gia" id="gia" class="form-control" placeholder="Nhập giá dịch vụ" step="0.01" required min="0">
                    </div>
                </div>

                <button type="submit" class="btn">Thêm Dịch Vụ</button>
            </form>


        </main>
        <!-- MAIN -->
    </section>
    <!-- NAVBAR -->

    <script src="../script.js"></script>
</body>

</html>