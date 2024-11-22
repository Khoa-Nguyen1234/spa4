<style>
    .container img {
        width: 100%;
        border-radius: 8px;
        display: block;
    }

    .button {
        position: absolute;
        /* Tuyệt đối nhưng không thay đổi container */
        inset: 0;
        /* Tự căn chỉnh dựa trên chính khung ảnh */
        margin: auto;
        /* Đảm bảo nút nằm giữa */
        width: fit-content;
        height: fit-content;
        padding: 10px 20px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
    }

    .button:hover {
        background-color: rgba(0, 0, 0, 0.9);
    }

    .video-box {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        overflow: hidden;
        z-index: 1000;
    }

    .video-box iframe {
        width: 560px;
        height: 315px;
        border: none;
    }

    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 999;
    }
</style>


<img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

<div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
            {
                "loop": true,
                "speed": 600,
                "autoplay": {
                    "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                }
            }
        </script>
        <div class="swiper-wrapper">

            <!-- Swiper Slide 1 -->
            <div class="swiper-slide">
                <div class="testimonial-item" id="item-1">
                    <div class="container">
                        <img src="https://img.youtube.com/vi/L225X-pc7AE/hqdefault.jpg" alt="YouTube Thumbnail">
                        <button class="button" onclick="openVideo('item-1', 'https://www.youtube.com/embed/L225X-pc7AE')">Xem Ngay</button>
                    </div>
                    <div class="overlay" onclick="closeVideo('item-1')"></div>
                    <div class="video-box">
                        <iframe
                            id="iframe-item-1"
                            src=""
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Swiper Slide 2 -->
            <div class="swiper-slide">
                <div class="testimonial-item" id="item-2">
                    <div class="container">
                        <img src="https://img.youtube.com/vi/jHxgW3uDJwY/hqdefault.jpg" alt="YouTube Thumbnail">
                        <button class="button" onclick="openVideo('item-2', 'https://www.youtube.com/embed/jHxgW3uDJwY')">Xem Ngay</button>
                    </div>
                    <div class="overlay" onclick="closeVideo('item-2')"></div>
                    <div class="video-box">
                        <iframe
                            id="iframe-item-2"
                            src=""
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item" id="item-3">
                    <div class="container">
                        <img src="https://img.youtube.com/vi/kODeB3sxaW0/hqdefault.jpg" alt="YouTube Thumbnail">
                        <button class="button" onclick="openVideo('item-3', 'https://www.youtube.com/embed/kODeB3sxaW0')">Xem Ngay</button>
                    </div>
                    <div class="overlay" onclick="closeVideo('item-3')"></div>
                    <div class="video-box">
                        <iframe
                            id="iframe-item-3"
                            src=""
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="testimonial-item" id="item-4">
                    <div class="container">
                        <img src="https://img.youtube.com/vi/r6Sa7B8Lscc/hqdefault.jpg" alt="YouTube Thumbnail">
                        <button class="button" onclick="openVideo('item-4', 'https://www.youtube.com/embed/r6Sa7B8Lscc')">Xem Ngay</button>
                    </div>
                    <div class="overlay" onclick="closeVideo('item-4')"></div>
                    <div class="video-box">
                        <iframe
                            id="iframe-item-4"
                            src=""
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

</div>

<script>
    let swiper = new Swiper('.swiper.init-swiper', {
        loop: true,
        speed: 600,
        autoplay: {
            delay: 5000
        },
        slidesPerView: "auto",
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true
        },
        on: {
            slideChange: function() {
                // Khi slide thay đổi, đóng video cũ
                const currentSlide = document.querySelector('.swiper-slide.swiper-slide-active');
                const prevSlide = document.querySelector('.swiper-slide.swiper-slide-prev');

                // Đóng video của slide trước khi vuốt sang slide mới
                if (prevSlide) {
                    const prevItemId = prevSlide.querySelector('.testimonial-item').id;
                    closeVideo(prevItemId);
                }

                // Đóng video của slide hiện tại
                if (currentSlide) {
                    const currentItemId = currentSlide.querySelector('.testimonial-item').id;
                    closeVideo(currentItemId);
                }
            }
        }
    });

    // Hàm mở video
    function openVideo(itemId, videoUrl) {
        // Lấy phần tử video-box và iframe theo ID
        const videoBox = document.querySelector(`#${itemId} .video-box`);
        const overlay = document.querySelector(`#${itemId} .overlay`);
        const videoIframe = document.querySelector(`#iframe-${itemId}`);

        // Hiển thị video-box và lớp phủ
        videoBox.style.display = 'block';
        overlay.style.display = 'block';

        // Gán URL video để phát
        videoIframe.src = `${videoUrl}?autoplay=1`;
    }

    // Hàm đóng video
    function closeVideo(itemId) {
        // Lấy phần tử video-box và iframe theo ID
        const videoBox = document.querySelector(`#${itemId} .video-box`);
        const overlay = document.querySelector(`#${itemId} .overlay`);
        const videoIframe = document.querySelector(`#iframe-${itemId}`);

        // Ẩn video-box và lớp phủ
        videoBox.style.display = 'none';
        overlay.style.display = 'none';

        // Xóa URL video để dừng phát
        videoIframe.src = '';
    }
</script>