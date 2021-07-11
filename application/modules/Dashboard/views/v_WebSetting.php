<script src="<?= base_url('frontend') ?>/assets/vendor/tinymce/tinymce.min.js"></script>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span
                            class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('username'); ?></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item"
                            href="<?= base_url('Dashboard/Profuser/' . $this->session->userdata('id')); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?= $breadcumb; ?></h1>
            </div>
            <!-- Content Row -->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <div class="dropdown no-arrow">
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="x_content">
                                <div class="right_col" role="main" style="min-height: 2098px;">
                                    <div id="alert-message">
                                        <div class="center">
                                            <strong><?= $this->session->flashdata('message'); ?></strong>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="x_panel">
                                                    <div class="x_content">
                                                        <p class="text-muted font-13 m-b-30"></p>
                                                        <div class="table-responsive">
                                                            <?= form_open("Dashboard/ActionEditWebSetting/".$WebSetting[0]['id'], array("id" => "form-perizinan", "class" => "form-horizontal")) ?>
                                                            <div class="form-group">
                                                                <label for="name">Nama Aplikasi</label>
                                                                <input type="text" id="name" name="name"
                                                                    class="form-control"
                                                                    value="<?= $WebSetting[0]['nama_aplikasi'];?>"
                                                                    required>
                                                                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="alamat">Alamat</label>
                                                                <input type="text" id="alamat" name="alamat"
                                                                    class="form-control"
                                                                    value="<?= $WebSetting[0]['address'];?>" required>
                                                                <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                                            </div>
                                                            <hr class="sidebar-divider d-none d-md-block">
                                                            <div class="form-group">
                                                                <div class="col-sm-10 text-center">
                                                                    <span>
                                                                        <b>
                                                                            <h2>
                                                                                Setting Email
                                                                            </h2>
                                                                        </b>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="host">Host Email</label>
                                                                <input type="text" id="host" name="host"
                                                                    class="form-control"
                                                                    value="<?= $WebSetting[0]['host'];?>" required>
                                                                <?= form_error('host', '<small class="text-danger">', '</small>'); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username">Username Email</label>
                                                                <input type="email" id="username" name="username"
                                                                    class="form-control"
                                                                    value="<?= $WebSetting[0]['username'];?>" required>
                                                                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">Password Email</label>
                                                                <input type="text" id="password" name="password"
                                                                    class="form-control"
                                                                    value="<?= $WebSetting[0]['password'];?>" required>
                                                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <font style="color:red">
                                                                    Note : Pastikan Semua Data Email Sesuai Agar Fungsi
                                                                    Email Dapat Berjalan Dengan Semestinya
                                                                </font>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="ik ik-save"></i>
                                                                Save</button>
                                                        </div>
                                                        <?= form_close() ;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Small modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('login/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>