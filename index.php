<?php 
  include 'koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title><?php echo"$k_k[nama]";?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="tema/lib/animate/animate.min.css" rel="stylesheet">
        <link href="tema/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="tema/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="tema/css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

        <?php include "menuindex.php"; ?>

        <!-- Carousel Start -->
        <div class="container-fluid px-0">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="tema/img/carousel-1.jpg" class="img-fluid" alt="First slide">
                        <div class="carousel-caption">
                            <div class="container carousel-content">
                                <h6 class="text-secondary h4 animated fadeInUp"><?php echo"$k_k[nama]";?></h6>
                                <h1 class="text-white display-1 mb-4 animated fadeInRight">Solusi Absen Mudah</h1>
                                <p class="mb-4 text-white fs-5 animated fadeInDown">Absensi Mudah Dengan Website Mobile Bagi Pegawai Honorer Di lingkungan Dinas Dan Pencatatan Sipil Pringsewu</p>
                                <a href="absen.php?aksi=datang" class="me-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">Absen Datang</button></a>
                                <a href="absen.php?aksi=pulang" class="ms-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInRight">Absen Pulang</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="tema/img/carousel-2.jpg" class="img-fluid" alt="Second slide">
                        <div class="carousel-caption">
                            <div class="container carousel-content">
                                <h6 class="text-secondary h4 animated fadeInUp"><?php echo"$k_k[nama]";?></h6>
                                <h1 class="text-white display-1 mb-4 animated fadeInLeft">Kami Siap Melayani Bukan Dilayani</h1>
                                <p class="mb-4 text-white fs-5 animated fadeInDown">Pegawai Kita Adalah Aset, Kami ada untuk palayanan kependudukan bagi masyarakat</p>
                                <a href="absen.php?aksi=datang" class="me-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">Absen Datang</button></a>
                                <a href="absen.php?aksi=pulang" class="ms-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInRight">Absen Pulang</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->
        <?php // Query SQL untuk menghitung total baris dalam tabel pegawai
$query = "SELECT COUNT(*) as total FROM pegawai";
// Jalankan query
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
 // Total baris dalam tabel pegawai
$total_pegawai = $row['total'];
?>
<?php
// Mendapatkan tanggal hari ini
$today = date("Y-m-d");
// Query SQL untuk menghitung total presensi datang berdasarkan tanggal absensi datang hari ini
$querydatang = "SELECT COUNT(*) as total FROM presensi_datang WHERE tanggal_absensi_datang = '$today' AND status_absensi_datang = 'datang'";
// Jalankan query
$result = $koneksi->query($querydatang);
$rowdatang = $result->fetch_assoc();

$total_presensi_datang = $rowdatang['total'];
// Query SQL untuk menghitung total presensi pulang berdasarkan tanggal absensi pulang hari ini
$querypulang= "SELECT COUNT(*) as total FROM presensi_pulang WHERE tanggal_absensi_pulang = '$today' AND status_absensi_pulang = 'pulang'";
// Jalankan query
$result = $koneksi->query($querypulang);
$rowpulang = $result->fetch_assoc();
 // Total presensi pulang berdasarkan tanggal absensi hari ini
$total_presensi_pulang = $rowpulang['total'];
$total_presensi = $total_presensi_datang + $total_presensi_pulang;
$total = $total_presensi -$total_presensi_datang;
?>

        <!-- Fact Start -->
        <div id="about" class="container-fluid bg-secondary py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".1s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value"><?php echo"$total_pegawai" ?></h1>
                            <h5 class="text-white mt-1">Total Pegawai Honorer</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".3s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value"><?php echo"$total_presensi_datang" ?></h1>
                            <h5 class="text-white mt-1">Absensi Datang Hari Ini</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".5s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value"><?php echo"$total_presensi_pulang" ?></h1>
                            <h5 class="text-white mt-1">Absensi Pulang Hari Ini</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".7s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value"><?php echo"$total" ?></h1>
                            <h5 class="text-white mt-1"> Total Absensi Hari Ini</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact End -->


        <!-- About Start -->
        <div  id="hubungi" class="container-fluid py-5 my-5">
            <div class="container pt-5">
                <div class="row g-5">
                    <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                        <div class="h-100 position-relative">
                            <img src="tema/img/about-1.jpg" class="img-fluid w-75 rounded" alt="" style="margin-bottom: 25%;">
                            <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                                <img src="tema/img/about-2.jpg" class="img-fluid w-100 rounded" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                        <h5 class="text-primary">Tentang Kami</h5>
                        <h1 class="mb-4"><?php echo"$k_k[nama]";?></h1>
                        <p><?php echo"$k_k[isi]";?></p>
                        <!-- <a href="" class="btn btn-secondary rounded-pill px-5 py-3 text-white">More Details</a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->



        <!-- Contact Start -->
        <div class="container-fluid py-5 mb-5">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                    <h5 class="text-primary">Hubungi Kami</h5>
                    <!-- <h1 class="mb-3">Contact for any query</h1>
                    <p class="mb-2">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                 -->
                    </div>
                <div class="contact-detail position-relative p-5">
                    <div class="row g-5 mb-5 justify-content-center">
                        <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".3s">
                            <div class="d-flex bg-light p-3 rounded">
                                <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="text-primary">Alamat Kami :</h4>
                                    <a href="https://goo.gl/maps/Zd4BCynmTb98ivUJ6" target="_blank" class="h5"><?php echo"$k_k[alamat]";?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".5s">
                            <div class="d-flex bg-light p-3 rounded">
                                <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                                    <i class="fa fa-phone text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="text-primary">WA/NO HP</h4>
                                    <a class="h5" href="tel:<?php echo"$k_k[tahun]";?>" target="_blank"><?php echo"$k_k[tahun]";?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".7s">
                            <div class="d-flex bg-light p-3 rounded">
                                <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                                    <i class="fa fa-envelope text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="text-primary">Email Kami:</h4>
                                    <a class="h5" href="<?php echo"$k_k[alias]";?>" target="_blank"><?php echo"$k_k[alias]";?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-5">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                            <div class="p-5 h-100 rounded contact-map">
                                <iframe class="rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7944.937932988058!2d105.00390000000002!3d-5.345154!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4732e8d9cc965f%3A0x7cf54db17cfc1c36!2sDinas%20Kependudukan%20dan%20Pencatatan%20Sipil%20Kabupaten%20Pringsewu!5e0!3m2!1sid!2sid!4v1716103713321!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                           <form method='post' action='absen.php?aksi=inputhubungi'>
                            <div class="p-5 rounded contact-form">
                                <div class="mb-4">
                                    <input type="text"  name='nama' class="form-control border-0 py-3" placeholder="Nama Lengkap">
                                </div>
                                <div class="mb-4">
                                    <input type="email" name='email' class="form-control border-0 py-3" placeholder="Email anda'">
                                </div>
                            
                                <div class="mb-4">
                                    <textarea name='pesan' class="w-100 form-control border-0 py-3" rows="6" cols="10" placeholder='Isikan Pesan' ></textarea>
                                </div>
                                <div class="text-start">
                                    <button type='submit' class="btn bg-primary text-white py-3 px-5" type="button">Kirim Pesan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- Contact End -->

<?php include "bawah.php"; ?>

        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top"><i class="fa fa-arrow-up text-white"></i></a>

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="tema/lib/wow/wow.min.js"></script>
        <script src="tema/lib/easing/easing.min.js"></script>
        <script src="tema/lib/waypoints/waypoints.min.js"></script>
        <script src="tema/lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="tema/js/main.js"></script>
    </body>

</html>