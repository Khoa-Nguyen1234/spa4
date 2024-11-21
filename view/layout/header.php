  <style>
      .btn-price-table {
          background-image: linear-gradient(90deg, rgb(213, 128, 1), rgb(246, 182, 57));
          border: none;
          padding: 10px 40px;
          font-size: 16px;
          font-weight: bold;
          color: white;
          /* Màu chữ */
          cursor: pointer;
          /* Đường viền bo tròn */
          transition: background 0.3s;
          border-radius: 35px;
      }

      .btn-price-table:hover {
          background-image: linear-gradient(90deg, rgb(246, 182, 57), rgb(213, 128, 1));
          /* Đảo ngược gradient khi hover */
      }

      .form-container {
          max-width: 400px;
          margin: 20px auto;
          padding: 30px;
          background: linear-gradient(135deg, #ffffff, #f8f8f8);
          border-radius: 15px;
          box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
          display: none;
          /* Ẩn form mặc định */
      }

      .form-title {
          text-align: center;
          color: #B38B4B;
          margin-bottom: 25px;
          font-size: 24px;
          font-weight: bold;
          line-height: 1.4;
      }

      .form-group {
          margin-bottom: 20px;
      }

      .form-control {
          width: 100%;
          padding: 12px 15px;
          border: 1px solid #D4AA6C;
          border-radius: 8px;
          font-size: 16px;
          transition: all 0.3s ease;
      }

      .form-control:focus {
          outline: none;
          border-color: #B38B4B;
          box-shadow: 0 0 0 2px rgba(179, 139, 75, 0.2);
      }

      .submit-btn {
          width: 100%;
          padding: 15px;
          border: none;
          border-radius: 8px;
          background: linear-gradient(120deg, rgb(212, 170, 108), rgb(179, 139, 75));
          color: white;
          font-size: 18px;
          font-weight: bold;
          cursor: pointer;
          transition: opacity 0.3s ease;
      }

      .submit-btn:hover {
          opacity: 0.9;
      }

      select.form-control {
          appearance: none;
          background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23B38B4B' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
          background-repeat: no-repeat;
          background-position: right 15px center;
          padding-right: 40px;
      }
  </style>

  <header id="header" class="header d-flex align-items-center sticky-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

          <a href="index.php" class="logo d-flex align-items-center">
              <img src="../view/assets/img/resized_image_500x400.gif" width="100px" alt="">
          </a>

          <nav id="navmenu" class="navmenu">
              <ul>
                  <li><a href="#hero" class="active">Ưu đãi</a></li>
                  <li><a href="#services">Dịch vụ</a></li>
                  <li><a href="#customer">Khách hàng</a></li>
                  <li><a href="#portfolio">Địa chỉ gần nhất</a></li>
                  <li><a href="#team">Đội ngũ bác sĩ</a></li>
                  <button id="BUTTON6198" class="btn-price-table" onclick="toggleForm()">BẢNG GIÁ</button>
              </ul>
              <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>
      </div>
  </header>

  <!-- Form for "Bảng Giá" -->
  <div id="price-form" class="form-container" style="display: none;">
      <h2 class="form-title">LÀM ĐẸP LIỀN TAY<br>RINH NGAY QUÀ KHỦNG</h2>
      <?php
        // Kết nối cơ sở dữ liệu
        $conn = new mysqli('localhost', 'root', '', 'spa3');
        if ($conn->connect_error) {
            die("Kết nối không thành công: " . $conn->connect_error);
        }

        // Kiểm tra xem form đã được submit hay chưa
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $ho_va_ten = $conn->real_escape_string($_POST['ho_va_ten']);
            $so_dien_thoai = $conn->real_escape_string($_POST['so_dien_thoai']);
            $dich_vu_id = (int)$_POST['dich_vu_id'];

            // Thực hiện câu lệnh INSERT vào bảng phieu_dat
            $sql = "INSERT INTO phieu_dat (ho_va_ten, so_dien_thoai, dich_vu_id) VALUES ('$ho_va_ten', '$so_dien_thoai', $dich_vu_id)";

            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        }

        // Truy vấn lấy dịch vụ
        $sql = "SELECT id, ten_dich_vu FROM dich_vu";
        $result = $conn->query($sql);
        ?>

      <form action="" method="POST">
          <div class="form-group">
              <input type="text" class="form-control" name="ho_va_ten" placeholder="Họ và tên" required>
          </div>
          <div class="form-group">
              <input type="tel" class="form-control" name="so_dien_thoai" placeholder="Số điện thoại" pattern="(\+84|0){1}(9|8|7|5|3){1}[0-9]{8}" required>
          </div>

          <div class="form-group">
              <select class="form-control" name="dich_vu_id" required>
                  <option value="" disabled selected>Chọn dịch vụ</option>
                  <?php
                    // Hiển thị dịch vụ vào thẻ select
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . $row['ten_dich_vu'] . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled>Không có dịch vụ</option>';
                    }
                    ?>
              </select>
          </div>

          <button type="submit" class="submit-btn">GỬI NGAY</button>
      </form>

      <?php
        // Đóng kết nối
        $conn->close();
        ?>



  </div>

  <script>
      function toggleForm() {
          var form = document.getElementById("price-form");
          // Nếu form đang ẩn, hiển thị, ngược lại ẩn đi
          if (form.style.display === "none") {
              form.style.display = "block";
          } else {
              form.style.display = "none";
          }
      }
  </script>