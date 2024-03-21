<?php
  include '../koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "administrator_logedin"){
    header("location:../login.php?alert=belum_login");
  }
///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='proseseditpemilih'){
mysqli_query($koneksi,"UPDATE pemilih SET nama_pemilih='$_POST[nama_pemilih]',nisn='$_POST[nisn]',no_hp='$_POST[no_hp]',
kelas='$_POST[kelas]' WHERE id_pemilih='$_GET[id_pemilih]'");
echo "<script>window.location=('index.php?aksi=pemilih')</script>";
}
elseif($_GET['aksi']=='proseseditmap'){
	mysqli_query($koneksi,"UPDATE map SET latitude='$_POST[latitude]',longitude='$_POST[longitude]' WHERE id_map='$_GET[id_map]'");
echo "<script>window.location=('index.php?aksi=map')</script>";
}
elseif($_GET['aksi']=='proseseditprofilpaslon'){
	mysqli_query($koneksi,"UPDATE paslon SET tgl_lahir='$_POST[tgl_lahir]',tmp_lahir='$_POST[tmp_lahir]',visi='$_POST[visi]',misi='$_POST[misi]',pendidikan='$_POST[pendidikan]',prestasi='$_POST[prestasi]' WHERE id_paslon='$_GET[id_paslon]'");
	echo "<script>window.location=('index.php?aksi=paslon')</script>";
}
elseif($_GET['aksi']=='proseseditpaslon'){
// Ambil ID data yang akan diedit
$id_paslon = $_GET['id_paslon'];

// Ambil informasi file yang akan diedit
$sql_select = "SELECT nama_paslon, foto FROM paslon WHERE id_paslon = $id_paslon";
$result_select = mysqli_query($koneksi, $sql_select);

if ($result_select) {
    $row = mysqli_fetch_assoc($result_select);
    $file_path = "../foto/paslon/" . $row['foto'];

    // Tangkap file yang diunggah untuk menggantikan yang lama
    $foto_baru = $_FILES['foto_baru'];

    // Cek apakah file foto baru diunggah
    if (!empty($foto_baru['name'])) {
        // Hapus file lama dari direktori
        unlink($file_path);

        // Buat nama file unik menggunakan timestamp
        $timestamp = time();
        $file_extension = pathinfo($foto_baru['name'], PATHINFO_EXTENSION);
        $file_unique_name = $timestamp . '_' . uniqid() . '.' . $file_extension;

        // Pindahkan file baru ke direktori yang ditentukan
        $upload_dir = "../foto/paslon/";
        $upload_path = $upload_dir . $file_unique_name;

        if (move_uploaded_file($foto_baru['tmp_name'], $upload_path)) {
            // Update informasi file baru dan nama_paslon ke database
            $nama_paslon = $_POST['nama_paslon'];
            $sql_update = "UPDATE paslon SET nama_paslon = '$nama_paslon', foto = '$file_unique_name' WHERE id_paslon = $id_paslon";

            if (mysqli_query($koneksi, $sql_update)) {
                echo "<script>window.location=('index.php?aksi=paslon&error=Data berhasil diubah.')</script>";
            } else {
                echo "Error: " . $sql_update . "<br>" . mysqli_error($koneksi);
            }
        } else {
            echo "<script>window.location=('index.php?aksi=paslon&error=Maaf, terjadi kesalahan saat mengunggah file baru.')</script>";
        }
    } else {
        // Jika tidak ada file baru diunggah, hanya perbarui nama_paslon
        $nama_paslon = $_POST['nama_paslon'];
        $sql_update = "UPDATE paslon SET nama_paslon = '$nama_paslon' WHERE id_paslon = $id_paslon";

        if (mysqli_query($koneksi, $sql_update)) {
            echo "<script>window.location=('index.php?aksi=paslon&error=Data berhasil diubah.')</script>";
        } else {
            echo "Error: " . $sql_update . "<br>" . mysqli_error($koneksi);
        }
    }
} else {
    echo "<script>window.location=('index.php?aksi=paslon&error=Maaf, terjadi kesalahan saat mengambil informasi file.')</script>";
}
}

