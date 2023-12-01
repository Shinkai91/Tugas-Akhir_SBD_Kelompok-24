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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Store Baju</title>
</head>

<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;">Store <span class="text-info">Baju</span></a>
        <form class="form-inline">
            <a href="/user/login"><button type="button" class="btn btn-primary btn-custom1 mr-1">Pelanggan</button></a>
            <a href="/admin/login"><button type="button" class="btn btn-primary btn-custom1 mr-1">Admin</button></a>
            <a href="/user/register"><button type="button" class="btn btn-primary btn-custom2">Register</button></a>
        </form>
    </nav>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="3000">
                <h1 class="heading mb-3">Temukan Gaya Terbaru di Toko Baju Kami
                    <span class="text-primary">Fashion Terkini.</span>
                </h1>
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


    <section class="section bg-light">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#FFFFFF" fill-opacity="1"
                d="M0,256L26.7,229.3C53.3,203,107,149,160,122.7C213.3,96,267,96,320,106.7C373.3,117,427,139,480,122.7C533.3,107,587,53,640,53.3C693.3,53,747,107,800,138.7C853.3,171,907,181,960,165.3C1013.3,149,1067,107,1120,96C1173.3,85,1227,107,1280,133.3C1333.3,160,1387,192,1413,208L1440,224L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z">
            </path>
        </svg>
        <div class="container">
            <div class="col-lg-12 text-center">
                <h4 class="title mb-3" data-aos="fade-down" data-aos-duration="3000">Our Products</h4>
                <p class="text-muted para-desc mx-auto mb-4" data-aos="fade-down" data-aos-duration="2000">
                    Various kinds of products that we provide in
                    <a class="text-primary font-weight-bold" href="#">Store Laptop</a></span>.
                </p>
            </div>
            <div class="card-deck">
                <div class="card" data-aos="fade-right" data-aos-duration="3000">
                    <img class="card-img-top" src="{{ asset('images/product/baju-1.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Makoto Shinkai Short Sleeve UT</h5>
                        <p class="card-text">Limited-edition Uniqlo t-shirts (UTs) will be based on the worlds of
                            "Your Name," "Weathering With You," and the upcoming "Suzume."</p>
                        <p class="card-text"><small class="text-muted">IDR 199 K</small></p>
                    </div>
                </div>
                <div class="card" data-aos="fade-down" data-aos-duration="3000">
                    <img class="card-img-top" src="{{ asset('images/product/baju-2.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Makoto Shinkai Short Sleeve UT</h5>
                        <p class="card-text">Limited-edition Uniqlo t-shirts (UTs) will be based on the worlds of
                            "Your Name," "Weathering With You," and the upcoming "Suzume."</p>
                        <p class="card-text"><small class="text-muted">IDR 199 K</small></p>
                    </div>
                </div>
                <div class="card" data-aos="fade-left" data-aos-duration="3000">
                    <img class="card-img-top" src="{{ asset('images/product/baju-3.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Makoto Shinkai Short Sleeve UT</h5>
                        <p class="card-text">Limited-edition Uniqlo t-shirts (UTs) will be based on the worlds of
                            "Your Name," "Weathering With You," and the upcoming "Suzume."</p>
                        <p class="card-text"><small class="text-muted">IDR 199 K</small></p>
                    </div>
                </div>
            </div>
    </section>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#F8F9FA" fill-opacity="1"
            d="M0,288L34.3,277.3C68.6,267,137,245,206,208C274.3,171,343,117,411,133.3C480,149,549,235,617,256C685.7,277,754,235,823,197.3C891.4,160,960,128,1029,144C1097.1,160,1166,224,1234,245.3C1302.9,267,1371,245,1406,234.7L1440,224L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z">
        </path>
    </svg>
    <section style="background-color: #202942;padding-bottom:20px">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,288L34.3,277.3C68.6,267,137,245,206,208C274.3,171,343,117,411,133.3C480,149,549,235,617,256C685.7,277,754,235,823,197.3C891.4,160,960,128,1029,144C1097.1,160,1166,224,1234,245.3C1302.9,267,1371,245,1406,234.7L1440,224L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z">
            </path>
        </svg>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="jumbotron" style="text-align: center;background-color: #202942;" data-aos="fade-up"
                    data-aos-duration="3000">
                    <a href="https://github.com/Shinkai91" style="font-size:30px" class="fa fa-github"></a>
                    <h6 style="color:rgb(223, 223, 223);">Kelompok 24</h6>
                    <h6 style="color:rgb(223, 223, 223);">&#169; {{ date('Y') }}</h6>
                    <h4 style="color:rgb(158, 158, 158)">Praktikum SBD</h4>
                    <a href="#" class="fa fa-angle-up"
                        style="margin-bottom: -10%;color:rgb(223, 223, 223);"></a>
                    <a href="#" onclick="window.scrollTo(0, 0);" style="text-decoration:none;">
                        <h4 style="color:rgb(158, 158, 158)">Back To Top</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>

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
