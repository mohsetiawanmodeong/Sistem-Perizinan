<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

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