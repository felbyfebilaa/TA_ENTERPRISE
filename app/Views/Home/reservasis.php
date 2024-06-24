<?php
// var_dump($rekenings);
// exit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <title>Reserve E-MUA</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template Main CSS File -->
    <link href="/assets/homeAssets/assets/css/style.css" rel="stylesheet">


    <!-- <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" /> -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .submit-footer>button {
            background: #FFB1B1;
            display: inline-block;
            padding: 8px 35px;
            border-radius: 4px;
            color: #fff;
            transition: none;
            font-size: 14px;
            font-weight: 400;
            font-family: "Raleway", sans-serif;
            font-weight: 600;
            transition: 0.3s;
            border: 0;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex justify-content-center align-items-center">

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="/#hero">Home</a></li>
                <li><a class="nav-link scrollto active" href="/#pricing">MakeUp Package</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </header><!-- End Header -->

    <!-- <section id="hero"></section> -->

    <section style="padding: 40px 0;"></section>
    <main id="main" style="display:flex; align-items:center;">
        <div class="container">
            <div class="row">
                <div class="card" style="padding: 0; margin:2% 0;">
                    <div class="card-body">
                        <div class="content" style="display: flex; justify-content:space-between;">
                            <div class="left-content" style="width: 45%;border-right: 1px solid #dcdcdc; display:flex; flex-direction:column; align-items:center;">
                                <div class="gambar">
                                    <img src="/assets/fotoMakeup/<?= $paket['foto_paket_makeup']; ?>" height="300" alt="" style="box-shadow: 0 0 4px rgb(0 0 0), 0 1px 3px rgb(0 0 0);">
                                </div>
                                <div class="judul-paket" style="padding: 10px 0;">
                                    <h3 style="margin: 0;"><?= $paket['nama_paket_makeup']; ?></h3>
                                </div>
                                <div class="desc">
                                    <p>
                                        <?= nl2br($paket['deskripsi_paket_makeup']); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="right-content">
                                <form action="/Home/insertReservasis" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="<?= $paket['id_paket_makeup']; ?>" name="id">
                                    <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="nama" class="form-control <?= ($validasi->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?= old('nama'); ?>">
                                                <span class="error invalid-feedback"><?= $validasi->getError('nama'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>KTP</td>
                                            <td>:</td>
                                            <td>
                                                <input type=" text" name="nik" class="form-control <?= ($validasi->hasError('nik')) ? 'is-invalid' : ''; ?>" value="<?= old('nik'); ?>">
                                                <span class="error invalid-feedback"><?= $validasi->getError('nik'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No Telepon</td>
                                            <td>:</td>
                                            <td>
                                                <input type=" text" name="no_hp" class="form-control <?= ($validasi->hasError('no_hp')) ? 'is-invalid' : ''; ?>" value="<?= old('no_hp'); ?>">
                                                <span class="error invalid-feedback"><?= $validasi->getError('no_hp'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>
                                                <input type=" text" name="alamat" class="form-control <?= ($validasi->hasError('alamat')) ? 'is-invalid' : ''; ?>" value="<?= old('alamat'); ?>">
                                                <span class="error invalid-feedback"><?= $validasi->getError('alamat'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Booking</td>
                                            <td>:</td>
                                            <td>
                                                <input type="date" name="tanggal_booking" value="<?= date('Y-m-d'); ?>" class="form-control <?= ($validasi->hasError('tanggal_booking')) ? 'is-invalid' : ''; ?>">
                                                <span class="error invalid-feedback"><?= $validasi->getError('tanggal_booking'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Makeup</td>
                                            <td>:</td>
                                            <td>
                                                <input type="date" name="tanggal_makeup" value="<?= date('Y-m-d'); ?>" class="form-control <?= ($validasi->hasError('tanggal_makeup')) ? 'is-invalid' : ''; ?>">
                                                <span class="error invalid-feedback"><?= $validasi->getError('tanggal_makeup'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Makeup</td>
                                            <td>:</td>
                                            <td>
                                                <select name=" waktu_makeup" id="" class="custom-select <?= ($validasi->hasError('waktu_makeup')) ? 'is-invalid' : ''; ?>">
                                                    <option value=" Pagi">Pagi</option>
                                                    <option value="Siang">Siang</option>
                                                </select>
                                                <span class="error invalid-feedback"><?= $validasi->getError('waktu_makeup'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi Acara</td>
                                            <td>:</td>
                                            <td>
                                                <textarea name="alamat_makeup" id="" cols="30" rows="4" class="form-control <?= ($validasi->hasError('alamat_makeup')) ? 'is-invalid' : ''; ?>"><?= ($validasi->hasError('alamat_makeup')) ? '' : old('alamat_makeup'); ?></textarea>
                                                <span class="error invalid-feedback"><?= $validasi->getError('alamat_makeup'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harga Paket Makeup</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="harga_paket_makeup" id="harga_paket_makeup" class="form-control <?= ($validasi->hasError('harga_paket_makeup')) ? 'is-invalid' : ''; ?>" value="<?= old('harga_paket_makeup', $paket['harga_paket_makeup']); ?>" readonly>
                                                <span class="error invalid-feedback"><?= $validasi->getError('harga_paket_makeup'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Admin</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="biaya_admin" id="biaya_admin" class="form-control <?= ($validasi->hasError('biaya_admin')) ? 'is-invalid' : ''; ?>" value="<?= old('subtotal', 5000); ?>" readonly>
                                                <span class="error invalid-feedback"><?= $validasi->getError('biaya_admin'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="subtotal" id="subtotal" class="form-control <?= ($validasi->hasError('subtotal')) ? 'is-invalid' : ''; ?>" value="<?= old('subtotal', 0); ?>" readonly>
                                                <span class="error invalid-feedback"><?= $validasi->getError('subtotal'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Pembayaran</td>
                                            <td>:</td>
                                            <td>
                                                <select name=" jenis_pembayaran" id="rekening" class="custom-select <?= ($validasi->hasError('jenis_pembayaran')) ? 'is-invalid' : ''; ?>">
                                                    <option value="" selected disabled>-pilih jenis pembayaran-</option>
                                                    <?php foreach ($rekenings as $r => $rekening) : ?>
                                                        <option value="<?= $rekening['id']; ?>"><?= $rekening['nama_rekening']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="error invalid-feedback"><?= $validasi->getError('jenis_pembayaran'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No Rekening</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="no_rekening" id="no_rekening" class="form-control <?= ($validasi->hasError('no_rekening')) ? 'is-invalid' : ''; ?>" value="<?= old('no_rekening'); ?>" readonly>
                                                <span class="error invalid-feedback"><?= $validasi->getError('no_rekening'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Atas Nama</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="atas_nama" id="atas_nama" class="form-control <?= ($validasi->hasError('atas_nama')) ? 'is-invalid' : ''; ?>" value="<?= old('atas_nama'); ?>" readonly>
                                                <span class="error invalid-feedback"><?= $validasi->getError('atas_nama'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Pembayaran</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control <?= ($validasi->hasError('jumlah_pembayaran')) ? 'is-invalid' : ''; ?>" value="<?= old('jumlah_pembayaran'); ?>">
                                                <span class="error invalid-feedback"><?= $validasi->getError('jumlah_pembayaran'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bukti Pembayaran</td>
                                            <td>:</td>
                                            <td>
                                                <div>
                                                    <input type="file" name="bukti_pembayaran">
                                                    <?php if ($validasi->hasError('bukti_pembayaran')) : ?>
                                                        <p style="color: red; font-size: 80%;"><?= $validasi->getError('bukti_pembayaran'); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="submit-footer mt-4" style="float:right;" >
                                        <button type="submit">Order</button>
                                        <button type="reset">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php if (session()->get('pesan')) : ?>
        <script>
            $(document).ready(function() {
                toastr.error("<?= session()->getFlashdata('pesan'); ?>");
            })
        </script>
    <?php endif; ?>
    <script>
        $(document).ready(function() {
            $('.harga').hide();
            $('.footer-reservasi').hide();
            let hargaPaket = $('#harga_paket_makeup').val();
            let biayaAdmin = $('#biaya_admin').val();
            let subtotal = parseInt(hargaPaket) + parseInt(biayaAdmin);
            $('#subtotal').val(subtotal);
        })
        $('#rekening').on('change', function() {
            id = $(this).val();
            // console.log(id)
            $.ajax({
                url: '/Home/getNoRek/' + id,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    $('#no_rekening').val(data.no_rekening);
                    $('#atas_nama').val(data.atas_nama);
                }
            })
        });


    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- jQuery -->
    <script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/assets/adminlte/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="/assets/adminlte/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="/assets/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="/assets/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/assets/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/assets/adminlte/plugins/moment/moment.min.js"></script>
    <script src="/assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/assets/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/adminlte/dist/js/adminlte.js"></script>

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