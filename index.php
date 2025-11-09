<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayJhakkas</title>
    <link rel="icon" href="./assets/images/new/" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  


    <style>
        .book-now-btn {
            background-color: #ff0000;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .book-now-btn-v {
            background-color: #ff0000;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .book-now-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo"><a href="./index.html">
            <img src="./assets/images/new/StayJhakkasLogo.png" 
             alt="StayJhakkas Logo"
             style="width: 100px; height: 100px;"/></a>
        </div>
        <div class="nav-links">
            <a href="index.html" class="active">Home</a>
            <a href="pages/rooms.html">PGs</a>
            <a href="pages/booking.html">Book Now</a>
            <a href="pages/login.html">Login</a>
            <a href="pages/signup.html">Sign Up</a>
            <a href="pages/profile.html">My Profile</a>
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <header class="hero">
        <div class="video-container">
            <video autoplay muted loop id="heroVideo">
                <source src="assets/videos/hotelbg.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="hero-content">
                <h1>StayJhakkas</h1>
                <p>Find your perfect Paying Guest accommodation</p>
                <button onclick="window.location.href='pages/booking.html'" class="book-now-btn">Book Now</button>
            </div>
        </div>
    </header>

    <main>
        <section class="rooms-section">
            <h2>Featured PGs</h2>
            <div class="swiper roomsSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="room-slide">
                            <img src="./assets/images/new/5.png" alt="Zolo PG">
                            <div class="room-info">
                                <h3>Zolo PG</h3>
                                <p>Perfect for working professionals</p>
                                <p class="price">From ₹7,500/month</p>
                                <a href="pages/booking.html?type=standard" class="book-now-btn-v">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="room-slide">
                            <img src="./assets/images/new/6.png" alt="Colive PG">
                            <div class="room-info">
                                <h3>Colive PG</h3>
                                <p>Premium co-living space</p>
                                <p class="price">From ₹11,999/month</p>
                                <a href="pages/booking.html?type=deluxe" class="book-now-btn-v">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="room-slide">
                            <img src="./assets/images/new/7.png" alt="Vighna PG">
                            <div class="room-info">
                                <h3>Vighna PG</h3>
                                <p>Comfortable student accommodation</p>
                                <p class="price">From ₹6,000/month</p>
                                <a href="pages/booking.html?type=family" class="book-now-btn-v">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="room-slide">
                            <img src="./assets/images/new/8.png" alt="Standard PG">
                            <div class="room-info">
                                <h3>Standard PG</h3>
                                <p>Budget-friendly accommodation</p>
                                <p class="price">From ₹5,500/month</p>
                                <a href="pages/booking.html?type=suite" class="book-now-btn-v">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="room-slide">
                            <img src="./assets/images/new/9.png" alt="Standard PG">
                            <div class="room-info">
                                <h3>Standard PG</h3>
                                <p>Budget-friendly accommodation</p>
                                <p class="price">From ₹5,500/month</p>
                                <a href="pages/booking.html?type=suite" class="book-now-btn-v">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination" ></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <section class="features">
            <h2>Our Amenities</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <i class="fas fa-wifi"></i>
                    <h3>Free Wi-Fi</h3>
                    <p>High-speed internet throughout the PG</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-swimming-pool"></i>
                    <h3>Security</h3>
                    <p>CCTV cameras, security guards</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-utensils"></i>
                    <h3>Meals</h3>
                    <p>Home-cooked food</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-spa"></i>
                    <h3>Social Environment</h3>
                    <p>Place to meet new people</p>
                </div>
            </div>
        </section>

        <section class="rooms">
            <h2>Popular PGs</h2>
            <div class="room-grid">
                <div class="room-card">
                    <img src="./assets/images/new/1.png" alt="Standard Room">
                    <div class="room-info">
                        <h3>Smart Living PG</h3>
                        <p>Comfortable single occupancy with basic amenities</p>
                        <p class="price">From ₹6,000/month</p>
                        <a href="pages/booking.html" class="book-btn">Book Now</a>
                    </div>
                </div>
                <div class="room-card">
                    <img src="./assets/images/new/2.png" alt="Deluxe Room">
                    <div class="room-info">
                        <h3>Poona Royal PG</h3>
                        <p>Spacious room with double occupancy</p>
                        <p class="price">From ₹4,500/month</p>
                        <a href="pages/booking.html" class="book-btn">Book Now</a>
                    </div>
                </div>
                <div class="room-card">
                    <img src="./assets/images/new/3.png" alt="Executive Suite">
                    <div class="room-info">
                        <h3>Royal Comfort PG</h3>
                        <p>Economic option with triple occupancy</p>
                        <p class="price">From ₹3,500/month</p>
                        <a href="pages/booking.html" class="book-btn">Book Now</a>
                    </div>
                </div>
                <div class="room-card">
                    <img src="./assets/images/new/4.png" alt="Presidential Suite">
                    <div class="room-info">
                        <h3>Prime Stay PG</h3>
                        <p>Luxury single occupancy with attached bathroom</p>
                        <p class="price">From ₹8,000/month</p>
                        <a href="pages/booking.html" class="book-btn">Book Now</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@pgfinder.com</p>
                <p>Phone: +91 99999 99999</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="pages/rooms.html">PGs</a>
                <a href="pages/booking.html">Bookings</a>
                <a href="#">About Us</a>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 PG Finder. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        const swiper = new Swiper('.roomsSwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });
    </script>
</body>
</html>
