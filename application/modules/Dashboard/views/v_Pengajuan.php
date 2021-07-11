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
                            href="<?= base_url('Dashboard/profuser/' . $this->session->userdata('id')); ?>">
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
                                                        <!-- <a data-toggle="modal" data-target="#addPerusahaan"
                                                            class="btn btn-success"><i
                                                                class="fas fa-building fa-fw"></i>
                                                            &nbsp; Add Pengajuan</a> -->
                                                        <p class="text-muted font-13 m-b-30"></p>
                                                        <div class="table-responsive">
                                                            <table style="font-size: 15px" id="tablePengajuan"
                                                                class="table table-striped table-bordered dt-responsive nowrap"
                                                                cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Jenis Perizinan</th>
                                                                        <th>Tgl Pengajuan</th>
                                                                        <th>Nama Perusahaan</th>
                                                                        <th>Tgl diSetujui</th>
                                                                        <th>Status</th>
                                                                        <th>Keterangan</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Small modal -->

                                <!-- Modal Add Perusahaan Start -->
                                <?= form_open("Dashboard/addPerusahaan", array("id" => "form-Perusahaan", "class" => "form-horizontal")) ?>
                                <div class="modal fade" id="addPerusahaan" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="modal">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="demoModalLabel">Add New Users</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="the-message"></div>

                                                <div class="form-group">
                                                    <label for="nama">Nama Perusahaan</label>
                                                    <input type="text" class="form-control" name="nama"
                                                        placeholder="Masukkan Nama Perusahaan"
                                                        value="<?= set_value('nama'); ?>" autofocus>
                                                </div>

                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" class="form-control" name="alamat"
                                                        placeholder="Masukkan Alamat Perusahaan"
                                                        value="<?= set_value('alamat'); ?>" autofocus>
                                                </div>

                                                <div class="form-group">
                                                    <label for="npwp">NPWP</label>
                                                    <input type="text" class="form-control" name="npwp"
                                                        placeholder="Masukkan NPWP Perusahaan"
                                                        value="<?= set_value('npwp'); ?>" autofocus>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Masukkan Email Perusahaan"
                                                        value="<?= set_value('email'); ?>" autofocus>
                                                </div>

                                                <div class="form-group">
                                                    <label for="no_telp">Nomor Telephone</label>
                                                    <input type="text" class="form-control" name="no_telp"
                                                        placeholder="Masukkan Nomor Telephone Perusahaan"
                                                        value="<?= set_value('no_telp'); ?>" autofocus>
                                                </div>

                                                <div class="form-group">
                                                    <label for="pic">PIC</label>
                                                    <input type="text" class="form-control" name="pic"
                                                        placeholder="Masukkan Kontak PIC Perusahaan"
                                                        value="<?= set_value('pic'); ?>" autofocus>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary"><i class="ik ik-save"></i>
                                                    Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?= form_close();?>
                                <!-- Modal ADD Category End -->
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