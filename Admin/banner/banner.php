<?php
// Kết nối cơ sở dữ liệu
require_once('../../model/db.php');

// Lấy kết nối từ Database Singleton
$db = Database::getInstance();
$conn = $db->getConnection();

// Xử lý xóa banner
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Lấy đường dẫn hình ảnh trước khi xóa
    $sqlSelect = "SELECT image_path FROM banners WHERE id_banner = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("i", $delete_id);
    $stmtSelect->execute();
    $resultSelect = $stmtSelect->get_result();
    $banner = $resultSelect->fetch_assoc();

    if ($banner) {
        // Xóa hình ảnh từ thư mục
        $imagePath = $banner['image_path'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Xóa banner từ cơ sở dữ liệu
        $sqlDelete = "DELETE FROM banners WHERE id_banner = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $delete_id);

        if ($stmtDelete->execute()) {
            echo "<script>alert('Xóa banner và hình ảnh thành công!'); window.location.href='banner.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi xóa banner!');</script>";
        }
        $stmtDelete->close();
    } else {
        echo "<script>alert('Banner không tồn tại!');</script>";
    }

    $stmtSelect->close();
}

// Lấy dữ liệu từ bảng banners
$sql = "SELECT * FROM banners ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Banner</title>
    <link href="../img/icons8-spa-flower-96.png" rel="icon">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1200px;
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

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-add {
            background-color: #4CAF50;
            color: white;
            margin-bottom: 15px;
        }

        .btn-add:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .banner-img {
            width: 300px;
            height: auto;
            border-radius: 5px;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
        }

        .actions a {
            padding: 8px 12px;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-back {
            background-color: #2196F3;
            /* Màu xanh lam */
            color: white;
            margin-bottom: 15px;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #1976D2;
            /* Màu xanh lam đậm hơn */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Quản lý Banner</h1>
        <a href="../index.php" class="btn btn-back">Quay về Trang Chủ</a>
        <a href="./add_banner.php" class="btn btn-add">Thêm Banner</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_banner'] . "</td>";
                        echo "<td><img src='../img/banner/" . htmlspecialchars($row['image_path']) . "' class='banner-img' alt='Banner'></td>";

                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td>" . ucfirst($row['status']) . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td class='actions'>";
                        echo "<a href='edit_banner.php?id=" . $row['id_banner'] . "' class='btn btn-edit'>Sửa</a>";
                        echo "<a href='banner.php?delete_id=" . $row['id_banner'] . "' class='btn btn-delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa banner này không?\")'>Xóa</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Không có banner nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>