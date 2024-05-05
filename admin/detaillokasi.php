<?php 
$tanggal=date("Y");
include "../koneksi.php";
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Location Detection with Mapbox GL JS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
  <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
  <style>
    body { margin: 0; padding: 0; }
    #map { position: absolute; top: 0; bottom: 0; width: 100%; }
  </style>
</head>
<body>
  <div id="map"></div>

  <?php

    // Mendapatkan data latitude dan longitude dari tabel booking berdasarkan id_booking
    $id_presensi_datang = $_GET['id_presensi_datang'];

    $sql = "SELECT latitude, longitude FROM presensi_datang WHERE id_presensi_datang = '$id_presensi_datang'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $latitude = $row['latitude'];
      $longitude = $row['longitude'];

      // Menampilkan peta dengan marker pada lokasi yang didapatkan
      echo "
      <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiaXRyc2thcnRpbmkiLCJhIjoiY2xpd2lqbDMwMzlrMjNsbGd3c3dnY3Q1ZSJ9.eFCToH4luPNjPxsxM6_kkg';

        const map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/streets-v12',
          center: [$longitude, $latitude],
          zoom: 12
        });

        const marker = new mapboxgl.Marker().setLngLat([$longitude, $latitude]).addTo(map);
      </script>";
    } else {
      echo "No data found.";
    }

  ?>
</body>
</html>
