    <style>
        body {
            font-family: poppins, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .about {
            text-align: center;
            color: #C17F12;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .header h2 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .header p {
            font-style: italic;
        }

        .promotions {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .promo-card {
            flex: 1;
            background: linear-gradient(to bottom, #f5e6d3, #fff9f0);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            position: relative;
        }


        .promo-title {
            color: #C17F12;
            font-size: 24px;
            margin-top: 40px;
        }

        .promo-subtitle {
            color: #C17F12;
            font-size: 36px;
            font-weight: bold;
            margin: 10px 0;
        }

        .promo-image {
            width: 400px;
            height: 400px;
            margin: 20px auto;
        }

        .promo-footer {
            color: #C17F12;
            font-size: 14px;
            margin-top: 20px;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .promotions {
                flex-direction: column;
            }
        }

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
    </style>

    <div class="container">

        <div class="row gy-4">

            <div class="about">
                <h1>LÀM ĐẸP LIỀN TAY</h1>
                <h2>RINH NGAY QUÀ KHỦNG</h2>
                <p>***Áp dụng hóa đơn dịch vụ + mỹ phẩm từ 40.000.000đ</p>
            </div>
            <div class="promotions">
                <div class="promo-card">
                    <img src="./assets/img/b.png" alt="Vàng 9999" class="promo-image">
                </div>
                <div class="promo-card">
                    <img src="./assets/img/c.png" alt="iPhone 16 Series" class="promo-image">
                </div>
            </div>
            <button id="BUTTON6199" class="btn-price-table">BẢNG GIÁ</button>
        </div>

    </div>

    </div>