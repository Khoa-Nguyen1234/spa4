<style>
    .image-section {
        flex: 1;
        background-image: url('./assets/img/a.png');
        background-size: cover;
        background-position: center;
        position: relative;
        height: 100vh;
        /* Đảm bảo phần ảnh chiếm toàn bộ chiều cao */
    }

    .form-section {
        width: 400px;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-left: 1px solid #eee;
        background: #fff;
        /* Giữ nền trắng cho form */
        height: 100vh;
        /* Chiều cao bằng phần ảnh */
    }

    .promo-circle {
        text-align: center;
        border: 2px solid #FDB913;
        border-radius: 150px 150px 0 0;
        padding: 40px 20px;
        margin-bottom: 30px;
    }

    .promo-title {
        color: #FDB913;
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .promo-discount {
        color: #FDB913;
        font-size: 48px;
        font-weight: bold;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    .input-field {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #FDB913;
        border-radius: 4px;
        font-size: 16px;
    }

    .submit-button {
        width: 100%;
        padding: 15px;
        background: #FDB913;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 20px;
    }

    .submit-button:hover {
        background: #e5a811;
    }

    @media (max-width: 768px) {
        .image-section {
            height: 300px;
        }

        .form-section {
            width: 100%;
            padding: 20px;
            height: auto;
            /* Phù hợp với nội dung trên màn hình nhỏ */
        }
    }
</style>



<<div style="display: flex;"> <!-- Sử dụng flex trực tiếp thay vì .container -->
    <div class="image-section"></div>
    <div class="form-section">
        <div class="promo-circle">
            <h1 class="promo-title">NHẬN ƯU ĐÃI</h1>
            <div class="promo-discount">-50%</div>
        </div>
        <form>
            <input type="text" class="input-field" placeholder="Họ và tên" required>
            <input type="tel" class="input-field" placeholder="Số điện thoại" required>
            <button type="submit" class="submit-button">GỬI NGAY</button>
        </form>
    </div>
    </div>
    </div>