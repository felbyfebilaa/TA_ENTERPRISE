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
                <li><a class="nav-link scrollto active" href="/#pricing">Paket MakeUp</a></li>
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
                                    <img src="/assets/foto/<?= $paket['Foto_Paket']; ?>" height="300" alt="" style="box-shadow: 0 0 4px rgb(0 0 0), 0 1px 3px rgb(0 0 0);">
                                </div>
                                <div class="judul-paket" style="padding: 10px 0;">
                                    <h3 style="margin: 0;"><?= $paket['Nama_Paket']; ?></h3>
                                </div>
                                <div class="desc">
                                    <p>
                                        <?= nl2br($paket['Deskripsi_Paket']); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="right-content">
                                <form action="/Home/insertReservasi" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="<?= $paket['id_paket']; ?>" name="id">
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
                                            <td>NIK/KTP</td>
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
                                            <td>Tanggal Makeup</td>
                                            <td>:</td>
                                            <td>
                                                <input type="date" name="tgl_pemotretan" value="<?= date('Y-m-d'); ?>" class="form-control <?= ($validasi->hasError('tgl_pemotretan')) ? 'is-invalid' : ''; ?>">
                                                <span class="error invalid-feedback"><?= $validasi->getError('tgl_pemotretan'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Makeup</td>
                                            <td>:</td>
                                            <td>
                                                <select name=" waktu_pemotretan" id="" class="custom-select <?= ($validasi->hasError('waktu_pemotretan')) ? 'is-invalid' : ''; ?>">
                                                    <option value=" Pagi">Pagi</option>
                                                    <option value="Siang">Siang</option>
                                                </select>
                                                <span class="error invalid-feedback"><?= $validasi->getError('waktu_pemotretan'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi Acara</td>
                                            <td>:</td>
                                            <td>
                                                <textarea name="lokasi_pemotretan" id="" cols="30" rows="10" class="form-control <?= ($validasi->hasError('lokasi_pemotretan')) ? 'is-invalid' : ''; ?>"><?= ($validasi->hasError('lokasi_pemotretan')) ? '' : old('lokasi_pemotretan'); ?></textarea>
                                                <span class="error invalid-feedback"><?= $validasi->getError('lokasi_pemotretan'); ?></span>
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
                                    <div class="harga" style="display: flex;justify-content:space-between; border-top:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; padding:10px 0; margin:10px 0;">
                                        <div class="judul-harga" style="display: flex; flex-direction:column;">
                                            <span><b>Harga Paket <?= $paket['Nama_Paket']; ?></b></span>
                                            <span><b>Biaya Admin</b></span>
                                            <span><b>Total Tagihan</b></span>
                                        </div>
                                        <div class="sub-harga" style="display: flex; flex-direction:column; text-align:right;">
                                            <?php
                                            $admin = 'Rp ' . number_format(5000, 2, ',', '.');
                                            $harga = 'Rp ' . number_format($paket['Harga_Paket'], 2, ',', '.');
                                            $total = $paket['Harga_Paket'] + 5000;
                                            $subtotal = 'Rp  ' . number_format($total, 2, ',', '.');
                                            ?>
                                            <span><?= $harga; ?></span>
                                            <span><?= $admin; ?></span>
                                            <span><?= $subtotal; ?></span>
                                        </div>
                                    </div>
                                    <div class="footer-reservasi">
                                        <p>No. Rekening <b id="no_rek"></b> A/N <b id="an"></b></p>
                                    </div>
                                    <div class="submit-footer" style="float:right;">
                                        <button type="submit">Order</button>
                                        <button type="reset">Reset</button>
                                    </div>
                                    <input type="hidden" name="total" value="<?= $total; ?>">
                                    <input type="hidden" name="admin" value="50000">
                                </form>
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
        })
        $('#rekening').on('change', function() {
            $('.harga').show();
            $('.footer-reservasi').show();
            $('#no_rek').empty();
            $('#an').empty();
            id = $(this).val();
            // console.log(id)
            $.ajax({
                url: '/Home/getNoRek/' + id,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    atas_nama = data.atas_nama;
                    no_rek = data.no_rekening;
                    $('#no_rek').append(no_rek);
                    $('#an').append(atas_nama);
                }
            })
        })

        // function rekening(id) {
        //     console.log('berhasil');
        //     $.ajax({
        //         url: '/Home/getNoRek' + id
        //     })
        // }
        // $(document).ready(() => {
        //     function rekening() {

        //     }
        // })
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