<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Checkout</title>
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
                    <div class="card-header">Checkout</div>
                    <div class="card-body">
                        <form method="POST" action="/user/checkout">
                            @csrf
                            <div class="form-group row">
                                <label for="Alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="alamat"
                                        value="{{ $data->alamat != 'NULL' ? $data->alamat : '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Metode_Pembayaran" class="col-md-4 col-form-label text-md-right">Metode
                                    Pembayaran</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="metode_pembayaran" id="metode_pembayaran">
                                        <option value="BCA"
                                            {{ $data->metode_pembayaran == 'BCA' ? 'selected' : '' }}>BCA</option>
                                        <option value="BRI"
                                            {{ $data->metode_pembayaran == 'BRI' ? 'selected' : '' }}>BRI</option>
                                        <option value="BNI"
                                            {{ $data->metode_pembayaran == 'BNI' ? 'selected' : '' }}>BNI</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="nomor_rekening_input" style="display: none;">
                                <label for="Nomor_Rekening" class="col-md-4 col-form-label text-md-right">Nomor
                                    Rekening</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nomor_rekening"
                                        value="{{ $nomorRekening[$data->metode_pembayaran] ?? '' }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Total_harga" class="col-md-4 col-form-label text-md-right">Total Harga</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="total_harga" value="{{ $totalHarga }}" readonly>
                                </div>
                            </div>                            

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4"> <button type="submit"
                                        class="btn btn-primary">Checkout</button>
                                    <a class="btn btn-secondary" href="/user/cart">Cancel</a>
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

        // Ambil elemen metode_pembayaran
        var metodePembayaran = document.getElementById('metode_pembayaran');
        // Ambil elemen nomor_rekening_input
        var nomorRekeningInput = document.getElementById('nomor_rekening_input');
        // Ambil elemen alamat
        var alamatInput = document.querySelector('input[name="alamat"]');

        // Struktur data Nomor Rekening untuk setiap metode pembayaran
        var nomorRekeningData = {
            'BNI': '1234523',
            'BRI': '1112222222',
            'BCA': '123123'
        };

        // Tambahkan event listener untuk perubahan pada elemen metode_pembayaran
        metodePembayaran.addEventListener('change', function() {
            // Tampilkan atau sembunyikan input Nomor Rekening berdasarkan pilihan metode pembayaran
            nomorRekeningInput.style.display = (this.value !== 'NULL') ? 'flex' : 'none';

            // Set nilai default Nomor Rekening berdasarkan pilihan metode pembayaran
            document.getElementsByName('nomor_rekening')[0].value = nomorRekeningData[this.value] || '';

            // Console log data alamat dan metode_pembayaran
            console.log('Alamat:', alamatInput.value);
            console.log('Metode Pembayaran:', this.value);
        });
    </script>
    @include('sweetalert::alert')
</body>

</html>