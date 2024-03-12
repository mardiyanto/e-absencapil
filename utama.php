
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
$sql = "SELECT * FROM paslon ORDER BY id_paslon DESC";
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
                    <img  src="foto/paslon/<?=$row["foto"]?>" alt="User Avatar">
                  </div><!-- /.widget-user-image -->
                  <h3 class="widget-user-username"><?=$row["nama_paslon"]?></h3>
                  <h5 class="widget-user-desc"><?php echo"$k_k[nama_app]";?> <?php echo"$k_k[alias]";?></h5>
                </div>
                <a href="index.php?aksi=login&id_paslon=<?=$row["id_paslon"]?>" class="btn btn-primary btn-block"><b>PILIH</b></a>
              </div><!-- /.widget-user -->
                      <!-- About Me Box -->
                      <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tentang <?=$row["nama_paslon"]?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-book margin-r-5"></i>  Tempat Tanggal Lahir</strong>
                  <p class="text-muted">
                  <?=$row["tmp_lahir"]?>,<?=$row["tgl_lahir"]?>
                  </p>
                  <strong><i class="fa fa-book margin-r-5"></i>Riwayat Pendidikan</strong>
                
                  <?=$row["pendidikan"]?>
                 
                  <hr>
                  <strong><i class="fa fa-pencil margin-r-5"></i> Prestasi</strong>
                  <?=$row["prestasi"]?>
                  <hr>

                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Visi</strong>
                  <p><?=$row["visi"]?></p>
                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Misi</strong>
                  <p><?=$row["misi"]?></p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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

          </section><!-- /.content -->