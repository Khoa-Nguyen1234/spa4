<?php
// Include database connection
require_once('../../model/db.php');

// Get the service ID from the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_dichvu = $_GET['id'];

    // Fetch the service details from the database
    $db = Database::getInstance();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM dichvu WHERE id_dichvu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_dichvu);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the service exists
    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
    } else {
        echo "Dịch vụ không tồn tại.";
        exit;
    }
} else {
    echo "Invalid service ID.";
    exit;
}

// Handle form submission to update the service
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_dichvu = $_POST['ten_dichvu'];
    $gia = $_POST['gia'];

    $sql = "UPDATE dichvu SET ten_dichvu = ?, gia = ? WHERE id_dichvu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $ten_dichvu, $gia, $id_dichvu);

    if ($stmt->execute()) {
        header("Location: service.php?message=Cập nhật thành công!");
        exit;
    } else {
        echo "Có lỗi xảy ra khi cập nhật dịch vụ.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Sửa Dịch Vụ</title>
    <link href="../img/icons8-spa-flower-96.png" rel="icon">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Sửa Dịch Vụ</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="ten_dichvu">Tên Dịch Vụ</label>
                <input type="text" name="ten_dichvu" id="ten_dichvu" value="<?php echo htmlspecialchars($service['ten_dichvu']); ?>" required>
            </div>

            <div class="form-group">
                <label for="gia">Giá</label>
                <input type="number" name="gia" id="gia"
                    value="<?php echo rtrim(rtrim($service['gia'], '0'), '.'); ?>" step="0.01" required>

            </div>

            <button type="submit" class="btn">Cập Nhật</button>
        </form>
    </div>
</body>

</html>