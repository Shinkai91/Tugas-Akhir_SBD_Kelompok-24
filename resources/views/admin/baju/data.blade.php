<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Data Baju</title>
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

    <div class="container mt-5">
        <form method="POST" action="/admin/baju">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" name="nama_baju" class="form-control" placeholder="Nama Baju">
                </div>
                <div class="col">
                    <input type="text" name="harga" class="form-control" placeholder="Harga">
                </div>
                <div class="col">
                    <input type="text" name="stok" class="form-control" placeholder="Stok">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-custom1 mr-1 mt-2 mb-4"
                        style="width:70px;height:35px;">Add</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-lg-12">
                <h1 class="heading mb-3">Data Baju</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container-fluid d-flex justify-content-end">
            <a class="btn btn-danger mb-1" style="width:120px;" href="/admin/baju/hardelete">Hard Delete</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Baju</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Opsi</th>
                </tr>

                @php
                    $number = 1;
                @endphp

                @foreach ($data_baju as $key => $data)
                    @if ($data->deleted_at === null)
                        <tr class="text-center">
                            <td>{{ $number }}</td>
                            <td>{{ $data->nama_baju }}</td>
                            <td>{{ $data->harga }}</td>
                            <td>{{ $data->stok }}</td>
                            <td>
                                <a class="btn btn-warning" href="/admin/baju/edit/{{ $data->ID_Baju }}">Edit</a>
                                <a class="btn btn-danger" style="width:120px"
                                    href="/admin/baju/delete/{{ $data->ID_Baju }}">Soft Delete</a>
                            </td>
                        </tr>
                        @php
                            $number++;
                        @endphp
                    @endif
                @endforeach
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
