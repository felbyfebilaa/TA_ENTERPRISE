<?php
// var_dump($rekenings);
// exit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>E-MUA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Satisfy" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/homeAssets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/homeAssets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/homeAssets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/homeAssets/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/homeAssets/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Template Main CSS File -->

    <style>
        .container {
            height: 70vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
        }
    </style>
    <link href="/assets/homeAssets/assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex justify-content-center align-items-center">

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="/#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="/#pricing">Paket MakeUp</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </header><!-- End Header -->

    <!-- <section id="hero"></section> -->

    <section style="padding: 40px 0;"></section>
    <main id="main" style="display:flex; align-items:center;">
        <div class="container">
            <div class="row" style="flex-direction: row; flex-wrap:nowrap;">
                <div class="col-6">
                    <div class="transaksi" style="text-align: center; display:flex; flex-direction:column; justify-content:center; width:auto;">
                        <h1>Transaksi Anda Berhasil</h1>
                        <p>transaksi berhasil.</p>
                        <p id="halaman1">Anda akan diarahkan ke halaman utama dalam <b id="halaman"></b></p>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="data-customer" id="data-customer">
                                <div class="nama-customer flex-between">
                                    <span>Nama Customer</span>
                                    <span><b><?= $transaksi['Nama']; ?></b></span>
                                </div>
                                <div class="nohp-customer flex-between">
                                    <span>No Telepon Customer</span>
                                    <span><b><?= $transaksi['No_HP']; ?></b></span>
                                </div>
                                <div class="tanggal-customer flex-between">
                                    <span>Tanggal MakeUp</span>
                                    <span><b><?= date('d F Y', strtotime($transaksi['tanggal_makeup'])); ?></b></span>
                                </div>
                                <div class="waktu-customer flex-between">
                                    <span>Waktu MakeUp</span>
                                    <span><b><?= $transaksi['waktu_makeup']; ?></b></span>
                                </div>
                                <div class="alamat-customer flex-between">
                                    <span>Alamat</span>
                                    <span><b><?= $transaksi['alamat_makeup']; ?></b></span>
                                </div>
                            </div>
                            <div class="data-paket" style="border-top: 1px solid #dfdfdf; margin-top:10px; padding-top:10px;">
                                <div class="nama-paket flex-between">
                                    <span>Nama Paket</span>
                                    <span><b><?= $transaksi['nama_paket_makeup']; ?></b></span>
                                </div>
                                <div class="harga-paket flex-between">
                                    <span>Harga Paket</span>
                                    <span><b><?= 'Rp ' . number_format($transaksi['harga_paket_makeup'], 0, ',', '.'); ?></b></span>
                                </div>
                                <div class="biaya-admin flex-between">
                                    <span>Biaya Admin</span>
                                    <span><b><?= 'Rp ' . number_format($transaksi['biaya_admin'], 0, ',', '.'); ?></b></span>
                                </div>
                                <div class="total flex-between">
                                    <span>Total Pembayaran</span>
                                    <span><b><?= 'Rp ' . number_format($transaksi['jumlah_pembayaran'], 0, ',', '.'); ?></b></span>
                                </div>
                                <div class="print float-right mt-3">
                                    <a href="/Home/printTransaksi/<?= $transaksi['id_transaksi']; ?>" class="btn btn-primary" id="printBtn">Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- <footer id="footer" style="background:rgb(25 28 31 / 55%); width:100%; position:absolute; bottom:0; padding:30px 0;">
    </footer> -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#halaman1').hide();
        $('#printBtn').on('click', function() {
            $('#halaman1').show();
            var timeleft = 5;
            var downloadTimer = setInterval(function() {
                if (timeleft <= 0) {
                    clearInterval(downloadTimer);
                    window.location = '/'
                }
                document.getElementById('halaman').innerHTML = timeleft + " Detik";
                timeleft -= 1;
            }, 1000);
        })
    </script>
    <script src="/assets/homeAssets/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/assets/homeAssets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/homeAssets/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/assets/homeAssets/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets/homeAssets/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/homeAssets/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="/assets/homeAssets/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/homeAssets/assets/js/main.js"></script>

</body>

</html>