<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
            document.write(new Date().getFullYear());
            </script> All rights reserved | <i class="icon-user color-danger" aria-hidden="true">
                <b><?= $setting[0]['nama_aplikasi'] ;?></b></i>
            <br>Facebook : <a href="<?= $setting[0]['facebook'] ;?>"><?= $setting[0]['facebook'] ;?></a>
            <br>Made
            by Colorlib
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

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
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#alert-message").alert().delay(3000).slideUp('slow');
</script>

<!-- jQuery -->
<script src="<?= base_url('frontend');?>/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('frontend'); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('frontend'); ?>/plugins/summernote-master/summernote.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('frontend'); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('frontend'); ?>/assets/js/sb-admin-2.min.js"></script>

<script src="<?= base_url('frontend');?>/plugins/moment/min/moment.min.js"></script>

<!-- Datatable js -->
<script src="<?= base_url('frontend');?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('frontend');?>/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('frontend');?>/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url('frontend');?>/plugins/datatables/responsive.bootstrap4.min.js"></script>
</body>
<!-- Include Modjs -->
<script src="
			<?php
                    if ($this->uri->segment('2')==''||$this->uri->segment('2')==null) {
                        echo base_url('modjs/'.$this->uri->segment('1').'.js');
                    } else {
                        echo base_url('modjs/'.$this->uri->segment('1').'/'.$this->uri->segment('2').'.js');
                    };
        ;?>">
</script>

</html>