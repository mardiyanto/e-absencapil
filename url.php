<?php
// Lakukan koneksi ke database
include 'koneksi.php';

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
// Mendapatkan bulan dan tahun saat ini
$bulan_tahun_sekarang = date("Y-m");
// Query SQL untuk membuat rekap presensi setiap pegawai setiap bulan
$query = "SELECT pg.id_pegawai, pg.nama_pegawai, DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m') AS bulan_tahun,
                 COUNT(pd.id_presensi_datang) as total_presensi
          FROM pegawai pg
          LEFT JOIN presensi_datang pd ON pg.id_pegawai = pd.id_pegawai
          WHERE DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m') = '$bulan_tahun_sekarang'
          GROUP BY pg.id_pegawai, DATE_FORMAT(pd.tanggal_absensi_datang, '%Y-%m')";
// Jalankan query
$result = $koneksi->query($query);

// Periksa apakah query berhasil dijalankan
if ($result) {
    // Cetak header rekap presensi
    echo "<h2>Rekap Presensi Setiap Pegawai Bulan Ini</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Pegawai</th><th>Nama Pegawai</th><th>Bulan/Tahun</th><th>Total Presensi</th></tr>";

    // Loop untuk menampilkan hasil rekap presensi
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_pegawai'] . "</td>";
        echo "<td>" . $row['nama_pegawai'] . "</td>";
        echo "<td>" . $row['bulan_tahun'] . "</td>";
        echo "<td>" . $row['total_presensi'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Error: " . $koneksi->error;
}

// Tutup koneksi
$koneksi->close();
?>
