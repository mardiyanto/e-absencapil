
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

      <title>dsgsg</title>

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

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">mardi</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=Input">ABSEN</a>
      </li>
	    <li class="nav-item">
        <a class="nav-link" href="api.php">MAP</a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
             

<div class="row">

                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center"> 
							<button type="button" class="btn btn-outline-success btn-lg"><?php
echo "Sekarang Jam " . date("h:i:sa");
?></button><p id="status"></p>
                                <h1 class="h4 text-gray-900 mb-4">::[ Absen Berdasarkan jam (jam datang = jam pulang) ]::</h1>
                            </div>
                            <form name="frmPresensi" id="frmPresensi" style="display: none;" method="post" onsubmit="return validasiIsi();" class="user">
							<input type="hidden" name="image" class="image-tag" onkeydown="setDefault(this, document.getElementById('MsgIsi1'));" id="TxtIsi1">   
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
		<span id="MsgIsi2" style="color:#CC0000; font-size:10px;"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="barcode" type="text" onkeydown="setDefault(this, document.getElementById('MsgIsi3'));" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="NMR kartu">
											<span id="MsgIsi3" style="color:#CC0000; font-size:10px;"></span>
                                    </div>
                                </div>
                              <input name=BtnSimpan type=submit class="btn btn-primary btn-user btn-block" value="Simpan" onClick="take_snapshot()"/> 
							  <input name=BtnKosong type=reset class="btn btn-google btn-user btn-block" value="Kosong"/>
                                
                            </form>
                            <hr>
             
                        </div>
                    </div>
                </div>
				
<div id="map"></div>

           
            </form>
           </div>
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
        var officeLatitude = -5.3553201;
        var officeLongitude = 104.9720316;

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
