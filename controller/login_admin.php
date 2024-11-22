<?php
require_once '../model/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? ''; // Lấy mật khẩu

    // Kết nối CSDL
    $db = Database::getInstance()->getConnection();

    // Kiểm tra tài khoản tồn tại trong CSDL
    $stmt = $db->prepare("SELECT admin_id, username, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Tìm thấy username, lấy thông tin
        $stmt->bind_result($admin_id, $username_db, $password_db);
        $stmt->fetch();

        // Kiểm tra mật khẩu
        if ($password == $password_db) {
            // Đăng nhập thành công
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['username'] = $username_db;

            // Chuyển hướng đến trang quản trị
            header("Location: ../Admin/index.php");
            exit();
        } else {
            // Mật khẩu sai
            echo "<script>alert('Sai mật khẩu! Vui lòng đăng nhập lại.'); window.history.back();</script>";
        }
    } else {
        // Không tìm thấy username
        echo "<script>alert('Username không tồn tại! Vui lòng đăng nhập lại.'); window.history.back();</script>";
    }

    $stmt->close();
}
