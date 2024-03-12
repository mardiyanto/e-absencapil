<?php
  include '../koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "administrator_logedin"){
    header("location:../login.php?alert=belum_login");
  }

///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='inputpaslon'){
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
// Tangkap data dari formulir
$nama_paslon = $_POST['nama_paslon'];
// Tangkap file yang diunggah
$foto = $_FILES['foto'];
// Cek apakah file yang diunggah adalah gambar
$allowed_types = array('jpg', 'jpeg', 'png', 'gif');
$file_ext = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
if (!in_array($file_ext, $allowed_types)) {
    die("Maaf, hanya format JPG, JPEG, PNG, atau GIF yang diizinkan.");
}
// Buat nama file unik dengan menambahkan timestamp
$nama_file_unik = time() . '_' . basename($foto['name']);
$upload_dir = "../foto/paslon/";
$upload_path = $upload_dir . $nama_file_unik;

// Pindahkan file ke direktori yang ditentukan
if (move_uploaded_file($foto['tmp_name'], $upload_path)) {
    // File berhasil diunggah, simpan informasi ke database
    $sql = "INSERT INTO paslon (nama_paslon, foto,token) VALUES ('$nama_paslon', '$nama_file_unik', '$token')";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>window.location=('index.php?aksi=paslon&error=Foto berhasil diunggah dan disimpan ke database.')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "<script>window.location=('index.php?aksi=paslon&error=Maaf, terjadi kesalahan saat mengunggah file.')</script>";
}
}
elseif($_GET['aksi']=='inputpaslonok'){
    
    $rand = rand();
    $allowed =  array('gif','png','jpg','jpeg');
    $filename = $_FILES['foto']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed) ) {
            echo "<script>window.location=('index.php?aksi=paslon&error=Maaf, terjadi kesalahan saat mengunggah file.')</script>";
        }else{
            move_uploaded_file($_FILES['foto']['tmp_name'], '../foto/paslon/'.$rand.'_'.$filename);
            $file_gambar = $rand.'_'.$filename;
            mysqli_query($koneksi,"insert into paslon (nama_paslon,foto,token) values ('$_POST[nama_paslon]','$file_gambar','$token')"); 
            echo "<script>window.location=('index.php?aksi=paslon&error=Foto berhasil diunggah dan disimpan ke database.')</script>";
        }
 
 }
elseif($_GET['aksi']=='inputpemilih'){
	mysqli_query($koneksi,"insert into pemilih (nama_pemilih,no_hp,nisn,kelas) values ('$_POST[nama_pemilih]','$_POST[no_hp]','$_POST[nisn]','$_POST[kelas]')");  
echo "<script>window.location=('index.php?aksi=pemilih')</script>";
}

elseif($_GET['aksi']=='inputsuara'){
	mysqli_query($koneksi,"insert into suara (id_pemilih,id_paslon,suara_sah) values ('$_POST[id_pemilih]','$_POST[id_paslon]','$_POST[suara_sah]')");  
echo "<script>window.location=('index.php?aksi=suara')</script>";
}
elseif($_GET['aksi']=='inputkabupaten'){
	mysqli_query($koneksi,"insert into kabupaten (nama_kabupaten) values ('$_POST[nama_kabupaten]')");  
echo "<script>window.location=('index.php?aksi=kabupaten')</script>";
}
elseif($_GET['aksi']=='inputtemuan'){
	mysqli_query($koneksi,"insert into temuan (url,keterangan) values ('$_POST[url]','$_POST[keterangan]')");  
echo "<script>window.location=('index.php?aksi=temuan')</script>";
}
//////////////////////////////tps/////////////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='inputtps'){
	mysqli_query($koneksi,"insert into tps (id_kecamatan,id_desa,no_tps) values ('$_POST[id_kecamatan]','$_POST[id_desa]','$_POST[no_tps]')");  
