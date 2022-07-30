<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Palang Merah Indonesia</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('dist/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('dist/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('dist/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Bikin - v4.7.0
  * Template URL: https://bootstrapmade.com/bikin-free-simple-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.html"><img src="{{ asset('dist/img/PMI.png') }}"
                        class="img-fluid hero-img" alt="" data-aos="zoom-in" data-aos-delay="150" width="500%"></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="getstarted scrollto" href="{{ route('login') }}">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container d-flex flex-column align-items-center justify-content-center" data-aos="fade-up">
            <h1>PALANG MERAH INDONESIA </h1>
            <h2>SISTEM INFORMASI STOK BARANG PMI KOTA PADANG MENGGUNAKAN
                METODE FIFO BERBASIS WEB
            </h2>
            <!-- <a href="#about" class="btn-get-started scrollto">Get Started</a> -->
            <img src="{{ asset('dist/img/PMI.png') }}" class="img-fluid hero-img" alt="" data-aos="zoom-in"
                data-aos-delay="150">
        </div>

    </section><!-- End Hero -->

    <!-- Vendor JS Files -->
    <script src="{{ asset('dist/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('dist/js/main.js') }}"></script>

</body>

</html>
