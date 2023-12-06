<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Edit Order</title>
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
                    <div class="card-header">Edit Data Order</div>
                    <div class="card-body">
                        <form method="POST" action="/admin/order/update">
                            @csrf
                            <div class="form-group row">
                                <label for="Nama_baju" class="col-md-4 col-form-label text-md-right">Nama Baju</label>
                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" name="ID_Transaksi" value="{{$data->ID_Transaksi}}">
                                    <input type="text" class="form-control" name="nama_baju" value="{{ $data->nama_baju }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Tanggal" class="col-md-4 col-form-label text-md-right">Tanggal</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="tanggal"
                                        value="{{ $data->tanggal }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Jumlah" class="col-md-4 col-form-label text-md-right">Jumlah</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="jumlah"
                                        value="{{ $data->jumlah }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Total_harga" class="col-md-4 col-form-label text-md-right">Total Harga</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="total_harga"
                                        value="{{ $data->total_harga }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="alamat"
                                        value="{{ $data->alamat }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Metode_pembayaran" class="col-md-4 col-form-label text-md-right">Metode Pembayaran</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="metode_pembayaran"
                                        value="{{ $data->metode_pembayaran }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Status" class="col-md-4 col-form-label text-md-right">Status</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="status">
                                        <option value="proses" @if($data->status === 'proses') selected @endif>proses</option>
                                        <option value="pengiriman" @if($data->status === 'pengiriman') selected @endif>pengiriman</option>
                                        <option value="tiba" @if($data->status === 'tiba') selected @endif>tiba</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a class="btn btn-secondary" href="/admin/order">Cancel</a>
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
