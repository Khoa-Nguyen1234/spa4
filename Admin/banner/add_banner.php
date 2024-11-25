<?php
// Kết nối cơ sở dữ liệu
require_once('../../model/db.php');

// Xử lý khi biểu mẫu được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $status = $_POST['status'];

    // Đường dẫn lưu file
    $targetDir = "../../Admin/img/banner/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Tạo thư mục nếu chưa tồn tại
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0775, true);
    }

    // Kiểm tra lỗi tải file
    if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        die("Lỗi tải file: " . $_FILES["image"]["error"]);
    }

    // Kiểm tra kích thước file
    if ($_FILES["image"]["size"] > 2000000) { // 2MB
        die("File quá lớn! Vui lòng chọn file nhỏ hơn 2MB.");
    }

    // Kiểm tra và di chuyển file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        // Kết nối cơ sở dữ liệu
        $db = Database::getInstance();
        $conn = $db->getConnection();

        // Lưu thông tin vào cơ sở dữ liệu
        $sql = "INSERT INTO banners (image_path, title, status, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $fileName, $title, $status);

        if ($stmt->execute()) {
            echo "<script>alert('Banner đã được thêm thành công!'); window.location.href='banner.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi thêm banner vào cơ sở dữ liệu!');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Không thể tải file lên. Vui lòng kiểm tra quyền thư mục!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Banner</title>
    <link href="../img/icons8-spa-flower-96.png" rel="icon">
    <link rel="stylesheet" href="../style.css">
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Thêm Banner</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="title">Tiêu đề:</label>
            <input type="text" id="title" name="title" required>

            <label for="status">Trạng thái:</label>
            <select id="status" name="status">
                <option value="active">Kích hoạt</option>
                <option value="inactive">Không kích hoạt</option>
            </select>

            <label for="image">Hình ảnh:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit">Thêm Banner</button>
        </form>
    </div>
</body>

</html>