echo "<script>window.location=('index.php?aksi=tps')</script>";
}
elseif ($_GET['aksi'] == 'inputsuarapaslon') {
    // Validasi combo box
    if (!isset($_POST['id_kecamatan']) || empty($_POST['id_kecamatan']) ||
        !isset($_POST['id_desa']) || empty($_POST['id_desa']) ||
        !isset($_POST['id_tps']) || empty($_POST['id_tps']) ||
        !isset($_POST['id_paslon']) || empty($_POST['id_paslon']) ||
        !isset($_POST['suara_sah']) || empty($_POST['suara_sah']) ) {
        // Redirect jika ada data yang kosong
        echo "<script>alert('Harap lengkapi semua data');</script>";
        echo "<script>window.location=('index.php?aksi=tps');</script>";
        exit; // Menghentikan eksekusi kode selanjutnya
    }

    // Eksekusi query SQL untuk menambahkan data
    mysqli_query($koneksi, "INSERT INTO suara (id_kecamatan, id_desa, id_tps, id_paslon, suara_sah, suara_rusak) VALUES ('$_POST[id_kecamatan]', '$_POST[id_desa]', '$_POST[id_tps]', '$_POST[id_paslon]', '$_POST[suara_sah]', '$_POST[suara_rusak]')");
    mysqli_query($koneksi,"UPDATE tps SET status='sudah' WHERE id_tps='$_POST[id_tps]'");
    // Redirect ke halaman index.php?aksi=tps setelah berhasil menambahkan data
    echo "<script>window.location=('index.php?aksi=tps');</script>";
}
elseif ($_GET['aksi'] == 'inputsuarapaslontps') {
    // Validasi combo box
    if (!isset($_POST['id_kecamatan']) || empty($_POST['id_kecamatan']) ||
        !isset($_POST['id_desa']) || empty($_POST['id_desa']) ||
        !isset($_POST['no_tps']) || empty($_POST['no_tps']) ||
        !isset($_POST['id_paslon']) || empty($_POST['id_paslon']) ||
        !isset($_POST['suara_sah']) || empty($_POST['suara_sah']) ) {
        // Redirect jika ada data yang kosong
        echo "<script>alert('Harap lengkapi semua data');</script>";
        echo "<script>window.location=('index.php?aksi=inputdata');</script>";
        exit; // Menghentikan eksekusi kode selanjutnya
    }
	mysqli_query($koneksi,"INSERT INTO tps (id_kecamatan,id_desa,no_tps,status) values ('$_POST[id_kecamatan]','$_POST[id_desa]','$_POST[no_tps]','sudah')"); 
	$id_tps_baru = mysqli_insert_id($koneksi);

    // Eksekusi query SQL untuk menambahkan data
    mysqli_query($koneksi, "INSERT INTO suara (id_kecamatan, id_desa, id_tps, id_paslon, suara_sah, suara_rusak) VALUES ('$_POST[id_kecamatan]', '$_POST[id_desa]', '$id_tps_baru', '$_POST[id_paslon]', '$_POST[suara_sah]', '$_POST[suara_rusak]')");
    
    // Redirect ke halaman index.php?aksi=tps setelah berhasil menambahkan data
    echo "<script>window.location=('index.php?aksi=inputdata');</script>";
}
///////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='inputmenu'){
	mysqli_query($koneksi,"insert into menu (nama_menu,link,link_b,status,icon_menu,aktif) values ('$_POST[nama_menu]','$_POST[link]','$_POST[link_b]','$_POST[status]','$_POST[icon_menu]','$_POST[aktif]')");  
echo "<script>window.location=('index.php?aksi=menu')</script>";
}
elseif($_GET['aksi']=='inputsubmenu'){
	mysqli_query($koneksi,"insert into submenu (id_menu,nama_sub,link_sub,icon_sub) values ('$_POST[id_menu]','$_POST[nama_sub]','$_POST[link_sub]','$_POST[icon_sub]')");  
echo "<script>window.location=('index.php?aksi=submenu')</script>";
}
elseif($_GET['aksi']=='inputgolongan'){
	mysqli_query($koneksi,"insert into golongan (nama_gol) values ('$_POST[nama_gol]')");  
echo "<script>window.location=('index.php?aksi=golongan')</script>";
}
elseif($_GET['aksi']=='inputjabatan'){
	mysqli_query($koneksi,"insert into jabatan (nama_jabatan) values ('$_POST[nama_jabatan]')");  
echo "<script>window.location=('index.php?aksi=jabatan')</script>";
}
elseif($_GET['aksi']=='inputprofesi'){
	mysqli_query($koneksi,"insert into profesi (nama_profesi) values ('$_POST[nama_profesi]')");  
echo "<script>window.location=('index.php?aksi=profesi')</script>";
}
elseif($_GET['aksi']=='inputadmin'){
$nama  = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];