elseif($_GET['aksi']=='proseseditkecamatan'){
	mysqli_query($koneksi,"UPDATE kecamatan SET nama_kecamatan='$_POST[nama_kecamatan]',id_kab='$_POST[id_kab]' WHERE id_kecamatan='$_GET[id_kecamatan]'");
echo "<script>window.location=('index.php?aksi=kecamatan')</script>";
}
elseif($_GET['aksi']=='proseseditkabupaten'){
	mysqli_query($koneksi,"UPDATE kabupaten SET nama_kabupaten='$_POST[nama_kabupaten]' WHERE id_kab='$_GET[id_kab]'");
echo "<script>window.location=('index.php?aksi=kabupaten')</script>";
}
elseif($_GET['aksi']=='prosesedittemuan'){
	mysqli_query($koneksi,"UPDATE temuan SET url='$_POST[url]',keterangan='$_POST[keterangan]' WHERE id_temuan='$_GET[id_temuan]'");
echo "<script>window.location=('index.php?aksi=kabupaten')</script>";
}
elseif($_GET['aksi']=='proseseditdesa'){
	mysqli_query($koneksi,"UPDATE desa SET nama_desa='$_POST[nama_desa]',id_kecamatan='$_POST[id_kecamatan]' WHERE id_desa='$_GET[id_desa]'");
echo "<script>window.location=('index.php?aksi=desa')</script>";
}
////////////////////////////////////edit tps///////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='prosesedittps'){
	mysqli_query($koneksi,"UPDATE tps SET id_kecamatan='$_POST[id_kecamatan]',id_desa='$_POST[id_desa]',no_tps='$_POST[no_tps]' WHERE id_tps='$_GET[id_tps]'");
echo "<script>window.location=('index.php?aksi=tps')</script>";
}
elseif($_GET['aksi']=='prosesupdatesuara'){
	mysqli_query($koneksi,"UPDATE tps SET status='sudah' WHERE id_tps='$_GET[id_tps]'");
echo "<script>window.location=('index.php?aksi=inputdata')</script>";
}
///////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='proseseditmenu'){
	mysqli_query($koneksi,"UPDATE menu SET nama_menu='$_POST[nama_menu]',link='$_POST[link]',link_b='$_POST[link_b]',status='$_POST[status]',icon_menu='$_POST[icon_menu]',aktif='$_POST[aktif]' WHERE id_menu='$_GET[id_menu]'");
echo "<script>window.location=('index.php?aksi=menu')</script>";
}
elseif($_GET['aksi']=='proseseditsubmenu'){
	mysqli_query($koneksi,"UPDATE submenu SET nama_sub='$_POST[nama_sub]',link_sub='$_POST[link_sub]',icon_sub='$_POST[icon_sub]' WHERE id_sub='$_GET[id_sub]'");
echo "<script>window.location=('index.php?aksi=submenu')</script>";
}

