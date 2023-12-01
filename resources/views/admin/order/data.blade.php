<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Data Order</title>
</head>

<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;">Store <span class="text-info">Baju</span></a>
        <form class="form-inline">
            <a class="nav-link" href="/admin">Home</a>
            <a class="nav-link" href="/admin/user">Data Users</a>
            <a class="nav-link" href="/admin/baju">Data Baju</a>
            <a class="nav-link" href="/admin/order">Data Orders</a>
            <a class="nav-link" href="/logout">Logout</a>
            <a class="nav-link" style="color:#3C4858; font-family: 'Roboto', sans-serif; font-weight: bold;"
                href="/admin">{{ session()->get('nama') }}</a>
        </form>
    </nav>

    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-lg-12">
                <h1 class="heading mb-3">Data Order</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Produk</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Alamat</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $number = 1;
                    @endphp
                    @forelse ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->Nama }}</td>
                            <td>{{ $item->nama_baju }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->total_harga }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->metode_pembayaran }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a class="btn btn-warning" href="/admin/order/edit/{{ $item->ID_Transaksi }}">Edit</a>
                                <a class="btn btn-danger" style="width:120px"
                                    href="/admin/order/delete/{{ $item->ID_Transaksi }}">Delete</a>
                            </td>
                        </tr>
                        @php
                            $number++;
                        @endphp
                    @empty
                        <tr>
                            <td colspan="14">Your cart is empty.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
    </script>
    @include('sweetalert::alert')
</body>

</html>