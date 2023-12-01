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
    <title>Order Form</title>
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
        <div class="container-fluid">
            <div class="table-responsive">
                <h2>Keranjang</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $number = 1;
                        @endphp

                        @forelse ($data as $key => $item)
                            @if ($item->deleted_at === null)
                                <tr>
                                    <td>{{ $number }}</td>
                                    <td>{{ $item->nama_baju }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->total_harga }}</td>
                                    <td>
                                        <a class="btn btn-warning"
                                            href="/user/order/edit/{{ $item->ID_Transaksi }}">Edit</a>
                                        <a class="btn btn-danger" style="width:120px"
                                            href="/user/order/delete/{{ $item->ID_Transaksi }}">Delete</a>
                                    </td>
                                </tr>
                                @php
                                    $number++;
                                @endphp
                            @endif
                        @empty
                            <tr>
                                <td colspan="6">Your cart is empty.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <a class="btn btn-success" style="width:120px" href="/user/check">Checkout</a>

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
