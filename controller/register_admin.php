<?php
require_once '../model/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? ''; // Lấy mật khẩu dưới dạng văn bản thuần

    // Kết nối CSDL
    $db = Database::getInstance()->getConnection();

    // Kiểm tra email đã tồn tại
    $stmt = $db->prepare("SELECT COUNT(*) FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Email đã tồn tại
        echo "<script>alert('Email đã được đăng ký! Vui lòng sử dụng email khác.'); window.history.back();</script>";
    } else {
        // Email chưa tồn tại, chèn dữ liệu mới
        $stmt = $db->prepare("INSERT INTO admin (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            // Chuyển hướng về trang login.php
            header("Location: ../admin/Login-Admin.php");
            exit();
        } else {
            echo "Lỗi: " . $stmt->error;
        }

        $stmt->close();
    }
}
