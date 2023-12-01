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
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <title>History</title>
</head>

<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;">Store <span class="text-info">Baju</span></a>
        <form class="form-inline">
            <a class="nav-link" href="/user" style="font-size: 20px; color: #3C4858; margin-right: 15px">Home</a>
            <a class="nav-link" href="/user/order" style="font-size: 20px; color: #3C4858; margin-right: 15px">Order</a>
            <a class="nav-link" href="/user/cart"
                style="font-size: 20px; color: #3C4858; margin-right: 15px">Keranjang</a>
            <a class="nav-link" href="/user/history"
                style="font-size: 20px; color: #3C4858; margin-right: 15px">History</a>
            <a class="nav-link" href="/logout" style="font-size: 20px; color: #3C4858; margin-right: 15px">Logout</a>
            <a class="nav-link"
                style="color:#0e56b6; text-decoration:none; font-size: 20px">{{ session()->get('nama') }}</a>
        </form>
    </nav>

    <div class="container" style="max-width:1200px;margin-top:3%;margin-bottom:10%" data-aos="fade-up">
        <div class="row justify-content-center">
            <form class="form-inline mb-4 justify-content-center">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                    name="search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="container-fluid">
                <div class="table-responsive">
                    <h2>History</h2>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Baju</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Alamat</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $key => $item)
                                @if ($item->status !== null)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nama_baju }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->total_harga }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->metode_pembayaran }}</td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="14">Your History is Empty.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
