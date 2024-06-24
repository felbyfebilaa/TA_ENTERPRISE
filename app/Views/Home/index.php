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

<!--    ====================== hit API google map api-->
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
        function initialize() {
            var propertiPeta = {
            
                center:new google.maps.LatLng(-0.2566559999829959, 100.62325699961397),
                zoom:9,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

            // membuat Marker
            var marker=new google.maps.Marker({
                position: new google.maps.LatLng(-0.2566559999829959, 100.62325699961397),
                map: peta,
                animation: google.maps.Animation.BOUNCE
            });

        }

        // event jendela di-load
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<!--    ======================================================================-->


    <!-- Template Main CSS File -->
    <link href="/assets/homeAssets/assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex justify-content-center align-items-center header-transparent">

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#galeri">Gallery</a></li>
                <li><a class="nav-link scrollto" href="#pricing">Package</a></li>
                <li><a class="nav-link scrollto" href="#map">Location</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </header><!-- End Header -->
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <h1>Makeup by eby</h1>
            <h2>"Menjadi Cantik di Setiap Momen Berharga!"</h2>
            <a href="#pricing" class="btn-scroll scrollto" title="Scroll Down"><i class="bx bx-chevron-down"></i></a>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Pricing Section ======= -->
        <section id="galeri" class="pricing">
            <div class="container">

                <div class="section-title">
                    <span>Gallery</span>
                    <h2>Makeup Gallery</h2>
                </div>

                <div class="row" style="justify-content: center;">

                    <?php
                    foreach ($galeri as $p => $g) :
                        $desc = nl2br($g['deskripsi']);
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="box" style="min-height: 750px">
                                <div class="gambar" style="height: 100%; width:100%; box-shadow: 0px 0px 4px rgb(0 0 0);">
                                    <img src="/assets/fotoGaleri/<?= $g['foto_galeri']; ?>" alt="" style="width: 100%;height: 250px;object-fit: contain;">
                                </div>
                                <h3><?= $g['nama_galeri']; ?></h3>
                                <div class="desc" style="min-height: 210px">
                                    <p style="text-align: center;">
                                        <?= $desc; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section id="pricing" class="pricing">
            <div class="container">

                <div class="section-title">
                    <span>Package</span>
                    <h2>MakeUp Package</h2>
                </div>

                <div class="row" style="justify-content: center;" >

                    <?php
                    foreach ($paket as $p => $values) :
                        $harga = number_format($values['harga_paket_makeup'], 0, ',', '.');
                        $desc = nl2br($values['deskripsi_paket_makeup']);
                    ?>
                        <div class="col-lg-4 col-md-6" >
                            <div class="box" style="min-height: 750px">
                                <div class="gambar" style="height: 100%; width:100%; box-shadow: 0px 0px 4px rgb(0 0 0);">
                                    <img src="/assets/fotoMakeup/<?= $values['foto_paket_makeup']; ?>" alt="" style="width: 100%; height: 250px;object-fit: contain;">
                                </div>
                                <h3><?= $values['nama_paket_makeup']; ?></h3>
                                <h4><sup>Rp</sup><?= $harga; ?></h4>
                                <div class="desc" style="min-height: 210px">
                                    <p style="text-align: center;">
                                        <?= $desc; ?>
                                    </p>
                                </div>
                                <div class="btn-wrap">
                                    <a href="/Home/ulasan/<?= $values['id_paket_makeup']; ?>" class="btn-buy">Ulasan</a>
                                    <a href="/Home/reservasis/<?= $values['id_paket_makeup']; ?>" class="btn-buy">Order</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section id="map" class="pricing">
            <div class="container">
                <div class="section-title">
                    <span>Location</span>
                    <h2>Studio Location</h2>
                </div>
                <div class="row" style="justify-content: center;">
                    <div id="googleMap" style="width:100%;height:480px;"></div>
                </div>
            </div>
        </section>
    </main>
    <footer id="footer" style="height: 20rem;" >
        <h4>About</h4>
        <p>E-MUA didirikan oleh Felby Febila Illahi, seorang makeup artist berbakat dan bersemangat dengan pengalaman lebih dari 5 tahun di industri kecantikan. Tim kami terdiri dari para profesional berdedikasi yang berspesialisasi dalam berbagai gaya makeup, mulai dari yang natural dan elegan hingga yang bold dan glamor. kami percaya bahwa setiap individu pantas merasa percaya diri, cantik, dan berdaya. Misi kami adalah untuk meningkatkan kecantikan alami Anda dan membantu Anda bersinar pada hari istimewa atau acara apa pun.</p>

        <h5>Contact Person</h5>
        <ul>
            <li>Email  : mua@gmail.com</li>
            <li>No HP  : 089636316969</li>
            <li>Kota   : <?= $cuaca['name'] ?></li>
        </ul>

        <h5 class="cuaca">Informasi Cuaca</h5>
        <ul class="ulcuaca">
            <li>Location  : <?= $cuaca['name'] ?></li>
            <li>Timezone  : <?= $cuaca['timezone'] ?></li>
            <li>Temperatur  : <?= $cuaca['main']['temp'] ?></li>
            <li>Humidity  : <?= $cuaca['main']['humidity'] ?></li>
            <li>Pressure  : <?= $cuaca['main']['pressure'] ?></li>
        </ul>
    </footer><!-- End Footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
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