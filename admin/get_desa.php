<?php
// Gantilah dengan koneksi database sesuai dengan kebutuhan Anda
include '../koneksi.php';

if (isset($_GET['kecamatan_id'])) {
    $kecamatan_id = $_GET['kecamatan_id'];

    $query = "SELECT * FROM desa WHERE id_kecamatan = $kecamatan_id";
    $result = mysqli_query($koneksi, $query);

    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode([]);
}
?>