elseif($_GET['aksi']=='proseseditjabatan'){
	mysqli_query($koneksi,"UPDATE jabatan SET nama_jabatan='$_POST[nama_jabatan]' WHERE id_jabatan='$_GET[id_jabatan]'");
echo "<script>window.location=('index.php?aksi=jabatan')</script>";
}
elseif($_GET['aksi']=='proseseditprofesi'){
	mysqli_query($koneksi,"UPDATE profesi SET nama_profesi='$_POST[nama_profesi]' WHERE id_profesi='$_GET[id_profesi]'");
echo "<script>window.location=('index.php?aksi=profesi')</script>";
}
elseif($_GET['aksi']=='proseseditadmin'){
$nama  = $_POST['nama'];
$username = $_POST['username'];
$pwd = $_POST['password'];
$password = md5($_POST['password']);
// cek gambar
$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if($pwd=="" && $filename==""){
	mysqli_query($koneksi, "update user set user_nama='$nama', user_username='$username' where user_id='$_GET[user_id]'");
	echo "<script>window.location=('index.php?aksi=admin')</script>";
}elseif($pwd==""){
	if(!in_array($ext,$allowed) ) {
			echo "<script>window.location=('index.php?aksi=admin')</script>";
	}else{
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename);
		$x = $rand.'_'.$filename;
		mysqli_query($koneksi, "update user set user_nama='$nama', user_username='$username', user_foto='$x' where user_id='$_GET[user_id]'");		
			echo "<script>window.location=('index.php?aksi=admin')</script>";
	}
}elseif($filename==""){
	mysqli_query($koneksi, "update user set user_nama='$nama', user_username='$username', user_password='$password' where user_id='$_GET[user_id]'");
	echo "<script>window.location=('index.php?aksi=admin')</script>";
}
}
elseif($_GET['aksi']=='proseseditpegawai'){
	$password = md5($_POST['nik']);
	mysqli_query($koneksi,"UPDATE pegawai SET 
	nama_pegawai='$_POST[nama_pegawai]',
    kode_pegawai='$_POST[kode_pegawai]',
    nik='$_POST[nik]',
    tgl_lahir='$_POST[tgl_lahir]',
	jenis_kelamin='$_POST[jenis_kelamin]',	
	status_pegawai='$_POST[status_pegawai]'
	WHERE id_pegawai='$_GET[id_pegawai]'");
echo "<script>window.location=('index.php?aksi=pegawai')</script>";
}
elseif($_GET['aksi']=='proseseditkeluarga'){
	mysqli_query($koneksi,"UPDATE keluarga SET 
	id_pegawai='$_POST[id_pegawai]',
    nama_keluarga='$_POST[nama_keluarga]',
    jk_keluarga='$_POST[jk_keluarga]',
    tempatlahir_keluarga='$_POST[tempatlahir_keluarga]',
    tgllahir_keluarga='$_POST[tgllahir_keluarga]',
    status_keluarga='$_POST[status_keluarga]',
	pekejaan_keluarga='$_POST[pekejaan_keluarga]',	
	penghasilan_keluarga='$_POST[penghasilan_keluarga]',
	ket_keluarga='$_POST[ket_keluarga]',
	tunjang_status='$_POST[tunjang_status]',
	status_aktif='$_POST[status_aktif]'
	WHERE id_keluarga='$_GET[id_keluarga]'");
echo "<script>window.location=('index.php?aksi=listtunjangan&id_pegawai=$_POST[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='prosesedianak'){
	mysqli_query($koneksi,"UPDATE keluarga SET 
	id_pegawai='$_POST[id_pegawai]',
    nama_keluarga='$_POST[nama_keluarga]',
    jk_keluarga='$_POST[jk_keluarga]',
    tempatlahir_keluarga='$_POST[tempatlahir_keluarga]',
    tgllahir_keluarga='$_POST[tgllahir_keluarga]',
    status_keluarga='$_POST[status_keluarga]',
	pekejaan_keluarga='$_POST[pekejaan_keluarga]',	
	pendidikan_keluarga='$_POST[pendidikan_keluarga]',
	ket_keluarga='$_POST[ket_keluarga]',
	tunjang_status='$_POST[tunjang_status]',
	tgl_mati='$_POST[tgl_mati]',
	status_nikah='$_POST[status_nikah]',
	status_beasiswa='$_POST[status_beasiswa]',
	anak_angkat_status='$_POST[anak_angkat_status]',
	status_sekolah='$_POST[status_sekolah]',
	status_aktif='$_POST[status_aktif]'
	WHERE id_keluarga='$_GET[id_keluarga]'");
echo "<script>window.location=('index.php?aksi=listtunjangan&id_pegawai=$_POST[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='ajukantunjangan'){
	$tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE  id_pegawai=$_GET[id_pegawai]");
  $t=mysqli_fetch_array($tebaru);
    mysqli_query($koneksi,"UPDATE keluarga SET 	tunjang_status='pengajuan' WHERE id_keluarga='$_GET[id_keluarga]'"); 
echo "<script>window.location=('index.php?aksi=listtunjangan&id_pegawai=$t[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='tidakajukantunjangan'){
	$tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE  id_pegawai=$_GET[id_pegawai]");
  $t=mysqli_fetch_array($tebaru);
    mysqli_query($koneksi,"UPDATE keluarga SET 	tunjang_status='tidak' WHERE id_keluarga='$_GET[id_keluarga]'"); 
echo "<script>window.location=('index.php?aksi=listtunjangan&id_pegawai=$t[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='proseseditpangku'){
    mysqli_query($koneksi,"UPDATE pemangku SET 	nama_pkjab='$_POST[nama_pkjab]' WHERE id_pkjab='$_GET[id_pkjab]'"); 
echo "<script>window.location=('index.php?aksi=pangku')</script>";
}
elseif($_GET['aksi']=='proseseditpangkujabatan'){
	mysqli_query($koneksi,"UPDATE pemangkujabatan SET id_pegawai='$_POST[id_pegawai]',id_pkjab='$_POST[id_pkjab]',nomor_surat='$_POST[nomor_surat]',tanggal_surat='$_POST[tanggal_surat]' WHERE id_pangku='$_GET[id_pangku]'"); 
echo "<script>window.location=('index.php?aksi=pangkujabatan')</script>";
}
elseif($_GET['aksi']=='proseseditprofil'){
    mysqli_query($koneksi,"UPDATE profil SET nama='$_POST[nama]',alias='$_POST[alias]' WHERE id_profil ='$_GET[id_profil]'"); 
echo "<script>window.location=('index.php?aksi=kadis')</script>";
}

?>