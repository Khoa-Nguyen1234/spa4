<?php
// Kết nối cơ sở dữ liệu
require_once('../../model/db.php');

// Lấy kết nối từ Database Singleton
$db = Database::getInstance();
$conn = $db->getConnection();

// Lấy ID banner từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy thông tin banner từ cơ sở dữ liệu
$sql = "SELECT * FROM banners WHERE id_banner = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$banner = $result->fetch_assoc();

if (!$banner) {
    die("Banner không tồn tại.");
}

// Xử lý khi biểu mẫu được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $status = $_POST['status'];

    // Xử lý hình ảnh
    $imagePath = $banner['image_path'];
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../../Admin/img/banner/";
        $fileName = uniqid() . "-" . basename($_FILES["image"]["name"]); // Tạo tên file độc nhất
        $targetFilePath = $targetDir . $fileName;

        // Kiểm tra và tải lên file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Xóa hình ảnh cũ nếu tồn tại
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $imagePath = $targetFilePath;
        } else {
            echo "<script>alert('Lỗi khi tải lên hình ảnh mới! Vui lòng kiểm tra quyền thư mục.');</script>";
        }
    }


    // Cập nhật thông tin
    $sqlUpdate = "UPDATE banners SET title = ?, status = ?, image_path = ? WHERE id_banner = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("sssi", $title, $status, $imagePath, $id);

    if ($stmtUpdate->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='banner.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi cập nhật!');</script>";
    }
    $stmtUpdate->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Banner</title>
    <link href="../img/icons8-spa-flower-96.png" rel="icon">
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .current-img {
            display: block;
            margin-bottom: 15px;
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Sửa Banner</h1>
        <a href="banner.php" class="back-link">&larr; Quay lại danh sách</a>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="title">Tiêu đề:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($banner['title']) ?>" required>

            <label for="status">Trạng thái:</label>
            <select id="status" name="status">
                <option value="active" <?= $banner['status'] === 'active' ? 'selected' : '' ?>>Kích hoạt</option>
                <option value="inactive" <?= $banner['status'] === 'inactive' ? 'selected' : '' ?>>Không kích hoạt</option>
            </select>

            <label for="image">Hình ảnh hiện tại:</label>
            <img src="<?= htmlspecialchars($banner['image_path']) ?>" alt="Current Image" class="current-img">

            <label for="image">Chọn hình ảnh mới (nếu cần):</label>
            <input type="file" id="image" name="image" accept="image/*">

            <button type="submit">Lưu thay đổi</button>
        </form>
    </div>
</body>

</html>