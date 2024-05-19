<!-- <ul class="sidebar-menu">
  <li>
              <a href='index.php?aksi=home'>
                <i class='fa fa-dashboard'></i> <span>Dashboard</span> 
              </a> 
 </li>
 <li>      
      <a href="index.php?aksi=profil">
                  <i class="fa fa-briefcase"></i> <span>PROFIL</span>
                </a>
              </li>
<li class='treeview'>
               <a href='#'>
                 <i class='fa fa-bank'></i>
                 <span>MASTER DATA</span>
               </a>
               <ul class='treeview-menu'>
                <li><a href='index.php?aksi=pemilih'><i class='fa fa-arrows-h'></i> Pemilih</a></li>
                <li><a href='index.php?aksi=paslon'><i class='fa fa-arrows-h'></i> Paslon</a></li>
                <li><a href='index.php?aksi=suara'><i class='fa fa-arrows-h'></i> Suara</a></li>
               </ul>
</li>

      <li>      
      <a href="logout.php">
                  <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
                </a>
              </li>
</ul> -->

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?aksi=home">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo"$k_k[nama_app]";?> <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?aksi=home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>MASTER DATA</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="index.php?aksi=pegawai">Pegawai</a>

                        <a class="collapse-item" href="index.php?aksi=presensi">Absensi</a>
                        <a class="collapse-item" href="index.php?aksi=rekappresensi">Rekap Absensi</a>
                        <a class="collapse-item" href="index.php?aksi=map">Map</a>
                        <a class="collapse-item" href="index.php?aksi=kritik">Kritik</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?aksi=profil">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Profil</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php?aksi=admin">
                    <i class="fas fa-fw fa-table"></i>
                    <span>admin</span></a>
            </li>
            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Logout</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->