if($filename == ""){
	mysqli_query($koneksi, "insert into user values (NULL,'$nama','$username','$password','')");
	echo "<script>window.location=('index.php?aksi=admin')</script>";
}else{
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(!in_array($ext,$allowed) ) {
		echo "<script>alert('Gagal ');</script>";
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);
		$file_gambar = $rand.'_'.$filename;
		mysqli_query($koneksi, "insert into user values (NULL,'$nama','$username','$password','$file_gambar')");
		echo "<script>window.location=('index.php?aksi=admin')</script>";
	}
}
}
if($_GET['aksi']=='inputpegawai'){	
mysqli_query($koneksi,"insert into pegawai (nama_pegawai,nik,tgl_lahir,status_pegawai,kode_pegawai,jenis_kelamin) 
values ('$_POST[nama_pegawai]','$_POST[nik]','$_POST[tgl_lahir]','$_POST[status_pegawai]','$_POST[kode_pegawai]','$_POST[jenis_kelamin]')");  
echo "<script>window.location=('index.php?aksi=pegawai')</script>";
}
elseif($_GET['aksi']=='inputkeluarga'){
	mysqli_query($koneksi,"insert into keluarga (id_pegawai,nama_keluarga,jk_keluarga,tempatlahir_keluarga,tgllahir_keluarga,status_keluarga,pekejaan_keluarga,pendidikan_keluarga,penghasilan_keluarga,ket_keluarga,tunjang_status,tgl_mati,status_nikah,status_beasiswa,anak_angkat_status,status_sekolah,status_aktif) 
	values ('$_POST[id_pegawai]','$_POST[nama_keluarga]','$_POST[jk_keluarga]','$_POST[tempatlahir_keluarga]','$_POST[tgllahir_keluarga]','$_POST[status_keluarga]','$_POST[pekejaan_keluarga]','$_POST[pendidikan_keluarga]','$_POST[penghasilan_keluarga]','$_POST[ket_keluarga]','$_POST[tunjang_status]','$_POST[tgl_mati]','$_POST[status_nikah]','$_POST[status_beasiswa]','$_POST[anak_angkat_status]','$_POST[status_sekolah]','$_POST[status_aktif]')");  
	mysqli_query($koneksi,"UPDATE pegawai SET status_pg='ada' WHERE id_pegawai='$_POST[id_pegawai]'");
	echo "<script>window.location=('index.php?aksi=listtunjangan&id_pegawai=$_POST[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='inputtunjangan'){
	mysqli_query($koneksi,"insert into tunjangan (id_pegawai,t_status) 
	values ('$_GET[id_pegawai]','baru')");
	mysqli_query($koneksi,"UPDATE pegawai SET status_pg='kk ada' WHERE id_pegawai='$_GET[id_pegawai]'"); 
echo "<script>window.location=('index.php?aksi=tunjangan')</script>";
}
elseif($_GET['aksi']=='inputpangku'){
	mysqli_query($koneksi,"insert into pemangku (nama_pkjab) 
	values ('$_POST[nama_pkjab]')");
echo "<script>window.location=('index.php?aksi=pangku')</script>";
}
elseif($_GET['aksi']=='inputpangkujabatan'){
	mysqli_query($koneksi,"insert into pemangkujabatan (id_pegawai,id_pkjab,nomor_surat,tanggal_surat) 
	values ('$_POST[id_pegawai]','$_POST[id_pkjab]','$_POST[nomor_surat]','$_POST[tanggal_surat]')");
echo "<script>window.location=('index.php?aksi=pangkujabatan')</script>";
}
?>