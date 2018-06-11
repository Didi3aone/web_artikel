        </div>
    </div>

    <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<!--     <script src="<?php echo base_url() ?>/asset/js/plugin/pace/pace.min.js"></script> -->

    <script> if (!window.jQuery) { document.write('<script src="<?php echo base_url() ?>/asset/js/jquery-1.12.4.min.js"><\/script>');} </script>
    <script> if (!window.jQuery.ui) { document.write('<script src="<?php echo base_url() ?>/asset/js/jquery-ui-1.12.1.min.js"><\/script>');} </script>
    <!-- IMPORTANT: APP CONFIG -->
    <script src="<?php echo base_url() ?>asset/js/app.config.js"></script>

    <!-- BOOTSTRAP JS -->       
    <script src="<?php echo base_url() ?>asset/bootstrap/js/bootstrap.min.js"></script>
    <!-- JQUERY VALIDATE -->
    <script src="<?php echo base_url() ?>asset/js/plugins/jquery.form.min.js"></script>
    <script src="<?php echo base_url() ?>asset/js/plugins/jquery.validate.min.js"></script>
    <script type="text/javascript">
        runAllForms();
    </script>
     <?php
        if(isset($js)) {
            foreach($js as $value) {
                echo '<script src="'.base_url($value).'"></script>';
            }
        }
    ?>
    </body>
</html>