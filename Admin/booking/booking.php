<?php
// Include the database connection class
require_once('../../model/db.php');

// Get the database connection instance
$db = Database::getInstance();
$conn = $db->getConnection();

// Fetch data from the 'phieu_dat' table
$query = "SELECT * FROM phieu_dat";
$result = $conn->query($query);
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

        /* Highlight searched rows */
        .highlight {
            background-color: red !important;
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
            <li><a href="../index.php" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class='bx bxs-inbox icon'></i> Phiếu đặt lịch </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="search" id="search" placeholder="Search by customer name..." oninput="searchCustomer()" autocomplete="off">
                    <i class='bx bx-search icon'></i>
                </div>
                <div id="searchResults" class="dropdown-results" style="display:none;"></div>
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
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['ten_dichvu'] . '</td>';
                            echo '<td>' . $row['ho_va_ten'] . '</td>';
                            echo '<td>' . $row['so_dien_thoai'] . '</td>';
                            echo '<td>' . $row['thoi_gian_dat'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5">Không có dữ liệu</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </main>
        <!-- MAIN -->
    </section>
    <!-- NAVBAR -->

    <script>
        function searchCustomer() {
            let input = document.getElementById('search').value.toLowerCase();
            let rows = document.querySelectorAll('#customerData tr');
            let found = false;

            // If the input is empty, reset all rows and hide search results
            if (input === '') {
                rows.forEach(function(row) {
                    row.classList.remove('highlight');
                });
                document.getElementById('searchResults').style.display = 'none';
                return;
            }

            // Search and highlight matching rows
            rows.forEach(function(row) {
                let name = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (name.indexOf(input) > -1) {
                    row.classList.add('highlight');
                    row.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    found = true;
                } else {
                    row.classList.remove('highlight');
                }
            });

            // Display search results dynamically
            let searchResults = document.getElementById('searchResults');
            searchResults.innerHTML = '';
            if (input.length > 0) {
                rows.forEach(function(row) {
                    let name = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    if (name.indexOf(input) > -1) {
                        let resultItem = document.createElement('a');
                        resultItem.textContent = row.querySelector('td:nth-child(3)').textContent;
                        resultItem.onclick = function() {
                            row.classList.add('highlight');
                            row.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        };
                        searchResults.appendChild(resultItem);
                    }
                });
                searchResults.style.display = found ? 'block' : 'none';
            } else {
                searchResults.style.display = 'none';
            }
        }
    </script>

</body>

</html>