<?php 
if($_GET['aksi']=='home'){ ?>
<section class="content-header">
            <h1>
              APLIKASI PEMILIHAN KETUA OSIS
              <small>V 1.0</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Layout</a></li>
              <li class="active">Top Navigation</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
			<div class="row">
 <?php
 // Query SQL dengan JOIN dan GROUP BY
$sql = "SELECT p.id_paslon, p.nama_paslon, SUM(s.suara_sah) AS total_suara_sah, SUM(s.suara_rusak) AS total_suara_rusak
FROM paslon p
JOIN suara s ON p.id_paslon = s.id_paslon
GROUP BY p.id_paslon";

$result = $koneksi->query($sql);

if ($result->num_rows > 0) { 
// Menampilkan data hasil GROUP BY
while ($row = $result->fetch_assoc()) { ?>
        <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                  <div class="widget-user-image">
                  <img class="img-circle" src="foto/paslon/<?=$row["foto"]?>" alt="User Avatar">
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username"><?=$row["nama_paslon"]?></h3>
                  <h5 class="widget-user-desc"><?php echo"$k_k[nama_app]";?> <?php echo"$k_k[alias]";?></h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="#">Total Suara Sah <span class="pull-right badge bg-blue"><?=$row["total_suara_sah"]?></span></a></li>
                    <li><a href="#">Total Suara Tidak Sah <span class="pull-right badge bg-aqua"><?=$row["total_suara_rusak"]?></span></a></li>

                  </ul>
                </div>
              </div><!-- /.widget-user -->
            </div><!-- /.col -->
            <?php }
} else { ?>
 <div class="col-md-12">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Removable</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  DATA PASLON BELUM DI INPUT DI SISTEM
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
<?php } ?>
  </div>

    
          <div class="row">
            <div class="col-md-12">
              <!-- AREA CHART -->
                <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Grafik data paslon</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (LEFT) -->
            <div class="col-md-12">
			 <!-- DONUT CHART -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Grafik data paslon</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->
          </section><!-- /.content -->

<?php } 
elseif($_GET['aksi']=='login'){ 
  $id_paslon=$_GET['id_paslon']; 
    $tebaru=mysqli_query($koneksi," SELECT * FROM paslon WHERE id_paslon= $id_paslon");
    $t=mysqli_fetch_array($tebaru);
  ?>
<section class="content-header">
            <h1>
              APLIKASI PEMILIHAN KETUA OSIS
              <small>V 1.0</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Layout</a></li>
              <li class="active">Top Navigation </li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
<div class="row">
            <!-- left column -->
  <div class="col-md-12">
              <div class="box box-primary">
                              <div class="box-header with-border">
                                <h3 class="box-title">Anda Akan Memilih Ketua OSIS <?=$t[nama_paslon]?></h3>
                              </div><!-- /.box-header -->
                              <!-- form start -->
                              <form action="index.php?aksi=proseslogin" method="POST">
                                <div class="box-body">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">NISN</label>
                                    <input type="text" class="form-control" name='nisn' placeholder="NISN">
                                    <input type='hidden'  name='id_paslon' value='<?=$t[id_paslon]?>'>
                                    <input type='hidden' name='suara_sah' value='1'/>
                                  </div>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
              </div><!-- /.box -->
     </div><!-- /.col -->
 </div><!-- /.row -->
 </section><!-- /.content -->
	
<?php } 
elseif($_GET['aksi']=='proseslogin'){ 
  // Melakukan pengecekan inputan
  $nisn = $_POST["nisn"];
  $login = mysqli_query($koneksi, "SELECT * FROM pemilih WHERE nisn='$nisn'");
	$cek = mysqli_num_rows($login);
	if($cek > 0){
    $data = mysqli_fetch_assoc($login);
    $id_pemilih = $data['id_pemilih'];
    $tahun = date("Y");
    $query_check = "SELECT * FROM suara WHERE  id_pemilih = '$id_pemilih'  AND tahun = '$tahun'";
    $result_check = mysqli_query($koneksi, $query_check);
    $num_rows = mysqli_num_rows($result_check);
    if ($num_rows > 0) {
      echo "<script>alert('ANDA SUDAH MEMILIH SEBELUMNYA!');window.location.href='index.php?aksi=login&id_paslon=$_POST[id_paslon]'</script>";
    } else {
      mysqli_query($koneksi,"insert into suara (id_pemilih,id_paslon,suara_sah,tahun) values ('$id_pemilih','$_POST[id_paslon]','$_POST[suara_sah]','$tahun')"); 
      echo "<script>alert('Data berhasil di inputkan');window.location.href='index.php'</script>";
    } 
    
  } else {
    echo "<script>alert('Data belum terdaftar');window.location.href='index.php?aksi=login&id_paslon=$_POST[id_paslon]'</script>";
  }
       // Me 
  ?>

<?php } ?>
