<?php
// Gantilah dengan koneksi database sesuai dengan kebutuhan Anda
include '../koneksi.php';

$query = "SELECT * FROM kecamatan";
$result = mysqli_query($koneksi, $query);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
