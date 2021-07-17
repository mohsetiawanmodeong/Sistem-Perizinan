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
                            <div class="x_title">
                                <h2><i class="fa fa-newspaper"></i>&nbsp; Pengajuan </h2>
                            </div>
                            <hr>
                            <?= form_open_multipart('From/AddPengajuan'); ?>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="perizinan">Jenis Perizinan</label>
                                    <input type="text" class="form-control"
                                        value="<?= $Perizinan[0]['nama_perizinan'];?>" readonly>
                                    <input type="hidden" class="form-control" id="perizinan" name="perizinan"
                                        value="<?= $id;?>">
                                </div>

                                <div class="form-group">
                                    <label for="perizinan">Upload Dokumen</label>
                                    <input type="file" class="form-control" id="document" name="document" required>
                                </div>
                                <font style="color:red"> Note : Berkas Di Jadikan PDF</font>
                            </div>
                            <br>
                            <div class="ln_solid">
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <button type="submit" class="btn btn-success"> Save</button>
                                    <button type="reset" class="btn btn-primary"> Cancel</button>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>