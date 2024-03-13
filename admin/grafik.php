<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
<?php // Query SQL untuk menghitung total baris dalam tabel pegawai
$query = "SELECT COUNT(*) as total FROM pegawai";
// Jalankan query
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
 // Total baris dalam tabel pegawai
$total_pegawai = $row['total'];
?>
<?php
// Mendapatkan tanggal hari ini
$today = date("Y-m-d");
// Query SQL untuk menghitung total presensi datang berdasarkan tanggal absensi datang hari ini
$querydatang = "SELECT COUNT(*) as total FROM presensi_datang WHERE tanggal_absensi_datang = '$today' AND status_absensi_datang = 'datang'";
// Jalankan query
$result = $koneksi->query($querydatang);
$rowdatang = $result->fetch_assoc();

$total_presensi_datang = $rowdatang['total'];
// Query SQL untuk menghitung total presensi pulang berdasarkan tanggal absensi pulang hari ini
$querypulang= "SELECT COUNT(*) as total FROM presensi_pulang WHERE tanggal_absensi_pulang = '$today' AND status_absensi_pulang = 'pulang'";
// Jalankan query
$result = $koneksi->query($querypulang);
$rowpulang = $result->fetch_assoc();
 // Total presensi pulang berdasarkan tanggal absensi hari ini
$total_presensi_pulang = $rowpulang['total'];
$total_presensi = $total_presensi_datang + $total_presensi_pulang;
$total = $total_presensi -$total_presensi_datang;
?>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               TOTAL KARIAWAN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo"$total_pegawai" ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                ABSENSI DATANG HARI INI</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo"$total_presensi_datang" ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ABSESI PULANG HARI INI
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo"$total_presensi_pulang" ?></div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                TOTAL ABSENSI HARI INI</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo"$total" ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    