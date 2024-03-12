<?php
$koneksi = new mysqli("localhost", "root", "", "db_absenkhanza");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data gambar dan ID Pegawai dari request POST
$dataGambar = $_POST['image'];
$kodePegawai = $_POST['kode_pegawai'];
$j = gmdate('H:i:s', time() + 60 * 60 * 7);

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
    $queryPresensi = "INSERT INTO presensi (id_pegawai, gambar, jam_datang, status_absensi) VALUES ('$idPegawai', '$namaFile', '$j', 'datang')";
    
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
?>
