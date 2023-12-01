<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title>Welcome Page</title>
</head>

<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;">Store <span class="text-info">Baju</span></a>
        <form class="form-inline">
            <a class="nav-link" href="/admin" style="font-size: 20px; color: #3C4858; margin-right: 15px">Home</a>
            <a class="nav-link" href="/admin/user" style="font-size: 20px; color: #3C4858; margin-right: 15px">Data Users</a>
            <a class="nav-link" href="/admin/baju" style="font-size: 20px; color: #3C4858; margin-right: 15px">Data Baju</a>
            <a class="nav-link" href="/admin/order" style="font-size: 20px; color: #3C4858; margin-right: 15px">Data Orders</a>
            <a class="nav-link" href="/logout" style="font-size: 20px; color: #3C4858; margin-right: 15px">Logout</a>
            <a class="nav-link" href="/admin" style="color:#0e56b6; text-decoration:none; font-size: 20px">{{ session()->get('nama') }}</a>
        </form>
    </nav>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="3000">
                <h1 class="heading mb-3">Selamat Datang Di Halaman Admin</h1>
                <p class="para-desc text-muted">
                    Dapatkan penampilan terbaik Anda dengan koleksi fashion terbaru di toko baju kami. Kami menyediakan
                    pilihan
                    pakaian trendy untuk semua gaya dan kesempatan. Temukan gaya Anda dengan berbagai pilihan baju,
                    aksesoris, dan sepatu yang sesuai dengan keinginan Anda.
                    Kualitas dan gaya tidak pernah kompromi - kami menawarkan produk berkualitas tinggi yang dirancang
                    untuk
                    memberikan kepercayaan diri maksimal kepada pelanggan kami.
                    Jelajahi katalog kami sekarang dan temukan pakaian yang cocok untuk setiap suasana, dari gaya kasual
                    hingga
                    formal. Kunjungi toko baju kami untuk pengalaman berbelanja yang menyenangkan dan penuh gaya.
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">
                <div class="text-md-right text-center"><img src="{{ asset('images/atl-2-c.png') }}" class="img-fluid"
                        style="width:70%"></div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('scroll', (e) => {
            const nav = document.querySelector('.navbar');
            if (window.pageYOffset > 0) {
                nav.classList.add("add-shadow");
            } else {
                nav.classList.remove("add-shadow");
            }
        });

        AOS.init();
    </script>
@include('sweetalert::alert')
</body>

</html>
