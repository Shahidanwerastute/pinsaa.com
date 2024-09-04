<script src="<?php echo base_url('assets/frontend/bootstrap-5.0.2/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/bootstrap-5.0.2/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/plugins/toast-notify/jquery.toast.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="<?php echo base_url('assets/frontend/jquery/functions.js?v=' . v()); ?>"></script>

<script type="text/javascript">

    <?php if ($this->session->flashdata('success')) { ?>
    show_success('<?php echo $this->session->flashdata('success'); ?>');
    <?php } ?>

    <?php if ($this->session->flashdata('error')) { ?>
    show_error('<?php echo $this->session->flashdata('error'); ?>');
    <?php } ?>

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDt0bOxp3E183vkWlHGZsA50Hhu6wF7jN8&callback=init_map&libraries=places,geocoder&region=SA&language=<?php  echo $locale;?>"></script>

</body>
</html>