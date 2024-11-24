<?php
require_once('../../model/db.php');

// Lấy ID dịch vụ từ URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID dịch vụ không hợp lệ!'); window.location.href='service.php';</script>";
    exit;
}
$id = $_GET['id'];

// Kết nối cơ sở dữ liệu
$db = Database::getInstance();
$conn = $db->getConnection();

// Lấy thông tin dịch vụ hiện tại
$sql = "SELECT ten_dichvu, gia, image_path FROM dichvu WHERE id_dichvu = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Không tìm thấy dịch vụ!'); window.location.href='service.php';</script>";
    exit;
}
$service = $result->fetch_assoc();

// Xử lý form cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_dichvu = $_POST['ten_dichvu'];
    $gia = $_POST['gia'];
    $new_image = $_FILES['image'];

    // Đường dẫn thư mục lưu ảnh
    $target_dir = "../img/service/";
    $new_image_path = $service['image_path']; // Giữ nguyên ảnh cũ nếu không tải lên ảnh mới

    // Kiểm tra và xử lý nếu có ảnh mới
    if ($new_image['tmp_name']) {
        $new_image_name = basename($new_image['name']);
        $target_file = $target_dir . $new_image_name;

        // Tải lên ảnh mới
        if (move_uploaded_file($new_image['tmp_name'], $target_file)) {
            // Xóa ảnh cũ nếu tồn tại
            $old_image_path = $target_dir . $service['image_path'];
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
            $new_image_path = $new_image_name;
        } else {
            echo "<script>alert('Không thể tải lên ảnh mới!');</script>";
        }
    }

    // Cập nhật cơ sở dữ liệu
    $update_sql = "UPDATE dichvu SET ten_dichvu = ?, gia = ?, image_path = ? WHERE id_dichvu = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sisi", $ten_dichvu, $gia, $new_image_path, $id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Cập nhật dịch vụ thành công!'); window.location.href='service.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật dịch vụ!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa dịch vụ</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Căn chỉnh body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Kiểu cho container chính */
        form {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        /* Kiểu cho các tiêu đề */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        /* Kiểu cho nhãn */
        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        /* Kiểu cho các input */
        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Kiểu cho nút thêm */
        form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
        }

        /* Nút quay về */
        .return-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .return-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <a href="service.php" class="return-button">Quay về</a>
    <h1>Chỉnh sửa dịch vụ</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="ten_dichvu">Tên dịch vụ:</label>
            <input type="text" id="ten_dichvu" name="ten_dichvu" value="<?= htmlspecialchars($service['ten_dichvu']) ?>" required>
        </div>
        <div>
            <label for="gia">Giá:</label>
            <input type="number" id="gia" name="gia" value="<?= htmlspecialchars($service['gia']) ?>" required>
        </div>
        <div>
            <label for="image">Hình ảnh hiện tại:</label>
            <img src="../img/service/<?= htmlspecialchars($service['image_path']) ?>" alt="Hình ảnh dịch vụ" style="max-width: 100%; height: auto; margin-bottom: 10px;">
        </div>
        <div>
            <label for="image">Chọn hình ảnh mới (nếu có):</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        <button type="submit">Cập nhật</button>
    </form>
</body>

</html>