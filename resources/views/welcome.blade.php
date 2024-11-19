<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel1</title>
    <!-- ICON -->
    <link rel="icon" type="image/png" href="{{ asset('assets/admin/images/favicon.png') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- File -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/esponsive-style.css') }}r">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/brands.min.css"
        integrity="sha512-L+sMmtHht2t5phORf0xXFdTC0rSlML1XcraLTrABli/0MMMylsJi3XA23ReVQkZ7jLkOEIMicWGItyK4CAt2Xw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.js"> -->
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">

    <!-- nav bar section -->
    <header class="header_wrapper">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/home') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/admin/images/logo.png') }}" class="img-fluid" alt="logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <!--  <span class="navbar-toggler-icon"></span> -->
                    <i class="fas fa-stream "></i>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav menu-navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#room">Room</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#team">Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#gallery">Gallery</a>
                        </li>
                        @if (Route::has('login'))

                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/reservations') }}">Home</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth

                        @endif
                        <li class="nav-item mt-3 mt-lg-0">
                            <a class="main-btn" href="">Book Now</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- nav bar section exit -->

    <!-- banner section-->
    <section id="home" class="banner_wrapper p-0">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide"
                    style="background-image: url({{ asset('assets/admin/images/slider/slider2.webp') }});">
                    <div class="slide-caption text-center">
                        <div>
                            <h1>welcome to hotel in Dubai</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, esse.</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide"
                    style="background-image: url({{ asset('assets/admin/images/slider/slider1.webp') }});">
                    <div class="slide-caption text-center">
                        <div>
                            <h1>welcome to hotel in Dubai</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, esse.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- banner section exit-->

    <!-- About section -->
    <section id="about" class="about-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">About Us</h2>
            <p class="text-center">We are a premium hotel offering top-notch services to our valued guests. Located in
                the heart of the city, we combine luxury with convenience.</p>
        </div>
    </section>
    <!-- About section exit-->

    <!-- Room section -->
    <section id="room" class="room-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Our Rooms</h2>
            <div class="row">
                <!-- Room Card 1 -->
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/admin/images/room/room1.webp') }}" class="card-img-top"
                            alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title">Deluxe Room</h5>
                            <p class="card-text">$120 / Night</p>
                            <a href="#book" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Room Card 2 -->
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/admin/images/room/room2.webp') }}" class="card-img-top"
                            alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title">Suite Room</h5>
                            <p class="card-text">$200 / Night</p>
                            <a href="#book" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Room Card 3 -->
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('assets/admin/images/room/room3.webp') }}" class="card-img-top"
                            alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title">Standard Room</h5>
                            <p class="card-text">$80 / Night</p>
                            <a href="#book" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room section exit-->

    <!-- Services section -->
    <section id="services" class="services-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Our Services</h2>
            <div class="row text-center">
                <div class="col-md-4">
                    <i class="fas fa-wifi fa-3x mb-3"></i>
                    <h5>Free Wi-Fi</h5>
                    <p>Stay connected with our high-speed internet.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-swimmer fa-3x mb-3"></i>
                    <h5>Swimming Pool</h5>
                    <p>Relax and unwind in our luxurious pool.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-concierge-bell fa-3x mb-3"></i>
                    <h5>24/7 Service</h5>
                    <p>We are here for you anytime you need us.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Services section exit-->




    <!-- Gallery section -->
    <section id="gallery" class="gallery-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Gallery</h2>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('assets/admin/images/gallery/1.webp') }}" class="img-fluid mb-3"
                        alt="Gallery Image">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/admin/images/gallery/2.webp') }}" class="img-fluid mb-3"
                        alt="Gallery Image">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/admin/images/gallery/3.webp') }}" class="img-fluid mb-3"
                        alt="Gallery Image">
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery section exit-->

    <!-- pricing section -->
    <section id="pricing" class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4 text-uppercase">Our Pricing</h2>
            <p class="mb-5">Choose the perfect plan for your stay. We have a variety of packages to suit your needs.
            </p>
            <div class="row">
                <!-- Basic Plan -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white">
                            <h3>Basic Plan</h3>
                            <h4 class="price">$50 <small>/ night</small></h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li>Single Room</li>
                                <li>Free Wi-Fi</li>
                                <li>Room Service</li>
                                <li>Complimentary Breakfast</li>
                            </ul>
                            <a href="#" class="btn btn-primary mt-3">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Premium Plan -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h3>Premium Plan</h3>
                            <h4 class="price">$100 <small>/ night</small></h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li>Deluxe Room</li>
                                <li>Free Wi-Fi</li>
                                <li>Room Service</li>
                                <li>Access to Pool & Spa</li>
                            </ul>
                            <a href="#" class="btn btn-primary mt-3">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Luxury Plan -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white">
                            <h3>Luxury Plan</h3>
                            <h4 class="price">$200 <small>/ night</small></h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li>Luxury Suite</li>
                                <li>All-Inclusive</li>
                                <li>Room Service</li>
                                <li>Private Pool</li>
                            </ul>
                            <a href="#" class="btn btn-primary mt-3">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pricing section exit -->





    <!-- footer section -->
    <footer class="footer-section" style="background-color: #e5d6d6; color: #fff;">
        <div class="container py-5">
            <div class="row">
                <!-- About Us -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase mb-3">About Us</h5>
                    <p>Our hotel combines luxury and comfort to create unforgettable experiences. Located in the heart
                        of the city, we aim to exceed your expectations.</p>
                </div>
                <!-- Quick Links -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="#about" class="text-white text-decoration-none">About</a></li>
                        <li><a href="#room" class="text-white text-decoration-none">Rooms</a></li>
                        <li><a href="#services" class="text-white text-decoration-none">Services</a></li>
                        <li><a href="#gallery" class="text-white text-decoration-none">Gallery</a></li>
                    </ul>
                </div>
                <!-- Contact Info -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase mb-3">Contact Us</h5>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Luxury Road, City Center</p>
                    <p><i class="fas fa-phone-alt"></i> +1 234 567 890</p>
                    <p><i class="fas fa-envelope"></i> contact@hotel1.com</p>
                </div>
            </div>
            <div class="row text-center mt-4">
                <div class="col">
                    <h6 class="mb-3">Follow Us</h6>
                    <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-white mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white mx-2"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col text-center">
                    <p class="mb-0">&copy; 2024 Hotel1. All Rights Reserved. | Designed by <a href="#"
                            class="text-white text-decoration-none">Your Company</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section exit-->



    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/admin/dist/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
