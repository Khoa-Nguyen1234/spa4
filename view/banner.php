<?php
// Kết nối cơ sở dữ liệu
require_once '../model/db.php';

// Lấy kết nối từ lớp Database
$db = Database::getInstance()->getConnection();

// Truy xuất dữ liệu từ bảng banners
$sql = "SELECT * FROM banners WHERE status = 'active' ORDER BY created_at DESC";
$result = $db->query($sql);

if ($result === false) {
    die("Lỗi truy vấn: " . $db->error);
}

// Lấy danh sách banner
$banners = $result->fetch_all(MYSQLI_ASSOC);
?>

<style>
    /* Hero container */
    .hero {
        width: 100%;
        min-height: 70vh;
        position: relative;
        padding: 0;
        display: flex;
        align-items: center;
    }

    /* Text within hero */
    .hero h2 {
        margin: 0;
        font-size: 42px;
        font-weight: 700;
        line-height: 56px;
    }

    .hero p {
        color: color-mix(in srgb, var(--default-color), transparent 30%);
        margin: 5px 0 10px 0;
        font-size: 20px;
        font-weight: 400;
    }

    .hero .cta-btn {
        color: var(--contrast-color);
        background: var(--accent-color);
        font-family: var(--heading-font);
        font-weight: 400;
        font-size: 14px;
        letter-spacing: 1px;
        padding: 8px 35px;
        border-radius: 3px;
        transition: 0.5s;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero .cta-btn:hover {
        background: var(--accent-color);
        color: var(--contrast-color);
    }

    .hero .cta-btn i {
        font-size: 16px;
        line-height: 0;
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .hero h2 {
            font-size: 28px;
            line-height: 36px;
        }

        .hero p {
            font-size: 18px;
            line-height: 24px;
            margin-bottom: 30px;
        }

        .hero .download-btn {
            font-size: 14px;
            padding: 8px 20px 10px 20px;
        }
    }

    /* Banner container */
    .banner-container {
        padding: 0;
        width: 100%;
        min-height: 70vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    /* Individual image containers */
    .hero-img {
        position: absolute;
        width: 100%;
        min-height: 70vh;
        left: 100%;
        transition: left 1s ease;
        display: block;
    }

    /* Make the active image visible */
    .hero-img.active {
        left: 0;
    }

    /* Ensure the images inside scale properly */
    .hero-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Optional: Add some space between images */
    .col-lg-12 {
        margin-bottom: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .hero-img {
            min-height: 60vh;
        }
    }

    @media (max-width: 992px) {
        .hero-img {
            min-height: 50vh;
        }
    }

    @media (max-width: 768px) {
        .hero-img {
            min-height: 40vh;
        }
    }

    @media (max-width: 576px) {
        .hero-img {
            min-height: 30vh;
        }
    }
</style>

<div class="container banner-container">
    <div class="row gy-12">
        <?php foreach ($banners as $index => $banner): ?>
            <div class="col-lg-12 hero-img <?= $index === 0 ? 'active' : '' ?>" id="image<?= $index + 1 ?>"
                data-aos="zoom-out" data-aos-delay="100">
                <img src="<?= '../Admin/img/banner/' . htmlspecialchars($banner['image_path']) ?>" class="img-fluid animated"
                    alt="<?= htmlspecialchars($banner['title']) ?>">
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.hero-img');
        let currentIndex = 0;

        function showNextImage() {
            images[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].classList.add('active');
        }

        images[currentIndex].classList.add('active');
        setInterval(showNextImage, 3000);
    });
</script>