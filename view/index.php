<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Thaảm mỹ viện cỏ Beauty</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../Admin/img/icons8-spa-flower-96.png" rel="icon">
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
    }

    .zalo-icon img:hover {
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
  <div class="main-chat-box">
    <button class="main-chat-button" onclick="toggleMainChat()">
      <i class="bi bi-chat-dots"></i>
    </button>
  </div>

  <!-- Zalo icon -->
  <a href="" target="_blank" class="zalo-icon">
    <img src="./assets/img/icons8-zalo-48.png" alt="Chat on Zalo">
  </a>

  <!-- Chat Widget -->
  <div id="chatWidget" class="chat-widget">
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
  </div>

  <!-- Footer Navigation -->
  <footer id="customFooter" class="custom-footer">
    <nav class="footer-nav">
      <a href="#" class="footer-item">
        <i class="bi bi-telephone"></i>
        <span>Hotline</span>
      </a>
      <a href="#" class="footer-item">
        <i class="bi bi-calendar"></i>
        <span>Đặt hẹn</span>
      </a>
      <a href="#" class="footer-item active" onclick="toggleChat()">
        <i class="bi bi-chat"></i>
        <span>CHAT NGAY</span>
      </a>
      <a href="#" class="footer-item">
        <i class="bi bi-geo-alt"></i>
        <span>Chi Nhánh</span>
      </a>
      <a href="#" class="footer-item">
        <i class="bi bi-gift"></i>
        <span>Ưu đãi</span>
      </a>
    </nav>
  </footer>

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