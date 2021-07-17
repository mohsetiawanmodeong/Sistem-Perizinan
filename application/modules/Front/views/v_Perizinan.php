<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
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
                                <h1 class="h4 text-gray-900 mb-4"><b><?= $titles; ?></b></h1>
                            </div>
                            <div id="alert-message">
                                <div class="center"><strong><?= $this->session->flashdata('message'); ?></strong>
                                </div>
                            </div>
                            <form class="user" method="POST" enctype="multipart/form-data"
                                action="<?= base_url('Front/ActionPerizinan') ?>">
                                <div class="form-group">
                                    <label for="nama">Nama Perusahaan</label>
                                    <input type="text" class="form-control" name="nama"
                                        placeholder="Masukkan Nama Perusahaan" value="<?= set_value('nama'); ?>"
                                        autofocus>
                                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat"
                                        placeholder="Masukkan Alamat Perusahaan" value="<?= set_value('alamat'); ?>"
                                        autofocus>
                                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="npwp">NPWP</label>
                                    <input type="text" class="form-control" name="npwp"
                                        placeholder="Masukkan NPWP Perusahaan" value="<?= set_value('npwp'); ?>"
                                        autofocus>
                                    <?= form_error('npwp', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="Masukkan Email Perusahaan" value="<?= set_value('email'); ?>"
                                        autofocus>
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="no_telp">Nomor Telephone</label>
                                    <input type="text" class="form-control" name="no_telp"
                                        placeholder="Masukkan Nomor Telephone Perusahaan"
                                        value="<?= set_value('no_telp'); ?>" autofocus>
                                    <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="pic">PIC</label>
                                    <input type="text" class="form-control" name="pic"
                                        placeholder="Masukkan Kontak PIC Perusahaan" value="<?= set_value('pic'); ?>"
                                        autofocus>
                                    <?= form_error('pic', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <div class="justify-content-center">
                                        <input type="submit" id="submit" name="submit" value="Submit"
                                            class="btn btn-primary btn-user btn-block">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>