<?php
require_once('../../model/db.php'); // Đảm bảo đường dẫn đúng đến tệp db.php

// Kiểm tra nếu có `id` được truyền vào URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy kết nối từ Database Singleton
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Truy vấn để lấy đường dẫn hình ảnh
    $sql = "SELECT image_path FROM dichvu WHERE id_dichvu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = "../img/service/" . $row['image_path']; // Đường dẫn đầy đủ

        // Xóa dịch vụ khỏi cơ sở dữ liệu
        $delete_sql = "DELETE FROM dichvu WHERE id_dichvu = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $id);

        if ($delete_stmt->execute()) {
            // Xóa hình ảnh nếu tồn tại
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            echo "<script>alert('Xóa dịch vụ thành công!'); window.location.href='service.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi xóa dịch vụ!'); window.location.href='service.php';</script>";
        }
    } else {
        echo "<script>alert('Không tìm thấy dịch vụ!'); window.location.href='service.php';</script>";
    }
} else {
    echo "<script>alert('ID dịch vụ không hợp lệ!'); window.location.href='service.php';</script>";
}
