    <?php
    // Kết nối cơ sở dữ liệu
    require_once('../../model/db.php'); // Thêm đúng đường dẫn đến file db.php

    // Lấy kết nối từ Database Singleton
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Truy vấn dữ liệu từ bảng 'dichvu'
    $sql = "SELECT * FROM dichvu";
    $result = $conn->query($sql);
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="../style.css">
        <title>Quản lý dịch vụ</title>
        <link href="../img/icons8-spa-flower-96.png" rel="icon">
    </head>
    <style>
        /* Tạo kiểu cho bảng */
        table {
            width: 100%;
            border-collapse: collapse;
            /* Loại bỏ khoảng cách giữa các ô */
            margin-top: 20px;
            /* Tạo khoảng cách từ trên xuống */
            background-color: #f9f9f9;
            /* Màu nền nhẹ */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Thêm bóng đổ cho bảng */
        }

        /* Tạo kiểu cho các ô tiêu đề */
        thead {
            background-color: #4CAF50;
            /* Màu nền của tiêu đề */
            color: white;
            /* Màu chữ */
            text-align: left;
            /* Canh trái cho các tiêu đề */
            font-weight: bold;
            /* Đậm các tiêu đề */
        }

        /* Tạo kiểu cho các ô dữ liệu */
        td,
        th {
            padding: 10px 15px;
            /* Tạo khoảng cách bên trong các ô */
            text-align: left;
            /* Canh trái */
            border-bottom: 1px solid #ddd;
            /* Đường viền dưới nhẹ */
        }

        /* Thêm hiệu ứng hover cho hàng */
        tbody tr:hover {
            background-color: #e0f7e0;
            /* Màu nền khi hover */
        }

        /* Kiểu cho ô khi không có dữ liệu */
        td[colspan='3'] {
            text-align: center;
            color: #888;
            font-style: italic;
        }


        /* Màu sắc mặc định khi chưa hover */
        .service-link {
            color: #FFFF00;
            /* Màu vàng */
            text-decoration: none;
            /* Loại bỏ gạch chân */
            transition: color 0.3s ease;
            /* Thêm hiệu ứng chuyển màu */
        }

        /* Màu sắc khi hover */
        .service-link:hover {
            color: #339900;
            /* Màu xanh lá */
        }

        /* Đảm bảo rằng icon có sự thay đổi màu sắc khi hover */
        .service-link .icon,
        .service-link .icon-right {
            transition: color 0.3s ease;
        }

        .service-link:hover .icon,
        .service-link:hover .icon-right {
            color: #339900;
            /* Màu của icon khi hover */
        }

        .btn-edit,
        .btn-delete {
            text-decoration: none;
            padding: 8px 12px;
            margin: 0 5px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        /* Edit button styles */
        .btn-edit {
            background-color: #4CAF50;
            /* Green */
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

        /* Delete button styles */
        .btn-delete {
            background-color: #f44336;
            /* Red */
        }

        .btn-delete:hover {
            background-color: #d32f2f;
        }

        .service-image {
            width: 200px;
            height: auto;
            border-radius: 5px;
        }

        /* Highlight matched rows */
        .highlight {
            background-color: red !important;
            color: white;
            transition: background-color 1s ease-out;
        }
    </style>

    <body>

        <!-- SIDEBAR -->
        <section id="sidebar">
            <a href="#" class="brand"><i class='bx bxs-smile icon'></i> AdminSite</a>
            <ul class="side-menu">
                <li><a href="../index.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
                <li class="divider" data-text="main">Main</li>
                <li>
                    <a href="../booking/booking.php"><i class='bx bxs-inbox icon'></i> Phiếu đặt lịch </a>
                </li>
                <li><a href="./service.php" class="active"><i class='bx bxs-chart icon'></i> Quản lý dịch vụ</a></li>
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
            <!-- NAVBAR -->
            <nav>
                <i class='bx bx-menu toggle-sidebar'></i>
                <form id="searchForm" action="#">
                    <div class="form-group">
                        <input type="text" id="searchInput" placeholder="Search service...">
                        <i class='bx bx-search icon'></i>
                    </div>
                </form>
                <a href="#" class="nav-link">
                    <i class='bx bxs-bell icon'></i>
                    <span class="badge">5</span>
                </a>
                <a href="#" class="nav-link">
                    <i class='bx bxs-message-square-dots icon'></i>
                    <span class="badge">8</span>
                </a>
                <span class="divider"></span>
                <div class="profile">
                    <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                    <ul class="profile-link">
                        <li><a href="#"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
                        <li><a href="#"><i class='bx bxs-cog'></i> Settings</a></li>
                        <li><a href="#"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
                    </ul>
                </div>
            </nav>
            <!-- NAVBAR -->

            <!-- MAIN -->
            <main>
                <h1 class="title">Quản lý dịch vụ</h1>
                <ul class="breadcrumbs">
                    <li><a href="#">Home</a></li>
                    <li class="divider">/</li>
                    <li><a href="#" class="active">Quản lý dịch vụ</a></li>
                </ul>

                <!-- Table to display services -->
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID Dịch Vụ</th>
                            <th>Tên Dịch Vụ</th>
                            <th>Giá</th>
                            <th>Hình Ảnh</th> <!-- Thêm cột hình ảnh -->
                            <th>Hành Động</th> <!-- Cột cho các hành động -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Kết nối cơ sở dữ liệu
                        require_once('../../model/db.php');

                        // Lấy kết nối từ Database Singleton
                        $db = Database::getInstance();
                        $conn = $db->getConnection();

                        // Truy vấn dữ liệu từ bảng 'dichvu'
                        $sql = "SELECT * FROM dichvu";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id_dichvu"] . "</td>";
                                echo "<td>" . htmlspecialchars($row["ten_dichvu"]) . "</td>";
                                echo "<td>" . number_format($row['gia'], 0, ',', '.') . " VND</td>";
                                // Hiển thị hình ảnh
                                echo "<td><img src='../img/service/" . htmlspecialchars($row["image_path"]) . "' alt='Hình ảnh dịch vụ' class='service-image'></td>";
                                echo "<td>";
                                // Nút Sửa
                                echo '<a href="edit_service.php?id=' . $row["id_dichvu"] . '" class="btn-edit">Sửa</a> ';
                                // Nút Xóa
                                echo '<a href="delete_service.php?id=' . $row["id_dichvu"] . '" class="btn-delete" onclick="return confirm(\'Bạn có chắc chắn muốn xóa dịch vụ này?\')">Xóa</a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
            <!-- MAIN -->
        </section>
        <!-- NAVBAR -->

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="../script.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const searchInput = document.getElementById("searchInput");
                const tableRows = document.querySelectorAll("table tbody tr");

                searchInput.addEventListener("input", function() {
                    const query = searchInput.value.toLowerCase();

                    // Kiểm tra nếu trường tìm kiếm không trống và có ít nhất 2 ký tự
                    if (query.trim().length >= 2) {
                        // Lọc các dòng bảng dựa trên dữ liệu nhập vào
                        tableRows.forEach(row => {
                            const serviceName = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                            if (serviceName.includes(query)) {
                                row.style.display = ""; // Hiển thị dòng nếu có kết quả phù hợp
                            } else {
                                row.style.display = "none"; // Ẩn dòng nếu không có kết quả
                            }
                        });

                        // Làm nổi bật các dòng phù hợp trong 5 giây
                        tableRows.forEach(row => {
                            const serviceName = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                            if (serviceName.includes(query)) {
                                row.classList.add("highlight");
                                setTimeout(() => {
                                    row.classList.remove("highlight");
                                }, 5000); // Loại bỏ hiệu ứng highlight sau 5 giây
                            }
                        });
                    } else {
                        // Nếu không có đủ ký tự (dưới 2 ký tự), hiển thị tất cả các dòng
                        tableRows.forEach(row => {
                            row.style.display = ""; // Hiển thị tất cả dòng
                            row.classList.remove("highlight"); // Loại bỏ hiệu ứng highlight nếu có
                        });
                    }
                });
            });
        </script>

    </body>

    </html>