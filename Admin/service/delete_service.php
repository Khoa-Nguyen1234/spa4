<?php
// Kết nối cơ sở dữ liệu
require_once('../../model/db.php');

// Kiểm tra xem `id` có được truyền qua URL không
if (isset($_GET['id'])) {
    // Lấy `id` từ URL và chuyển thành kiểu số nguyên
    $id_dichvu = intval($_GET['id']);

    // Lấy kết nối từ Database Singleton
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Kiểm tra xem dịch vụ có tồn tại không
    $check_sql = "SELECT * FROM dichvu WHERE id_dichvu = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param('i', $id_dichvu);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Nếu dịch vụ tồn tại, thực hiện xóa
        $delete_sql = "DELETE FROM dichvu WHERE id_dichvu = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        $stmt_delete->bind_param('i', $id_dichvu);

        if ($stmt_delete->execute()) {
            // Xóa thành công
            header("Location: service.php?message=delete_success");
            exit;
        } else {
            // Lỗi khi xóa
            header("Location: service.php?message=delete_error");
            exit;
        }
    } else {
        // Nếu không tìm thấy dịch vụ
        header("Location: service.php?message=not_found");
        exit;
    }
} else {
    // Không nhận được `id`
    header("Location: service.php?message=invalid_id");
    exit;
}
