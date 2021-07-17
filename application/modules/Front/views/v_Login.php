<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $titles; ?></title>
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('frontend'); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('frontend'); ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-purple">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="<?= base_url('Front');?>">Home</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-registered"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?= base_url('Front/Pengajuan/1');?>">Bidang PRL</a>
                        <a class="dropdown-item" href="<?= base_url('Front/Pengajuan/2');?>">LP</a>
                        <a class="dropdown-item" href="<?= base_url('Front/Pengajuan/3');?>">Ijin Reklamasi</a>
                        <a class="dropdown-item" href="<?= base_url('Front/Pengajuan/4');?>">Sub Menu</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-registered"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?= base_url('Front/Pengajuan/5');?>">Bidang PT</a>
                        <a class="dropdown-item" href="<?= base_url('Front/Pengajuan/6');?>">Sub Menu</a>
                        <a class="dropdown-item" href="<?= base_url('Front/Pengajuan/7');?>">Sub Menu</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?= base_url('Front/Login');?>">Login</a>
                        <a class="dropdown-item" href="#">Register</a>
                    </div>
                </li>
            </ul>
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        </div>
    </nav>
    <div class="container-fluid">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b><?= $login; ?></b></h1>
                                    </div>
                                    <div id="alert-message">
                                        <div class="center">
                                            <strong><?= $this->session->flashdata('message'); ?></strong>
                                        </div>
                                    </div>
                                    <!-- <form class="user"> -->
                                    <form class="user" method="POST" enctype="multipart/form-data"
                                        action="<?= base_url('Front/Action') ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username"
                                                placeholder="Username" value="<?= set_value('username'); ?>" autofocus>
                                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="justify-content-center">
                                                <input type="submit" id="submit" name="submit" value="Submit"
                                                    class="btn btn-primary btn-user btn-block">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <a href="<?= base_url('Front/Perizinan'); ?>"
                                            class="btn btn-warning btn-block">Ajukan
                                            Perizinan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $("#alert-message").alert().delay(3000).slideUp('slow');
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src=" <?php echo base_url('frontend'); ?>/assets/vendor/jquery/jquery.min.js"> </script>
    <script src="<?php echo base_url('frontend'); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('frontend'); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('frontend'); ?>/assets/js/sb-admin-2.min.js"></script>

</body>

</html>