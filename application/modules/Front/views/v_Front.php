<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container-fluid">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <?php
                                if($this->session->userdata('aktif') === TRUE){;?>
            <!-- Jika Session Aktif Tampilkan History Pesanan -->
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="col-sm-12 text-center">
                        <b>
                            <a href="<?= base_url('Home/DownloadTemplates');?>" target="_blank">
                                <i class="fa fa-download"></i> Template
                                Perizinan
                            </a>
                        </b>
                    </div>
                </div>
            </div>

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <b> History Pengajuan
                                        Perizinan</b>
                                </div>
                            </div>
                            <table id="tableHistoryPengajuan"
                                class="table table-striped table-bordered table-hover no-wrap">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            No
                                        </th>
                                        <th>Jenis Perizinan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal di Setujui / di Tolak</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
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

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tableHistoryBerkas"
                                class="table table-striped table-bordered table-hover no-wrap">
                                <thead>
                                    <tr>
                                        <th class="center">
                                            No
                                        </th>
                                        <th>Pengajuan</th>
                                        <th>Tanggal Upload</th>
                                        <th>Download</th>
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

            <?php }else{ ;?>
            <!-- Jika Session Tidak Aktif Tampilkan Halaman Home -->
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="col-sm-12 text-center">
                        <b>
                            Halaman Utama
                        </b>
                    </div>
                </div>
            </div>
            <?php }
                                ;?>

        </div>
    </div>
</div>