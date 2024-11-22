<?php
// Include the database connection class
require_once('../../model/db.php');

// Get the database connection instance
$db = Database::getInstance();
$conn = $db->getConnection();

// Define the number of records per page
$records_per_page = 10;

// Get the current page number from the URL, default is page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search_term = isset($_GET['search']) ? $_GET['search'] : '';

// Calculate the offset for the SQL query
$offset = ($page - 1) * $records_per_page;

// Fetch data from the 'phieu_dat' table with LIMIT and OFFSET based on search term
$query = "SELECT * FROM phieu_dat WHERE ho_va_ten LIKE ? OR so_dien_thoai LIKE ? LIMIT $records_per_page OFFSET $offset";
$stmt = $conn->prepare($query);
$search_like = '%' . $search_term . '%';
$stmt->bind_param('ss', $search_like, $search_like);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all data (without pagination) for the search
$query_all = "SELECT * FROM phieu_dat WHERE ho_va_ten LIKE ? OR so_dien_thoai LIKE ?";
$stmt_all = $conn->prepare($query_all);
$stmt_all->bind_param('ss', $search_like, $search_like);
$stmt_all->execute();
$result_all = $stmt_all->get_result();

// Get the total number of records to calculate the number of pages
$total_records_query = "SELECT COUNT(*) as total FROM phieu_dat WHERE ho_va_ten LIKE ? OR so_dien_thoai LIKE ?";
$stmt_count = $conn->prepare($total_records_query);
$stmt_count->bind_param('ss', $search_like, $search_like);
$stmt_count->execute();
$total_records_result = $stmt_count->get_result();
$total_records = $total_records_result->fetch_assoc()['total'];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style.css">
    <title>AdminSite</title>
    <link href="./img/icons8-spa-flower-96.png" rel="icon">
    <style>
        /* Main Table Styles */
        table.table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        table.table th,
        table.table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table.table th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 16px;
        }

        table.table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table.table tr:hover {
            background-color: #f1f1f1;
        }

        table.table td {
            font-size: 14px;
        }

        table.table td[colspan="5"] {
            text-align: center;
            font-style: italic;
            color: #999;
        }

        /* Highlight searched rows */
        tr[data-id] {
            transition: border 0.3s ease;
        }

        tr[data-id]:hover {
            background-color: #f1f1f1;
        }

        .highlight {
            background-color: #a0c4c7 !important;
            border: 2px solid red !important;
        }

        /* Heading Styles */
        h1 {
            font-size: 24px;
            color: #333;
            font-weight: 600;
            margin-bottom: 20px;
            font-family: 'Roboto', sans-serif;
        }

        /* Search Input Styling */
        .form-group input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        /* Dropdown menu */
        .dropdown-results {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            background-color: #fff;
            position: absolute;
            width: 100%;
            z-index: 1000;
            display: none;
        }

        .dropdown-results a {
            padding: 8px;
            display: block;
            color: #333;
            text-decoration: none;
        }

        .dropdown-results a:hover {
            background-color: #f1f1f1;
        }

        /* Pagination Styling */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px;
            margin: 0 5px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #f1f1f1;
        }

        .pagination .active {
            background-color: #4CAF50;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            table.table th,
            table.table td {
                padding: 10px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand"><i class='bx bxs-smile icon'></i> AdminSite</a>
        <ul class="side-menu">
            <li><a href="../index.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="./booking.php" class="active"><i class='bx bxs-inbox icon'></i> Phiếu đặt lịch </a>
            </li>
            <li><a href="../service/service.php"><i class='bx bxs-chart icon'></i> Quản lý dịch vụ</a></li>
            <li><a href="../banner/banner.php"><i class='bx bxs-widget icon'></i>Banner</a></li>
            <li class="divider" data-text="table and forms">Table and forms</li>
            <li><a href="../customer/customer.php"><i class='bx bx-table icon'></i> Khách hàng</a></li>
            <li>
                <a href="#"><i class='bx bxs-notepad icon'></i> Khu vực </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="" method="GET" id = "search-form">
                <div class="form-group">
                    <input
                        type="text"
                        name="search"
                        id="search"
                        placeholder="Tìm kiếm họ tên và số điện thoại"
                        oninput="searchCustomer()"
                        autocomplete="off">
                    <i class='bx bx-search icon'></i>
                </div>
                <div id="searchResults" class="dropdown-results"></div>
            </form>

        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <h1>Danh Sách Phiếu Đặt Lịch</h1>

            <!-- Table to display data -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dịch Vụ</th>
                        <th>Họ và Tên</th>
                        <th>Số Điện Thoại</th>
                        <th>Thời Gian Đặt</th>
                    </tr>
                </thead>
                <tbody id="customerData">
                    <?php
                    // Check if any records are available
                    if ($result->num_rows > 0) {
                        // Output each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr data-id="' . $row['id'] . '">';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['ten_dichvu'] . '</td>';
                            echo '<td>' . $row['ho_va_ten'] . '</td>';
                            echo '<td>' . $row['so_dien_thoai'] . '</td>';
                            echo '<td>' . $row['thoi_gian_dat'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">No records found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                <?php
                // Display pagination links
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active_class = $i == $page ? 'active' : '';
                    echo '<a href="?page=' . $i . '&search=' . urlencode($search_term) . '" class="' . $active_class . '">' . $i . '</a>';
                }
                ?>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script>
        function searchCustomer() {
            let inputElement = document.getElementById("search");
            let input = inputElement.value;
            let resultsDiv = document.getElementById("searchResults");
            const form = document.getElementById('search-form');

            // Hiển thị dropdown nếu nhập ít nhất 1 ký tự
            if (input.length > 0) {
                resultsDiv.style.display = 'block';

                // Thực hiện AJAX request để lấy dữ liệu từ server
                fetch('search.php?query=' + input)
                    .then(response => response.json())
                    .then(data => {
                        resultsDiv.innerHTML = ''; // Xóa kết quả cũ
                        if (data.length > 0) {
                            data.forEach(item => {
                                let a = document.createElement('a');
                                a.href = "#";
                                a.textContent = `${item.ho_va_ten} - ${item.so_dien_thoai}`;
                                a.onclick = function(e) {
                                    //e.preventDefault(); // Ngăn chặn hành vi mặc định
                                    inputElement.value = item.so_dien_thoai;
                                    form.submit();
                                    highlightAndScroll(item.id); // Highlight và scroll đến dòng
                                    resultsDiv.style.display = 'none'; // Ẩn dropdown
                                };
                                resultsDiv.appendChild(a);
                            });
                        } else {
                            resultsDiv.innerHTML = '<a>Không tìm thấy dữ liệu</a>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        resultsDiv.innerHTML = '<a>Lỗi tải dữ liệu</a>';
                    });
            } else {
                resultsDiv.style.display = 'none'; // Ẩn dropdown nếu không nhập
            }
        }

        function highlightAndScroll(id) {
            // Lấy tất cả các hàng trong bảng
            let rows = document.querySelectorAll('tr[data-id]');

            rows.forEach(row => {
                // Xóa các highlight trước đó
                row.classList.remove('highlight');
                row.style.border = 'none';
                if (row.dataset.id == id) {
                    // Thêm highlight và viền đỏ cho dòng được chọn
                    row.classList.add('highlight');
                    row.style.border = '2px solid red';

                    // Scroll tới dòng được chọn
                    row.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });
        }
    </script>
</body>

</html>