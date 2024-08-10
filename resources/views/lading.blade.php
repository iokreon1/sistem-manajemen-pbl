<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Laravel Project</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top-nav">
        <div class="container">
            <a class="navbar-brand font-judul" href="#">PBLHUB</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav mx-auto"> <!-- Menggunakan mx-auto untuk menengahkan menu -->
                <li class="nav-item">
                    <a class="nav-link font-menu" href="#" style="font-weight: bold;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-menu" href="#" style="font-weight: bold;">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-menu" href="#" style="font-weight: bold;">Menu</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/login" ><button type="button" class="btn btn-primary font-menu">Login</button></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="position-absolute col-md-2 pl-0" style="left: 0; top: 0; margin-top: 140px;">
    <img src="{{ asset('assets/images/Ellipse1.png') }}" alt="Image" class="img-fluid">
</div>

<div class="container mt-2 pt-5">
    <div class="row center-content">
        <div class="col-md-3 offset-md-1">
            <p class="roboto-font">Politeknik Negeri Semarang</p>
            <div class="poppins-extra-bold">
                Where Projects Meet Progress in <br>Learning
            </div>
            <p class="poppins-regular">Project-based learning (PBL) is an educational approach where students actively explore real-world problems and challenges, and work collaboratively to develop solutions </p>
            <button type="button" class="btn btn-primary-2 font-menu">Showcase PBL</button>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('assets/images/LandingPage.png') }}" alt="Image" class="center-image">
        </div>
    </div>
</div>

<div class="container mt-0 pt-3">
    <div class="row center-content">
        <div class="col-md-6 text-center">
            <img src="{{ asset('assets/images/2ndLanding.png') }}" alt="Placeholder Image" class="image-2nd">
        </div>
        <div class="col-md-5 pt-4">
            <!-- Konten baru -->
            <p class="poppins-bold">Insan Perguruan Tinggi</p>
            <p class="poppins-regular">Dosen Perguruan Tinggi Negeri</p>
            <div class="row"> <!-- Menambahkan row di dalam col-md-5 -->
                <div class="col-md-6 pt-4">
                    <img src="{{ asset('assets/images/kerja_sama_icon.png') }}" alt="Image" class="icon1">
                    <p class="roboto-font">Kolaborasi</p>
                    <div class="poppins-default">
                        Membuka peluang kolaborasi dan himpun ide solutif
                    </div>
                </div>
                <div class="col-md-6 pt-4 pb-5">
                    <img src="{{ asset('assets/images/Target_Icon.png') }}" alt="Image" class="icon1">
                    <p class="roboto-font">Tepat Sasaran</p>
                    <div class="poppins-default">
                        Buka koneksi keseluruh peserta dan membangun kerja sama
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary-2 font-menu">Learn More</button>
        </div>   
    </div>
</div>
<div class="container mt-4 center-content banner">
    <div class="position-relative justify-content-between">
        <img src="{{ asset('assets/images/rectangle2.png') }}" alt="Gambar" class="image-4nd">

        <div class="row position-absolute image-3nd">
            <h3 class="poppins-extra-bold text2">Start your project<br>
            with us</h3>
            <button type="button" class="btn btn-3 font-menu">Let's talk</button>
        </div>
    </div>
</div>

<div class="container mt-3 foot">
    <div class="row">
        <div class="col">
            <h3 class="mb-4 font-sosmed">PBLHUB</h3>
            <p class="font2">Project-based learning is a method of instruction in which students are given a challenging question to answer or problem to solved.</p>
        </div>
        <div class="col">
            <h3 class="mb-4 font-sosmed">Company2</h3>
            <p class="font2">About Us</p>
            <p class="font2">Service</p>
            <p class="font2">Case Studies</p>
            <p class="font2">Blog</p>
            <p class="font2">Contact</p>

        </div>
        <div class="col">
            <h3 class="mb-4 font-sosmed">Support</h3>
            <p class="font2">Comunity</p>
            <p class="font2">Resaource</p>
            <p class="font2">Faqs</p>
            <p class="font2">Privacy Police</p>
            <p class="font2">Careers</p>
        </div>
        <div class="col">
            <h3 class="mb-4 font-sosmed">Social</h3>
            <div class="row">
                <img src="{{ asset('assets/images/instagram.png') }}">
                <img src="{{ asset('assets/images/Facebook.png') }}">
                <img src="{{ asset('assets/images/Twiter.png') }}">
                <img src="{{ asset('assets/images/youtube.png') }}">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
