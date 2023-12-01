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
            <a class="nav-link" href="/admin">Home</a>
            <a class="nav-link" href="/admin/user">Data Users</a>
            <a class="nav-link" href="/admin/baju">Data Baju</a>
            <a class="nav-link" href="/admin/order">Data Orders</a>
            <a class="nav-link" href="/logout">Logout</a>
            <a class="nav-link" style="color:#3C4858; font-family: 'Roboto', sans-serif; font-weight: bold;" href="/admin">{{ session()->get('nama') }}</a>
        </form>
    </nav>

    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-lg-12 mt-5">
                <h1 class="heading mb-3">Data User</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container-fluid d-flex justify-content-end">
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
                @foreach ($data_user as $key => $data)
                    @if ($data->deleted_at === null)
                        <tr class="text-center">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->Nama }}</td>
                            <td>{{ $data->username }}</td>
                            <td>{{ $data->no_telp }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>
                                <a class="btn btn-warning" href="/admin/user/edit/{{ $data->ID_Pelanggan }}">Edit</a>
                                <a class="btn btn-danger" style="width:100px;"
                                    href="/admin/user/delete/{{ $data->ID_Pelanggan }}">Soft Delete</a>
                            </td>
                        </tr>
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
