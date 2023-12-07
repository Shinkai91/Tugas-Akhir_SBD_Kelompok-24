<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Data User</title>
</head>

<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;">Store <span class="text-info">Baju</span></a>
        <form class="form-inline">
            <a class="nav-link" href="/admin" style="font-size: 20px; color: #3C4858; margin-right: 15px">Home</a>
            <a class="nav-link" href="/admin/user" style="font-size: 20px; color: #3C4858; margin-right: 15px">Data
                Users</a>
            <a class="nav-link" href="/admin/baju" style="font-size: 20px; color: #3C4858; margin-right: 15px">Data
                Baju</a>
            <a class="nav-link" href="/admin/order" style="font-size: 20px; color: #3C4858; margin-right: 15px">Data
                Orders</a>
            <a class="nav-link" href="/logout" style="font-size: 20px; color: #3C4858; margin-right: 15px">Logout</a>
            <a class="nav-link" href="/admin"
                style="color:#0e56b6; text-decoration:none; font-size: 20px">{{ session()->get('nama') }}</a>
        </form>
    </nav>

    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-lg-12 mt-5">
                <h1 class="heading mb-3">Data User</h1>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <!-- Search bar form -->
        <form class="form-inline mb-4 justify-content-center">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    <div class="container-fluid">
        <div class="container-fluid d-flex justify-content-end">
            <a class="btn btn-danger mb-1" style="width:120px; margin-right: 5px;"
                href="/admin/user/restore">Restore</a>
            <a class="btn btn-danger mb-1" style="width:120px;" href="/admin/user/hardelete">Hard Delete</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Nomor Telpon</th>
                    <th>Alamat</th>
                    <th>Opsi</th>
                </tr>
                @php
                    $number = 1;
                @endphp
                @foreach ($data_user as $key => $data)
                    @if ($data->deleted_at === null)
                        <tr class="text-center">
                            <td>{{ $number }}</td>
                            <td>{{ $data->Nama }}</td>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->no_telp }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>
                                <a class="btn btn-warning" href="/admin/user/edit/{{ $data->ID_Pelanggan }}">Edit</a>
                                <a class="btn btn-danger" style="width:100px;" href="/admin/user/delete/{{ $data->ID_Pelanggan }}">Soft Delete</a>
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
