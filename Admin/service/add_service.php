<?php
require_once('../../model/db.php');

// Xử lý form khi người dùng gửi dữ liệu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_dichvu = $_POST['ten_dichvu'];
    $gia = $_POST['gia'];
    $image = $_FILES['image'];

    // Đường dẫn lưu ảnh
    $target_dir = "../img/service/";
    $target_file = $target_dir . basename($image["name"]);
    $upload_ok = 1;

    // Kiểm tra upload ảnh
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        // Kết nối cơ sở dữ liệu
        $db = Database::getInstance();
        $conn = $db->getConnection();

        // Thêm dữ liệu vào bảng 'dichvu'
        $sql = "INSERT INTO dichvu (ten_dichvu, gia, image_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $ten_dichvu, $gia, basename($image["name"]));

        if ($stmt->execute()) {
            echo "<script>alert('Thêm dịch vụ thành công!'); window.location.href='service.php';</script>";
        } else {
            echo "Lỗi khi thêm dịch vụ: " . $conn->error;
        }
    } else {
        echo "<script>alert('Không thể tải lên ảnh!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm dịch vụ</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Cấu hình chung cho body */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container chính */
        .form-container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        /* Tiêu đề trang */
        .form-header {
            text-align: center;
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            text-transform: uppercase;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }

        .form-header::after {
            content: "";
            width: 50px;
            height: 3px;
            background: #3498db;
            display: block;
            margin: 10px auto 0;
        }

        /* Cấu hình cho các nhãn */
        form label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #2c3e50;
            font-size: 0.95rem;
        }

        /* Cấu hình cho các input */
        form input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f8f9fa;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        form input:focus {
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.5);
            outline: none;
        }

        /* Cấu hình cho nút submit */
        form button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 600;
            text-transform: uppercase;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        form button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        /* Cấu hình cho nút quay lại */
        .return-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-weight: 600;
        }

        .return-button:hover {
            background-color: #27ae60;
            transform: scale(1.05);
        }
    </style>


</head>

<body>
    <div class="form-container">
        <a href="service.php" class="return-button">Quay về</a>
        <h1 class="form-header">Thêm dịch vụ mới</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="ten_dichvu">Tên dịch vụ:</label>
                <input type="text" id="ten_dichvu" name="ten_dichvu" required>
            </div>
            <div>
                <label for="gia">Giá:</label>
                <input type="number" id="gia" name="gia" required>
            </div>
            <div>
                <label for="image">Hình ảnh:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit">Thêm</button>
        </form>
    </div>
</body>

</html>