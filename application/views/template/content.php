<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo base_url().'assets/' ?>assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url().'assets/' ?>bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url().'assets/' ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url().'assets/' ?>plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url().'assets/' ?>assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?php echo base_url().'assets/' ?>assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<!--  BEGIN CONTENT AREA  -->

<div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <?php echo $contents ;?>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->
</div>
<!-- END MAIN CONTAINER -->