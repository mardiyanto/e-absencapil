<?php
  include '../koneksi.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if($_SESSION['status'] != "administrator_logedin"){
    header("location:../login.php?alert=belum_login");
  }
///////////////////////////lihat/////////////////////////////////////////////
if($_GET['aksi']=='hapuspaslon'){
// Ambil ID data yang akan dihapus
$id_paslon = $_GET['id_paslon'];

// Ambil informasi file yang akan dihapus
$sql_select = "SELECT foto FROM paslon WHERE id_paslon = $id_paslon";
$result_select = mysqli_query($koneksi, $sql_select);

if ($result_select) {
    $row = mysqli_fetch_assoc($result_select);
    $file_path = "../foto/paslon/" . $row['foto'];

    // Hapus file dari direktori
    if (unlink($file_path)) {
        // Hapus data dari database
        $sql_delete = "DELETE FROM paslon WHERE id_paslon = $id_paslon";
        if (mysqli_query($koneksi, $sql_delete)) {
            echo "<script>window.location=('index.php?aksi=paslon&error=File dan data berhasil dihapus.')</script>";
        } else {
            echo "Error: " . $sql_delete . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "<script>window.location=('index.php?aksi=paslon&error=Maaf, terjadi kesalahan saat menghapus file.')</script>";
    }
} else {
    echo "<script>window.location=('index.php?aksi=paslon&error=Maaf, terjadi kesalahan saat mengambil informasi file.')</script>";
}

}
elseif($_GET['aksi']=='hapussemuadata'){
  // Perintah SQL untuk menghapus semua data dari tabel paslon
$sql = "DELETE FROM suara";

// Eksekusi perintah SQL
if (mysqli_query($koneksi, $sql)) {
    echo "<script>window.location=('index.php?aksi=suara&error=Semua data dari tabel suara berhasil dihapus.')</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}
}
elseif($_GET['aksi']=='hapusdesa'){
  mysqli_query($koneksi,"DELETE FROM desa  WHERE id_desa='$_GET[id_desa]'");
  echo "<script>window.location=('index.php?aksi=desa')</script>";
}
///////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_GET['aksi']=='hapusmenu'){
mysqli_query($koneksi,"DELETE FROM menu  WHERE id_menu='$_GET[id_menu]'");
echo "<script>window.location=('index.php?aksi=menu')</script>";
}

elseif($_GET['aksi']=='hapussubmenu'){
  mysqli_query($koneksi,"DELETE FROM submenu  WHERE id_sub='$_GET[id_sub]'");
  echo "<script>window.location=('index.php?aksi=submenu')</script>";
  }
elseif($_GET['aksi']=='hapussuara'){
mysqli_query($koneksi,"DELETE FROM suara  WHERE id_suara='$_GET[id_suara]'");
echo "<script>window.location=('index.php?aksi=inputdata')</script>";
}
elseif($_GET['aksi']=='hapusjabatan'){
mysqli_query($koneksi,"DELETE FROM jabatan  WHERE id_jabatan='$_GET[id_jabatan]'");
echo "<script>window.location=('index.php?aksi=jabatan')</script>";
}
elseif($_GET['aksi']=='hapusadmin'){
$data = mysqli_query($koneksi, "select * from user where user_id='$_GET[user_id]'");
$d = mysqli_fetch_assoc($data);
$foto = $d['user_foto'];
unlink("../gambar/user/$foto");
mysqli_query($koneksi, "delete from user where user_id='$_GET[user_id]'");
echo "<script>window.location=('index.php?aksi=admin')</script>";
}
elseif($_GET['aksi']=='hapuspegawai'){
  mysqli_query($koneksi,"DELETE FROM pegawai  WHERE id_pegawai='$_GET[id_pegawai]'");
  echo "<script>window.location=('index.php?aksi=pegawai')</script>";
  }
elseif($_GET['aksi']=='hapusberkas'){
    $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE  id_pegawai=$_GET[id_pegawai]");
    $t=mysqli_fetch_array($tebaru);
    $data = mysqli_query($koneksi, "select * from file where file_id='$_GET[file_id]'");
    $d = mysqli_fetch_assoc($data);
    $file = $d['file_name'];
    unlink("upload/$file");
    mysqli_query($koneksi, "delete from file where file_id='$_GET[file_id]'");
    echo "<script>window.location=('index.php?aksi=listuploadfile&id_pegawai=$t[id_pegawai]')</script>";
}
elseif($_GET['aksi']=='hapuskeluarga'){
  $tebaru=mysqli_query($koneksi," SELECT * FROM pegawai WHERE  id_pegawai=$_GET[id_pegawai]");
  $t=mysqli_fetch_array($tebaru);
  mysqli_query($koneksi,"DELETE FROM keluarga  WHERE id_keluarga='$_GET[id_keluarga]'");
  echo "<script>window.location=('index.php?aksi=listtunjangan&id_pegawai=$t[id_pegawai]')</script>";
  }
  elseif($_GET['aksi']=='hapustunjangan'){
    mysqli_query($koneksi,"DELETE FROM tunjangan  WHERE id_tunjangan='$_GET[id_tunjangan]'");
    mysqli_query($koneksi,"UPDATE pegawai SET status_pg='ada' WHERE id_pegawai='$_GET[id_pegawai]'"); 
    echo "<script>window.location=('index.php?aksi=tunjangan')</script>";
    } 
elseif($_GET['aksi']=='hapuspangku'){
      mysqli_query($koneksi,"DELETE FROM pemangku  WHERE 	id_pkjab='$_GET[id_pkjab]'");
      echo "<script>window.location=('index.php?aksi=pangku')</script>";
 }    
 

?>