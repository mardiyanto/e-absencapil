
  <head>

    <link rel="stylesheet" href="../sys/bootstrap/plugins/morris/morris.css">
<link rel="stylesheet" href="../sys/bootstrap/ionicons.min.css">
  </head>
  <?php
// Query SQL untuk menghitung total suara sah
$querySuaraSah = "SELECT SUM(suara_sah) AS total_suara_sah FROM suara";

// Eksekusi query
$resultSuaraSah = mysqli_query($koneksi, $querySuaraSah);
$rowSuaraSah = mysqli_fetch_assoc($resultSuaraSah);
$totalSuaraSah = $rowSuaraSah['total_suara_sah'];

// Query SQL untuk menghitung total suara tidak sah
$querySuaraTidakSah = "SELECT SUM(suara_rusak) AS total_suara_tidak_sah FROM suara";

// Eksekusi query
$resultSuaraTidakSah = mysqli_query($koneksi, $querySuaraTidakSah);
$rowSuaraTidakSah = mysqli_fetch_assoc($resultSuaraTidakSah);
$totalSuaraTidakSah = $rowSuaraTidakSah['total_suara_tidak_sah'];


?>
  <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Progress Bars Different Sizes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <p>TOTAL SUARA SAH <code>: <?=$totalSuaraSah?></code></p>
                  <div class="progress active">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                      <span class="sr-only"><?=$totalSuaraSah?> SUARA</span>
                    </div>
                  </div>
                  <p>TOTAL SUARA TIDAK SAH <code>:<?=$totalSuaraTidakSah?></code></p>
                  <div class="progress  active">
                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                      <span class="sr-only"><?=$totalSuaraTidakSah?> SUARA</span>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (left) -->
          </div><!-- /.row -->
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
                    <img class="img-circle" src="../sys/pileg.jpg" alt="User Avatar">
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


    <!-- jQuery 2.1.4 -->
    <script src="../sys/bootstrap/plugins/jQuery/jQuery-2.1.4.min.js"></script>
   
    <!-- Morris.js charts -->
    <script src="../sys/bootstrap/raphael-min.js"></script>
    <script src="../sys/bootstrap/plugins/morris/morris.min.js"></script>
    <!-- FastClick -->

    <script>
      
      $(function () {
        "use strict";
        //DONUT CHART
  
        var donutData = <?php // Query SQL dengan JOIN dan GROUP BY
$sql = "SELECT p.id_paslon,p.nama_paslon, SUM(s.suara_sah) AS total_suara_sah
        FROM paslon p
        JOIN suara s ON p.id_paslon = s.id_paslon
        GROUP BY p.id_paslon";

$result = $koneksi->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        "label" =>  $row["nama_paslon"],
        "value" => $row["total_suara_sah"]
    );
}

echo json_encode($data);
?>;

var donut = new Morris.Donut({
    element: 'sales-chart',
    resize: true,
    colors: ["#3c8dbc", "#f56954", "#00a65a"],
    data: donutData,
    hideHover: 'auto'
});
        //BAR CHART
        var barData = <?php
// Query SQL dengan JOIN dan GROUP BY
$sql = "SELECT p.id_paslon,p.nama_paslon, SUM(s.suara_sah) AS total_suara_sah, SUM(s.suara_rusak) AS total_suara_rusak
        FROM paslon p
        JOIN suara s ON p.id_paslon = s.id_paslon
        GROUP BY p.id_paslon";

$result = $koneksi->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        "y" => $row["nama_paslon"],
        "a" => $row["total_suara_sah"],
        "b" => $row["total_suara_rusak"]
    );
}

echo json_encode($data);
?>;

var bar = new Morris.Bar({
    element: 'bar-chart',
    resize: true,
    data: barData,
    barColors: ['#00a65a', '#f56954'],
    xkey: 'y',
    ykeys: ['a', 'b'],
    labels: ['Suara Sah', 'Suara Rusak'],
    hideHover: 'auto'
});


     
      
      });
    </script>
  </body>
</html>
