    <style>
        .heading {
            text-align: center;
            color: #C17F12;
            margin-bottom: 40px;
        }

        .heading h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .region-title {
            display: flex;
            align-items: center;
            color: #C17F12;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .region-title::before {
            content: "📍";
            margin-right: 10px;
        }

        .branches-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .branch-item {
            background-color: #FFF5F5;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .branch-item:hover {
            background-color: #FFE5E5;
        }

        .branch-name {
            color: #C17F12;
            font-weight: 500;
        }

        .plus-icon {
            color: #C17F12;
            font-size: 20px;
            transition: transform 0.3s;
        }

        .branch-item.active .plus-icon {
            transform: rotate(45deg);
        }

        .branch-info {
            display: none;
            background-color: #FFFFFF;
            border: 1px solid #FFE5E5;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
            grid-column: 1 / -1;
        }

        .branch-info ul {
            list-style-type: none;
            padding-left: 0;
        }

        .branch-info li {
            margin-bottom: 10px;
            color: #333;
        }

        @media (max-width: 768px) {
            .branches-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .branches-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="container">
        <div class="heading">
            <h1>HỆ THỐNG CHI NHÁNH</h1>
            <h2>VIỆN THẨM MỸ DIVA</h2>
        </div>

        <div class="region-title">KHU VỰC MIỀN NAM</div>

        <div class="branches-grid">
            <div class="branch-item" data-branch="binh-phuoc">
                <span class="branch-name">Bình Phước</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="ho-chi-minh">
                <span class="branch-name">Thành phố Hồ Chí Minh</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="ben-tre">
                <span class="branch-name">Bến Tre</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="dong-thap">
                <span class="branch-name">Đồng Tháp</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="an-giang">
                <span class="branch-name">An Giang</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="vinh-long">
                <span class="branch-name">Vĩnh Long</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="tien-giang">
                <span class="branch-name">Tiền Giang</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="binh-duong">
                <span class="branch-name">Bình Dương</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="can-tho">
                <span class="branch-name">Cần Thơ</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="long-an">
                <span class="branch-name">Long An</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="ba-ria">
                <span class="branch-name">Bà Rịa</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="soc-trang">
                <span class="branch-name">Sóc Trăng</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="tra-vinh">
                <span class="branch-name">Trà Vinh</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="tay-ninh">
                <span class="branch-name">Tây Ninh</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="hau-giang">
                <span class="branch-name">Hậu Giang</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="bac-lieu">
                <span class="branch-name">Bạc Liêu</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="ca-mau">
                <span class="branch-name">Cà Mau</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="dong-nai">
                <span class="branch-name">Đồng Nai</span>
                <span class="plus-icon">+</span>
            </div>
            <div class="branch-item" data-branch="kien-giang">
                <span class="branch-name">Kiên Giang</span>
                <span class="plus-icon">+</span>
            </div>
        </div>
    </div>

    <script>
        const branchInfo = {
            'binh-phuoc': [
                'Cơ sở 1: Số 9 Lý Thường Kiệt, TT. Hóc Môn, H. Hóc Môn, TP. Hồ Chí Minh',
                'Cơ sở 2: 103 Bạch Đằng, Phường 2, Quận Tân Bình, TP. Hồ Chí Minh',
                'Cơ sở 3: Số 94A - 96 Trương Công Định, P. 14, Q. Tân Bình'
            ],
            'ho-chi-minh': [
                'Cơ sở 1: 123 Nguyễn Văn Cừ, Quận 1, TP. Hồ Chí Minh',
                'Cơ sở 2: 456 Lê Lợi, Quận 3, TP. Hồ Chí Minh'
            ],
            'ben-tre': ['Số 123 Đường 30/4, Phường 5, TP. Bến Tre, Tỉnh Bến Tre'],
            'dong-thap': ['456 Nguyễn Huệ, Phường 1, TP. Cao Lãnh, Tỉnh Đồng Tháp'],
            'an-giang': ['789 Trần Hưng Đạo, Phường Mỹ Long, TP. Long Xuyên, Tỉnh An Giang'],
            'vinh-long': ['101 Phạm Thái Bường, Phường 4, TP. Vĩnh Long, Tỉnh Vĩnh Long'],
            'tien-giang': ['202 Ấp Bắc, Phường 5, TP. Mỹ Tho, Tỉnh Tiền Giang'],
            'binh-duong': ['303 Đại lộ Bình Dương, Phường Phú Hòa, TP. Thủ Dầu Một, Tỉnh Bình Dương'],
            'can-tho': ['404 Đường 30/4, Quận Ninh Kiều, TP. Cần Thơ'],
            'long-an': ['505 Hùng Vương, Phường 2, TP. Tân An, Tỉnh Long An'],
            'ba-ria': ['606 Trường Chinh, Phường Phước Trung, TP. Bà Rịa, Tỉnh Bà Rịa - Vũng Tàu'],
            'soc-trang': ['707 Lê Hồng Phong, Phường 3, TP. Sóc Trăng, Tỉnh Sóc Trăng'],
            'tra-vinh': ['808 Nguyễn Thị Minh Khai, Phường 6, TP. Trà Vinh, Tỉnh Trà Vinh'],
            'tay-ninh': ['909 Cách Mạng Tháng Tám, Phường 3, TP. Tây Ninh, Tỉnh Tây Ninh'],
            'hau-giang': ['1010 Võ Nguyên Giáp, Phường 5, TP. Vị Thanh, Tỉnh Hậu Giang'],
            'bac-lieu': ['1111 Trần Phú, Phường 7, TP. Bạc Liêu, Tỉnh Bạc Liêu'],
            'ca-mau': ['1212 Nguyễn Tất Thành, Phường 8, TP. Cà Mau, Tỉnh Cà Mau'],
            'dong-nai': ['1313 Võ Thị Sáu, Phường Thống Nhất, TP. Biên Hòa, Tỉnh Đồng Nai'],
            'kien-giang': ['1414 Nguyễn Trung Trực, Phường Vĩnh Bảo, TP. Rạch Giá, Tỉnh Kiên Giang']
        };

        document.addEventListener('DOMContentLoaded', function() {
            const branchItems = document.querySelectorAll('.branch-item');
            let activeItem = null;

            branchItems.forEach(item => {
                item.addEventListener('click', function() {
                    const branchId = this.getAttribute('data-branch');

                    if (activeItem) {
                        activeItem.classList.remove('active');
                        const activeInfoElement = document.getElementById(`${activeItem.getAttribute('data-branch')}-info`);
                        if (activeInfoElement) {
                            activeInfoElement.style.display = 'none';
                        }
                    }

                    if (activeItem !== this) {
                        this.classList.add('active');
                        let infoElement = document.getElementById(`${branchId}-info`);

                        if (!infoElement) {
                            infoElement = document.createElement('div');
                            infoElement.id = `${branchId}-info`;
                            infoElement.className = 'branch-info';
                            const ul = document.createElement('ul');
                            branchInfo[branchId].forEach(info => {
                                const li = document.createElement('li');
                                li.textContent = info;
                                ul.appendChild(li);
                            });
                            infoElement.appendChild(ul);
                            this.parentNode.insertBefore(infoElement, this.nextSibling);
                        }

                        infoElement.style.display = 'block';
                        activeItem = this;
                    } else {
                        activeItem = null;
                    }
                });
            });
        });
    </script>