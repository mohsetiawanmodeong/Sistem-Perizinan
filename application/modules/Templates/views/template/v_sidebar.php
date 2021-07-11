<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('frontend/assets/images/logo/small_30loguser.png');?>" width="50" height=""
                alt="Logo">
        </div>
        <div class="sidebar-brand-text mx-3"></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard Start -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- Nav Item - Dashboard End -->

    <!-- Nav Item - Users Start -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master:</h6>
                <a class="collapse-item" href="<?= base_url('Users');?>"> <i class="fa fa-user"></i> User</a>
                <a class="collapse-item" href="<?= base_url('Users/Role');?>"> <i class="fa fa-user"></i> Role</a>
                <a class="collapse-item" href="<?= base_url('Dashboard/Perizinan');?>"> <i class="fa fa-newspaper"></i>
                    Jenis
                    Perizinan</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Users End -->

    <!-- Nav Item - Perusahaan Start -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Dashboard/Perusahaan'); ?>">
            <i class="fa fa-fw fa-building"></i>
            <span>Perusahaan</span>
        </a>
    </li>

    <!-- Nav Item - Perusahaan End -->
    <!-- Nav Item - Pengajuan Start -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Dashboard/Pengajuan'); ?>">
            <i class="fa fa-fw fa-check-circle"></i>
            <span>Pengajuan</span>
        </a>
    </li>
    <!-- Nav Item - Pengajuan End -->

    <!-- Nav Item - Pengaturan Start -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Dashboard/WebSettings'); ?>">
            <i class="fa fa-fw fa-gear"></i>
            <span>Pengaturan</span>
        </a>
    </li>
    <!-- Nav Item - Pengaturan End -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->