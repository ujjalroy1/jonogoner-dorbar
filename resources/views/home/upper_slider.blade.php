<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Improved Slider with Marquee</title>
    
    <!-- Required CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Improved Marquee Styles */
        .running-header {
            background: #1a237e;
            color: #fff;
            padding: 15px 0;
            font-size: 1.2rem;
            position: relative;
            overflow: hidden;
            height: 50px;
            display: flex;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .marquee-content {
            white-space: nowrap;
            position: absolute;
            animation: marquee 20s linear infinite;
        }

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Improved Slider Styles */
        .slider-section {
            position: relative;
            margin-top: 20px;
            padding: 0 15px;
        }

        .swiper-slide {
            height: 70vh;
            min-height: 400px;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
        }

        .slide-1 {
            background-image: linear-gradient(rgba(26, 35, 126, 0.6), rgba(26, 35, 126, 0.6)),
                url('your-image-url-1.jpg');
        }

        .slide-2 {
            background-image: linear-gradient(rgba(26, 35, 126, 0.6), rgba(26, 35, 126, 0.6)),
                url('your-image-url-2.jpg');
        }

        .slider-content {
            position: absolute;
            bottom: 15%;
            left: 5%;
            right: 5%;
            color: #fff;
            padding: 30px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border-radius: 10px;
            animation: contentSlide 1s ease forwards;
        }

        @keyframes contentSlide {
            from { transform: translateX(-50px); }
            to { transform: translateX(0); }
        }

        .slider-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .slider-text {
            font-size: 1.2rem;
            margin-bottom: 25px;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        .btn-slider {
            background: #ffab00;
            color: #1a237e !important;
            padding: 12px 35px;
            border-radius: 8px;
            font-weight: 700;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .btn-slider:hover {
            background: transparent;
            border-color: #ffab00;
            color: #ffab00 !important;
            transform: translateY(-3px);
        }

        /* Navigation Styles */
        .swiper-button-next,
        .swiper-button-prev {
            color: #ffab00 !important;
            background: rgba(255, 255, 255, 0.9);
            width: 40px;
            height: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 1.5rem !important;
        }

        .swiper-pagination-bullet {
            background: #fff !important;
            opacity: 0.5 !important;
            width: 12px !important;
            height: 12px !important;
        }

        .swiper-pagination-bullet-active {
            background: #ffab00 !important;
            opacity: 1 !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .running-header {
                height: 40px;
                font-size: 1rem;
            }
            
            .slider-title {
                font-size: 1.8rem;
            }
            
            .slider-text {
                font-size: 1rem;
            }
            
            .swiper-slide {
                height: 50vh;
                background-size: cover;
            }
            
            .slider-content {
                padding: 20px;
                bottom: 5%;
            }
        }
    </style>
</head>
<body>

    <!-- Running Header -->
    <div class="running-header">
        <div class="marquee-content">
            জনগণের দরবার: দিনাজপুর জেলা প্রশাসকের কার্যালয়ে আপনাকে স্বাগতম। আপনার অভিযোগ ও মতামত জানানোর জন্য প্ল্যাটফর্মটি ব্যবহার করুন।
        </div>
    </div>

    <!-- Slider Section -->
<!-- Slider Section -->
<section class="slider-section">
    <div class="swiper-container">
        <div class="swiper-wrapper">

            <!-- Slide 1 -->
            <div class="swiper-slide">
                <img src="{{ asset('user_view/images/Upper_View_Of_HSTU.jpg') }}" class="img-fluid w-100 h-100 object-fit-cover rounded" alt="HSTU View">
                <div class="slider-content">
                    <h1 class="slider-title">হাজী মোহাম্মাদ দানেশ বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়</h1>
                    <!-- <p class="slider-text">Discover Excellence in Education and Innovation</p>
                    <a href="#" class="btn btn-slider">Explore Campus</a> -->
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
                <img src="{{ asset('user_view/images/West_side_of_Sura_Mosque.jpg') }}" class="img-fluid w-100 h-100 object-fit-cover rounded" alt="Sura Mosque">
                <div class="slider-content">
                    <h1 class="slider-title">নয়াবাদ মসজিদ</h1>
                    <!-- <p class="slider-text">Gateway to Knowledge and Opportunity</p>
                    <a href="#" class="btn btn-slider">View History</a> -->
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">
                <img src="{{ asset('user_view/images/Ramsagor_horse.jpg') }}" class="img-fluid w-100 h-100 object-fit-cover rounded" alt="Ramsagor">
                <div class="slider-content">
                    <h1 class="slider-title">রামসাগর</h1>
                    <!-- <a href="#" class="btn btn-slider">View History</a> -->
                </div>
            </div>

            <!-- Slide 4 -->
            <div class="swiper-slide">
                <img src="{{ asset('user_view/images/Sitakot_Bihara_1.jpg') }}" class="img-fluid w-100 h-100 object-fit-cover rounded" alt="Sitakot Bihara">
                <div class="slider-content">
                    <h1 class="slider-title">সীতাকোট বিহার</h1>
                    <!-- <p class="slider-text">Gateway to Knowledge and Opportunity</p>
                    <a href="#" class="btn btn-slider">View History</a> -->
                </div>
            </div>

            <!-- Slide 5 -->
            <div class="swiper-slide">
                <img src="{{ asset('user_view/images/Noyabaad_Mosque_(6).jpg') }}" class="img-fluid w-100 h-100 object-fit-cover rounded" alt="Noyabaad Mosque">
                <div class="slider-content">
                    <h1 class="slider-title">নয়াবাদ মসজিদ</h1>
                    <!-- <p class="slider-text">Gateway to Knowledge and Opportunity</p>
                    <a href="#" class="btn btn-slider">View History</a> -->
                </div>
            </div>

        </div>

        <!-- Navigation Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>


    <!-- Required Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        // Initialize Swiper
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            speed: 800,
            autoplay: {
                delay: 5000,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            effect: 'slide',
            breakpoints: {
                768: {
                    effect: 'slide'
                }
            }
        });
    </script>

</body>
</html>