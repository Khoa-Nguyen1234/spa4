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
    /* Banner container */
    .banner-container {
        padding: 0;
        min-width: 100vw !important;
        /* Ensures no overflow */
    }

    /* Individual image containers */
    .hero-img {
        position: absolute;
        width: 100%;
        height: 100vh;
        /* Each image will take full viewport height */
        left: 100%;
        /* Start each image off-screen */
        transition: left 1s ease;
        /* Slide effect */
        display: block;
    }

    /* Make the active image visible */
    .hero-img.active {
        left: 0;
        /* Slide the active image into the visible area */
    }

    /* Ensure the images inside scale properly */
    .hero-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensure the images cover the entire container without distortion */
    }

    /* Optional: Add some space between images */
    .col-lg-12 {
        margin-bottom: 20px;
    }
</style>

<div class="container banner-container">
    <div class="row gy-12">
        <?php foreach ($banners as $index => $banner): ?>
            <!-- Dynamic Image -->
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
        const images = document.querySelectorAll('.hero-img'); // Select all images
        let currentIndex = 0;

        // Function to show the next image
        function showNextImage() {
            // Remove the 'active' class from the current image
            images[currentIndex].classList.remove('active');
            // Update the currentIndex to point to the next image, looping back to the first image
            currentIndex = (currentIndex + 1) % images.length;
            // Add the 'active' class to the next image to make it visible
            images[currentIndex].classList.add('active');
        }

        // Initially show the first image
        images[currentIndex].classList.add('active');

        // Call showNextImage every 3 seconds (3000 milliseconds)
        setInterval(showNextImage, 3000);
    });
</script>