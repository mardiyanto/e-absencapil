<?php 
  include 'koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Charts</title>

    <!-- Custom fonts for this template-->
    <link href="sys/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="sys/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               <?php include"menu.php"?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                   
                            <?php
                            if (isset($_GET['aksi'])){
                            include 'isi.php';
                            }
                            else {   
                            include 'utama.php';
                            }
                            ?>
                  

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="sys/vendor/jquery/jquery.min.js"></script>
    <script src="sys/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="sys/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="sys/js/sb-admin-2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script>
        // Fungsi untuk menghitung jarak antara dua titik koordinat menggunakan Haversine formula
        function calculateDistance(lat1, lon1, lat2, lon2) {
            var earthRadius = 6371; // Radius bumi dalam kilometer

            var dLat = degToRad(lat2 - lat1);
            var dLon = degToRad(lon2 - lon1);

            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(degToRad(lat1)) * Math.cos(degToRad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);

            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var distance = earthRadius * c;

            return distance * 1000; // Mengonversi jarak menjadi meter
        }

        // Fungsi untuk mengubah derajat menjadi radian
        function degToRad(deg) {
            return deg * (Math.PI / 180);
        }

        // Lokasi kantor (latitude dan longitude)
        var officeLatitude = <?php echo"$m[latitude]";?>;
        var officeLongitude = <?php echo"$m[longitude]";?>;

        // Inisialisasi peta Leaflet
        var map = L.map('map').setView([officeLatitude, officeLongitude], 15);

        // Menambahkan peta tile menggunakan Leaflet providers
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        // Menambahkan marker untuk lokasi kantor
        var officeMarker = L.marker([officeLatitude, officeLongitude]).addTo(map);

        // Membuat lingkaran dengan radius 100 meter
        var radius = L.circle([officeLatitude, officeLongitude], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.3,
            radius: 100
        }).addTo(map);

        // Memeriksa jarak saat mendapatkan lokasi pengguna
        function getLocation() {
            var statusElement = document.getElementById("status");
            var frmPresensi = document.getElementById("frmPresensi");

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var userLatitude = position.coords.latitude;
                    var userLongitude = position.coords.longitude;

                    var distance = calculateDistance(officeLatitude, officeLongitude, userLatitude, userLongitude);

                    if (distance <= 100) {
                        statusElement.textContent = "Anda berada dalam radius 100 meter dari kantor.";
                        frmPresensi.style.display = "block";
                    } else {
                        statusElement.textContent = "Anda harus berada dalam radius 100 meter dari kantor untuk mengakses absensi.";
                        frmPresensi.style.display = "none";
                    }
                }, function (error) {
                    if (error.code === error.PERMISSION_DENIED) {
                        statusElement.textContent = "Anda tidak memberikan izin untuk mengakses lokasi.";
                    } else {
                        statusElement.textContent = "Terjadi kesalahan dalam mendapatkan lokasi.";
                    }
                    frmPresensi.style.display = "none";
                });
            } else {
                statusElement.textContent = "Geolokasi tidak didukung oleh browser Anda.";
                frmPresensi.style.display = "none";
            }
        }

        // Memanggil fungsi getLocation saat halaman dimuat
        window.addEventListener("DOMContentLoaded", getLocation);
    </script>
</body>

</html>
