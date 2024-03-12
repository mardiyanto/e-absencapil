<?php
// Fungsi untuk menghasilkan token acak
function generateRandomToken($length = 20) {
    // Karakter yang akan digunakan dalam pembuatan token
    $characters = '0123456789';
    $token = '';
    // Mengambil karakter acak dari daftar karakter dan menggabungkannya menjadi token
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $token;
}
// Contoh penggunaan
$token = generateRandomToken(32);
$_SESSION['login_token'] = $token;

?>

<a href="http://localhost/e-votingketuaosis/index.php?aksi=login&id_paslon=1&token=<?php echo $token; ?>">Login</a>
