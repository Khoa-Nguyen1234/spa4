<?php
// Include database connection
include_once '../model/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_email = $_POST['new_email'];
    $phone_number = trim($_POST['phone_number']);

    // Validate inputs
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[0-9]{10}$/', $phone_number)) {
        try {
            $db = Database::getInstance()->getConnection();

            // Insert into database
            $stmt = $db->prepare("INSERT INTO voucher_requests (email, phone_number) VALUES (?, ?)");
            $stmt->execute([$email, $phone_number]);

            // Provide feedback
            echo "<script>alert('Đăng ký thành công! Voucher của bạn sẽ được gửi sớm.'); window.location.href='../view/home.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Có lỗi xảy ra, vui lòng thử lại.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.'); window.history.back();</script>";
    }
} else {
    header("Location: ../view/home.php");
    exit();
}
