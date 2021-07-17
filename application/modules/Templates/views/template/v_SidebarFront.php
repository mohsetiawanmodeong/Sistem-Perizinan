<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
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
                    <?php
                    if($this->session->userdata('aktif') === TRUE){;?>
                    <a class="dropdown-item" href="<?= base_url('Front/Logout');?>">Logout</a>
                    <?php }else{
                    ;?>
                    <a class="dropdown-item" href="<?= base_url('Front/Login');?>">Login</a>
                    <a class="dropdown-item" href="<?= base_url('Front/Perizinan');?>">Register</a>
                    <?php }
                    ;?>

                </div>
            </li>
        </ul>
        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
    </div>
</nav>