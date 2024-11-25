<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Cỏ Beauty - Thẩm mỹ viện số 1</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logo-small-size.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    /* Chat Widget Styles */
    .chat-widget {
      display: none;
      position: fixed;
      bottom: 80px;
      right: 20px;
      width: 300px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .chat-header {
      background: linear-gradient(90deg, rgb(213, 128, 1), rgb(246, 182, 57));
      color: white;
      padding: 10px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      position: relative;
    }

    .chat-close {
      position: absolute;
      right: 10px;
      top: 10px;
      background: none;
      border: none;
      color: white;
      font-size: 18px;
      cursor: pointer;
    }

    .chat-messages {
      height: 200px;
      overflow-y: auto;
      padding: 10px;
    }

    .chat-input {
      display: flex;
      padding: 10px;
    }

    .chat-input input {
      flex-grow: 1;
      padding: 5px;
      border: 1px solid #ddd;
      border-radius: 3px;
    }

    .chat-input button {
      background: linear-gradient(90deg, rgb(213, 128, 1), rgb(246, 182, 57));
      color: white;
      border: none;
      padding: 5px 10px;
      margin-left: 5px;
      border-radius: 3px;
      cursor: pointer;
    }

    /* Footer Styles */
    .custom-footer {
      display: none;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(90deg, rgb(213, 128, 1), rgb(246, 182, 57));
      color: white;
      padding: 10px 0;
      z-index: 999;
    }

    .footer-nav {
      display: flex;
      justify-content: space-around;
      align-items: center;
    }

    .footer-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-decoration: none;
      color: white;
      transition: transform 0.3s ease;
    }

    .footer-item:hover {
      transform: translateY(-5px);
    }

    .footer-item i {
      font-size: 24px;
      margin-bottom: 5px;
    }

    .footer-item span {
      font-size: 12px;
    }

    .footer-item.active span {
      font-weight: bold;
    }

    /* Chat Button Effect */
    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
      }

      70% {
        box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
      }
    }

    .footer-item.active {
      animation: pulse 2s infinite;
    }

    /* Main screen chat box and Zalo icon styles */
    .main-chat-box {
      position: fixed;
      bottom: 80px;
      right: 20px;
      z-index: 1000;
    }

    .main-chat-button {
      background: linear-gradient(90deg, rgb(213, 128, 1), rgb(246, 182, 57));
      color: white;
      border: none;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      font-size: 24px;
      cursor: pointer;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease;
    }

    .main-chat-button:hover {
      transform: scale(1.1);
    }

    .zalo-icon {
      position: fixed;
      bottom: 160px;
      right: 20px;
      z-index: 1000;
    }

    .zalo-icon img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
      animation: scaleLogo 2s infinite ease-in-out;
    }

    .zalo-icon img:hover {
      transform: scale(1.1);
    }

    .facebook-icon {
      position: fixed;
      bottom: 220px;
      right: 20px;
      z-index: 1000;
    }

    .facebook-icon img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
      animation: scaleLogo 2s infinite ease-in-out;
    }

    .facebook-icon img:hover {
      transform: scale(1.1);
    }

    .tiktok-icon img:hover {
      transform: scale(1.1);
    }

    .tiktok-icon {
      position: fixed;
      bottom: 100px;
      right: 20px;
      z-index: 1000;
    }

    .tiktok-icon img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
      animation: scaleLogo 2s infinite ease-in-out;
    }

    .tiktok-icon img:hover {
      transform: scale(1.1);
    }

    #hero {
      position: relative;
      width: 100%;
      height: 100vh;
      /* Full viewport height */
      overflow: hidden;
      /* Ensure nothing overflows */
    }

    .hero-img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    .hero-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Make sure the image covers the area without distortion */
      object-position: center;
      /* Optionally, adjust the focus point of the image */
    }


    /* Responsive adjustments */
    @media (max-width: 991px) {

      .main-chat-box,
      .zalo-icon {
        display: none;
      }

      .facebook-icon {
        display: none;
      }

      .image-box {
        display: none;
      }

      .chat-widget,
      .custom-footer {
        display: block;
      }

      .chat-widget {
        width: 90%;
        left: 5%;
        right: 5%;
      }
    }

    /* Add these styles for the voucher dialog */
    .voucher-dialog {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1002;
      /* Higher than other elements */
    }

    .voucher-box,
    .image-box {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      position: relative;
    }

    .voucher-box {
      max-width: 400px;
      text-align: center;
    }

    /* Container styling */
    .image-box {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1003;
      /* Higher than voucher-box */
      display: inline-block;
      padding: 20px;
      border-radius: 10px;
      background-color: white;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
      /* Stronger shadow for emphasis */
      overflow: hidden;
      transition: all 0.5s ease-in-out;
    }

    /* Image styling */
    .image-box img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      transition: all 0.5s ease-in-out;
    }

    /* Ripple effect */
    .image-box::before,
    .image-box::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 200%;
      height: 200%;
      background: rgba(255, 215, 0, 0.5);
      /* More intense luxurious gold color */
      border-radius: 50%;
      transform: scale(0);
      opacity: 1;
      pointer-events: none;
      transition: transform 1s ease-in-out, opacity 1.5s ease-in-out;
    }

    .image-box::after {
      animation-delay: 0.5s;
    }

    /* Keyframes for wave animation */
    @keyframes ripple {

      0%,
      100% {
        transform: scale(0);
        opacity: 1;
      }

      50% {
        transform: scale(1);
        opacity: 0;
      }
    }

    .image-box::before {
      animation: ripple 1.5s infinite ease-in-out;
    }

    .image-box::after {
      animation: ripple 1.5s 0.75s infinite ease-in-out;
    }


    /* Existing close button styling */
    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: none;
      border: none;
      font-size: 36px;
      /* Increase font size for better visibility */
      cursor: pointer;
      outline: none;
      padding: 20px;
      /* Increase padding */
      border-radius: 50%;
      overflow: hidden;
      transition: background 0.3s ease;
      animation: ripple 2s infinite;
    }

    /* Hover effect: change background color to red and add ripple effect */
    .close-btn:hover {
      background: red;
      /* Hover color */
      box-shadow: 0 0 10px red, 0 0 20px red, 0 0 30px red;
    }

    /* Ripple effect */
    .close-btn::after {
      content: "";
      position: absolute;
      width: 500%;
      /* Larger width for ripple */
      height: 500%;
      /* Larger height for ripple */
      top: 50%;
      left: 50%;
      pointer-events: none;
      transform: translate(-50%, -50%) scale(0);
      background: rgba(255, 0, 145, 0.8);
      /* More pronounced ripple effect */
      transition: transform 0.5s ease, opacity 1s ease;
      border-radius: 50%;
    }

    /* Add a ripple animation */
    @keyframes ripple {
      0% {
        transform: translate(-50%, -50%) scale(0);
        opacity: 1;
      }

      50% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0;
      }

      100% {
        transform: translate(-50%, -50%) scale(0);
        opacity: 1;
      }
    }

    .close-btn::after {
      animation: ripple 2s infinite;
    }

    .close-btn:hover::after {
      transform: translate(-50%, -50%) scale(1);
      opacity: 0;
    }

    #voucherForm {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 20px;
    }

    #voucherForm input,
    #voucherForm button {
      padding: 10px;
      font-size: 16px;
    }

    #voucherForm button {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      animation: shake 2s infinite ease-in-out;
    }

    #voucherForm button:hover {
      background-color: #45a049;
    }

    /* Hiệu ứng rung rinh */
    @keyframes shake {

      0%,
      100% {
        transform: translateX(0);
      }

      20%,
      60% {
        transform: translateX(-5px);
      }

      40%,
      80% {
        transform: translateX(5px);
      }
    }

    #laterBtn {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 10px;
      margin-top: 10px;
      cursor: pointer;
    }

    #laterBtn:hover {
      background-color: #da190b;
    }
  </style>
