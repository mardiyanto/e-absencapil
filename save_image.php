<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');
if($_GET['aksi']=='datang'){ 
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }
    // Ambil data gambar dan ID Pegawai dari request POST
    $dataGambar = $_POST['image'];
    $kodePegawai = $_POST['kode_pegawai'];
    $j = gmdate('H:i:s', time() + 60 * 60 * 7);
    $today = date("Y-m-d");
    // Periksa apakah ada data pegawai dengan kode_pegawai yang sesuai
    $queryCekPegawai = "SELECT * FROM pegawai WHERE kode_pegawai = '$kodePegawai'";
    $resultCekPegawai = $koneksi->query($queryCekPegawai);
    
    if ($resultCekPegawai->num_rows > 0) {
        // Data pegawai ditemukan, lanjutkan proses
        $rowPegawai = $resultCekPegawai->fetch_assoc();
        $idPegawai = $rowPegawai['id_pegawai'];
    
        // Decode data URI menjadi binary data
        $gambarBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $dataGambar));
    
        // Simpan gambar ke dalam folder (pastikan folder telah ada dan memiliki izin tulis)
        $folderTujuan = "uploads/";  // Ganti dengan path folder tujuan Anda
        $namaFile = "absen_" . $idPegawai . "_" . time() . ".jpg";
        $pathFile = $folderTujuan . $namaFile;
    
        file_put_contents($pathFile, $gambarBinary);
    
        // Simpan path gambar ke dalam database
        $queryPresensi = "INSERT INTO presensi_datang (id_pegawai, gambar_datang,jam_absensi_datang, tanggal_absensi_datang,status_absensi_datang,status_absensi,status_hadir,latitude,longitude) 
        VALUES ('$idPegawai', '$namaFile', '$j', '$today', 'datang','$_POST[status_absensi]','$_POST[status_hadir]','$_POST[latitude]','$_POST[longitude]')";
        if ($koneksi->query($queryPresensi) === TRUE) {
            echo "Gambar berhasil disimpan di folder dan path gambar tersimpan di database.";
        } else {
            echo "Error: " . $queryPresensi . "<br>" . $koneksi->error;
        }
    } else {
        // Data pegawai tidak ditemukan
        echo "Error: Pegawai dengan kode $kodePegawai tidak ditemukan.";
    }
    
    $koneksi->close();
    
}
elseif($_GET['aksi']=='pulang'){ 
// Ambil data gambar dan ID Pegawai dari request POST
$dataGambar = $_POST['image'];
$kodePegawai = $_POST['kode_pegawai'];
$j = gmdate('H:i:s', time() + 60 * 60 * 7);
$today = date("Y-m-d");
// Periksa apakah ada data pegawai dengan kode_pegawai yang sesuai
$queryCekPegawai = "SELECT * FROM pegawai WHERE kode_pegawai = '$kodePegawai'";
$resultCekPegawai = $koneksi->query($queryCekPegawai);

if ($resultCekPegawai->num_rows > 0) {
    // Data pegawai ditemukan, lanjutkan proses
    $rowPegawai = $resultCekPegawai->fetch_assoc();
    $idPegawai = $rowPegawai['id_pegawai'];

    // Decode data URI menjadi binary data
    $gambarBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $dataGambar));

    // Simpan gambar ke dalam folder (pastikan folder telah ada dan memiliki izin tulis)
    $folderTujuan = "uploads/";  // Ganti dengan path folder tujuan Anda
    $namaFile = "absen_" . $idPegawai . "_" . time() . ".jpg";
    $pathFile = $folderTujuan . $namaFile;

    file_put_contents($pathFile, $gambarBinary);

    // Simpan path gambar ke dalam database
    $queryPresensi = "INSERT INTO presensi_pulang (id_pegawai, gambar_pulang,jam_absensi_pulang, tanggal_absensi_pulang,status_absensi_pulang,latitude,longitude) 
    VALUES ('$idPegawai', '$namaFile', '$j', '$today', 'pulang','$_POST[latitude]','$_POST[longitude]')";
    if ($koneksi->query($queryPresensi) === TRUE) {
        echo "Gambar berhasil disimpan di folder dan path gambar tersimpan di database.";
    } else {
        echo "Error: " . $queryPresensi . "<br>" . $koneksi->error;
    }
} else {
    // Data pegawai tidak ditemukan
    echo "Error: Pegawai dengan kode $kodePegawai tidak ditemukan.";
}
$koneksi->close();

}  
?>
