<?php 
if($_GET['aksi']=='home'){ ?>

<?php } 
elseif($_GET['aksi']=='datang'){ 
  ?> 
  <h1 class="h3 mb-2 text-gray-800">Absensi</h1>
  <p class="mb-4">untuk absensi silahkan masukan kode kariawan absensi hanya bisa dilakukan sekali datang dan sekali pulang</p>		

<div class="row">
    <div class="col-lg-12">
      <div class="card shadow mb-4"> 
          <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">PEGAWAI</h6></div>
              <div class="card-body">
                  <div class="text-center"> 
                     <button type="button" class="btn btn-outline-success btn-lg"><?php echo "Sekarang Jam " . date("h:i:sa");?></button>
                      <!-- deteksi lokasi <p id="status"></p> </div>
                        <form method='post' action='absen.php?aksi=prosesdatang' enctype='multipart/form-data' id="frmPresensi" style="display: none;">
                          <div class='form-group'>
                              <label>Kode Kariawan</label>
                               <input type='text' class='form-control' name='kode_pegawai' id='kode_pegawai' /><br>
                                <div class='modal-footer'><button type="submit" class="btn btn-primary">Submit</button></div>
                          </div>   
                        </form> -->
                        <form method='post' action='absen.php?aksi=prosesdatang' enctype='multipart/form-data' >
                          <div class='form-group'>
                              <label>Kode Kariawan</label>
                               <input type='text' class='form-control' name='kode_pegawai' id='kode_pegawai' /><br>
                                <div class='modal-footer'><button type="submit" class="btn btn-primary">Submit</button></div>
                          </div>   
                        </form>
              </div>
      </div>
    </div>

        <div class="col-lg-12">
        <div class="card shadow mb-4"> 
        <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">MAP</h6>
                </div>
           <div class="card-body">
           <div id="map"></div>
           </div>
           </div>
        </div>
</div>

<?php } 
elseif($_GET['aksi']=='prosesdatang'){
// Melakukan pengecekan inputan
$kode_pegawai = $_POST["kode_pegawai"];
$login = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE kode_pegawai='$kode_pegawai'");
$cek = mysqli_num_rows($login);
if($cek > 0){
  $data = mysqli_fetch_assoc($login);
  $id_pegawai= $data['id_pegawai'];
  $kode_pegawai= $data['kode_pegawai'];
  header("location:absendatang.php?id_pegawai=$id_pegawai");
} else {
  echo "<script>alert('Kode Kariawan Salah');window.location.href='absen.php?aksi=datang'</script>";
}

}
elseif($_GET['aksi']=='pulang'){ 
  ?> <h1 class="h3 mb-2 text-gray-800">Absensi</h1>
  <p class="mb-4">untuk absensi silahkan masukan kode kariawan absensi hanya bisa dilakukan sekali datang dan sekali pulang</p>
  
<div class="row">
    <div class="col-lg-12">
      <div class="card shadow mb-4"> 
          <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">PEGAWAI</h6></div>
              <div class="card-body">
                  <div class="text-center"> 
                     <button type="button" class="btn btn-outline-success btn-lg"><?php echo "Sekarang Jam " . date("h:i:sa");?></button>
                      <!-- <p id="status"></p></div>
                        <form method='post' action='absen.php?aksi=prosespulang1' enctype='multipart/form-data' id="frmPresensi" style="display: none;">
                          <div class='form-group'>
                              <label>Kode Kariawan</label>
                               <input type='text' class='form-control' name='kode_pegawai' id='kode_pegawai' /><br>
                                <div class='modal-footer'><button type="submit" class="btn btn-primary">Submit</button></div>
                          </div>   
                        </form> -->
                        <form method='post' action='absen.php?aksi=prosespulang' enctype='multipart/form-data' >
                          <div class='form-group'>
                              <label>Kode Kariawan</label>
                               <input type='text' class='form-control' name='kode_pegawai' id='kode_pegawai' /><br>
                                <div class='modal-footer'><button type="submit" class="btn btn-primary">Submit</button></div>
                          </div>   
                        </form>
                   
              </div>
      </div>
    </div>

        <div class="col-lg-12">
        <div class="card shadow mb-4"> 
        <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">MAP</h6>
                </div>
           <div class="card-body">
           <div id="map"></div>
           </div>
           </div>
        </div>
</div>



<?php } 
elseif($_GET['aksi']=='prosespulang'){
// Melakukan pengecekan inputan
$kode_pegawai = $_POST["kode_pegawai"];
$login = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE kode_pegawai='$kode_pegawai'");
$cek = mysqli_num_rows($login);
if($cek > 0){
  $data = mysqli_fetch_assoc($login);
  $id_pegawai= $data['id_pegawai'];
  $kode_pegawai= $data['kode_pegawai'];
  header("location:absenpulang.php?id_pegawai=$id_pegawai");
} else {
  echo "<script>alert('Kode Kariawan Salah');window.location.href='absen.php?aksi=pulang'</script>";
}

}
elseif($_GET['aksi']=='login'){ 
  ?>
   <h1 class="h3 mb-2 text-gray-800">Absensi</h1>
                    <p class="mb-4">untuk absensi silahkan masukan kode kariawan absensi hanya bisa dilakukan sekali datang dan sekali pulang</p>
      <div class="row">
        <div class="col-lg-6">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Isikan Kode Kariawan</h6>
                </div>
                <div class="card-body">
                    <form method='post' action='absen.php?aksi=proseslogin' enctype='multipart/form-data'>
                        <div class='form-group'>
                            <label>Kode Kariawan</label>
                            <input type='text' class='form-control' name='kode_pegawai' id='kode_pegawai' /><br>
                            <div class='modal-footer'>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php } 
elseif($_GET['aksi']=='proseslogin'){ 
  // Melakukan pengecekan inputan
  $kode_pegawai = $_POST["kode_pegawai"];
  $login = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE kode_pegawai='$kode_pegawai'");
	$cek = mysqli_num_rows($login);
	if($cek > 0){
		session_start();
		$data = mysqli_fetch_assoc($login);
		$_SESSION['id_pegawai'] = $data['id_pegawai'];
		$_SESSION['nama_pegawai'] = $data['nama_pegawai'];
		header("location:absen.php");
	}else{
		echo "<script>alert('Kode Kariawan Salah');window.location.href='absen.php?aksi=login'</script>";
	}
  ?>

<?php } 
elseif($_GET['aksi']=='inputhubungi'){ 
  mysqli_query($koneksi,"insert into kritik (nama,email,pesan) values ('$_POST[nama]','$_POST[email]','$_POST[pesan]')");  
  echo "<script>window.alert('terimakasih telah meninggalkan pesan di sini');
  window.location=('index.php')</script>";
  ?>

<?php } ?>