</head>

<body class="index-page">

  <?php include '../view/layout/header.php' ?>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
      <?php include './banner.php' ?>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
      <?php include './about.php' ?>
    </section><!-- /About Section -->

    <section id="services" class="services section light-background">
      <?php include './service.php' ?>
    </section>

    <section id="customer" class="portfolio section">
      <?php include './customer.php' ?>
    </section><!-- /Portfolio Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">
      <?php include './comment.php' ?>
    </section><!-- /Testimonials Section -->

    <!-- Team Section -->
    <section id="team" class="team section">
      <?php include './dentist.php' ?>
    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <?php include './contact.php' ?>
    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">
    <?php include './promocode.php' ?>
  </footer>

  <section>
    <?php include './local.php' ?>
  </section>

  <!-- Main screen chat box -->
  <!-- <div class="main-chat-box">
    <button class="main-chat-button" onclick="toggleMainChat()">
      <i class="bi bi-chat-dots"></i>
    </button>
  </div> -->

  <!-- Zalo icon -->
  <a href="https://www.facebook.com/leminhquangit/" target="_blank" class="facebook-icon">
    <img src="./assets/img/facebook.png" alt="Chat on Facebook">
  </a>
  <a href="https://www.facebook.com/leminhquangit/" target="_blank" class="zalo-icon">
    <img src="./assets/img/icons8-zalo-48.png" alt="Chat on Zalo">
  </a>
  <a href="https://www.tiktok.com/@leminhquangit" target="_blank" class="tiktok-icon">
    <img src="./assets/img/tiktok.png" alt="Chat on Tiktok">
  </a>

  <!-- Chat Widget -->
  <!-- <div id="chatWidget" class="chat-widget">
    <div class="chat-header">
      <h3>Chat với chúng tôi</h3>
      <button class="chat-close" onclick="toggleChat()">&times;</button>
    </div>
    <div class="chat-messages">
      <p>Xin chào! Chúng tôi có thể giúp gì cho bạn?</p>
    </div>
    <div class="chat-input">
      <input type="text" placeholder="Nhập tin nhắn...">
      <button onclick="sendMessage()">Gửi</button>
    </div>
  </div> -->

  <!-- Footer Navigation -->
  <footer id="customFooter" class="custom-footer">
    <nav class="footer-nav">
      <a href="tel:+84339474333" class="footer-item">
        <i class="bi bi-telephone"></i>
        <span>Hotline</span>
      </a>
      <a href="#footer" class="footer-item">
        <i class="bi bi-calendar"></i>
        <span>Đặt hẹn</span>
      </a>
      <!-- <a href="#" class="footer-item active" onclick="toggleChat()">
        <i class="bi bi-chat"></i>
        <span>CHAT NGAY</span>
      </a> -->
      <a href="#" class="footer-item">
        <img src="./assets/img/icons8-zalo-48.png" alt="Zalo" style="width: 38px; height: 38px;">
        <span>Zalo</span>
      </a>
      <a href="#" class="footer-item">
        <img src="./assets/img/facebook.png" alt="Zalo" style="width: 38px; height: 38px;">
        <span>Facebook</span>
      </a>
    </nav>
  </footer>
  <!-- Add this before the closing </body> tag -->
  <!-- Update the voucher dialog HTML structure -->
  <div id="voucherDialog" class="voucher-dialog">
    <div class="voucher-box">
      <button id="closeVoucherBox" class="close-btn">&times;</button>
      <h2>Đăng ký nhận tin khuyến mãi</h2>
      <p>Voucher sẽ được gửi trong vòng 24h. Chỉ áp dụng cho khách hàng mới.</p>
      <form id="voucherForm" action="../controller/pmcode.php" method="POST">
        <input type="email" name="new_email" placeholder="Email" required>
        <input type="tel" name="phone_number" placeholder="Số điện thoại" required>
        <button type="submit">Đăng ký ngay</button>
      </form>
      <button id="laterBtn">Đăng ký sau</button>
    </div>
    <div id="imageBox" class="image-box">
      <button id="closeImageBox" class="close-btn">&times;</button>
      <img src="https://cdn2.cellphones.com.vn/insecure/rs:fill:768:/q:100/plain/https://cellphones.com.vn/media/catalog/product/h/e/header_teasing_mb.png" alt="Promo Image">
    </div>
  </div>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    // Existing JavaScript

    // Add this to the existing script
    document.addEventListener('DOMContentLoaded', function() {
      const voucherDialog = document.getElementById('voucherDialog');
      const imageBox = document.getElementById('imageBox');
      const closeVoucherBox = document.getElementById('closeVoucherBox');
      const closeImageBox = document.getElementById('closeImageBox');
      const laterBtn = document.getElementById('laterBtn');
      const voucherForm = document.getElementById('voucherForm');

      function closeDialog() {
        voucherDialog.style.display = 'none';
      }

      function closeImageBoxOnly() {
        imageBox.style.display = 'none';
      }

      closeVoucherBox.addEventListener('click', closeDialog);
      closeImageBox.addEventListener('click', closeImageBoxOnly);
      laterBtn.addEventListener('click', closeDialog);

      voucherForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Here you can add code to handle form submission
        alert('Đăng ký thành công!');
        closeDialog();
      });
    });
  </script>

  <script>
    const chatWidget = document.getElementById('chatWidget');
    const customFooter = document.getElementById('customFooter');

    function toggleChat() {
      if (window.innerWidth <= 991) {
        chatWidget.style.display = chatWidget.style.display === 'none' ? 'block' : 'none';
      }
    }

    function toggleMainChat() {
      if (window.innerWidth > 991) {
        chatWidget.style.display = chatWidget.style.display === 'none' ? 'block' : 'none';
      }
    }

    function sendMessage() {
      // Implement send message functionality here
      console.log('Message sent');
    }

    function checkResponsive() {
      if (window.innerWidth <= 991) {
        customFooter.style.display = 'block';
        document.querySelector('.main-chat-box').style.display = 'none';
        document.querySelector('.zalo-icon').style.display = 'none';
      } else {
        customFooter.style.display = 'none';
        chatWidget.style.display = 'none';
        document.querySelector('.main-chat-box').style.display = 'block';
        document.querySelector('.zalo-icon').style.display = 'block';
      }
    }

    // Check on page load
    checkResponsive();

    // Check on window resize
    window.addEventListener('resize', checkResponsive);
  </script>

</body>

</html>