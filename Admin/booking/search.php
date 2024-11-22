<?php
require_once('../../model/db.php');

$db = Database::getInstance();
$conn = $db->getConnection();

$query = isset($_GET['query']) ? $_GET['query'] : '';
$search_like = '%' . $query . '%';

$stmt = $conn->prepare("SELECT id, ho_va_ten, so_dien_thoai FROM phieu_dat WHERE ho_va_ten LIKE ? OR so_dien_thoai LIKE ?");
$stmt->bind_param('ss', $search_like, $search_like);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
