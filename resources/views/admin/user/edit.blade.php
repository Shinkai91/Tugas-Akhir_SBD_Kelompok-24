<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Edit User</title>
</head>

<body style="height:100%">
    <nav class="navbar navbar-light sticky-top justify-content-between" id="navbar">
        <a class="navbar-brand font-weight-bold" style="color:#3C4858;" data-aos="fade-right"
            data-aos-duration="3000">Store <span class="text-info">Baju</span></a>
    </nav>

    <div class="container" style="max-width:65%;margin-top:3%;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="padding-bottom:20%;">
                    <div class="card-header">Edit Data User</div>
                    <div class="card-body">
                        <form method="POST" action="/admin/user/update">
                            @csrf
                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" name="id"
                                        value="{{ $data->ID_Pelanggan }}">
                                    <input type="text" class="form-control" name="username"
                                        value="{{ $data->username }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_telp" class="col-md-4 col-form-label text-md-right">Phone</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="no_telp"
                                        value="{{ $data->no_telp }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Nama" class="col-md-4 col-form-label text-md-right">Nama</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="Nama"
                                        value="{{ $data->Nama }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="alamat"
                                        value="{{ $data->alamat }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password"
                                        value="{{ $data->password }}">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a class="btn btn-secondary" href="/admin/user">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
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
    </script>
    @include('sweetalert::alert')
</body>

</html>
