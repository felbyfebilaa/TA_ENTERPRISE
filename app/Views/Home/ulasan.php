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
                                <form action="/Home/insertUlasan" method="post" enctype="multipart/form-data">
                                    <input type="hidden" value="<?= $paket['id_paket_makeup']; ?>" name="id">
                                    <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="nama_costumer" class="form-control <?= ($validasi->hasError('nama_costumer')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_costumer'); ?>">
                                                <span class="error invalid-feedback"><?= $validasi->getError('nama_costumer'); ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ulasan</td>
                                            <td>:</td>
                                            <td>
                                                <textarea name="ulasan" id="" cols="30" rows="10" class="form-control <?= ($validasi->hasError('ulasan')) ? 'is-invalid' : ''; ?>"><?= ($validasi->hasError('ulasan')) ? '' : old('ulasan'); ?></textarea>
                                                <span class="error invalid-feedback"><?= $validasi->getError('ulasan'); ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="submit-footer mt-4" style="float:right;">
                                        <button type="submit">Simpan</button>
                                    </div>
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