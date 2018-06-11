</div> 
<!-- PAGE FOOTER -->
    <div class="page-footer">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <span class="txt-color-white"> <span class="hidden-xs"> - Pejuang Subuh</span> © <?php echo date('Y'); ?></span>
            </div>
        </div>
    </div>
    <!-- END PAGE FOOTER --> 
        <div id="shortcut">
            <ul>
                <li>
                    <a href="<?= site_url('manager/user/change_password') ?>" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-key fa-4x"></i> <span>Change Password </span> </span> </a>
                </li>
                <li>
                    <a href="<?= site_url('manager/user/profile') ?>" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>Change Profile </span> </span> </a>
                </li>
            </ul>
        </div>
        <!-- END SHORTCUT AREA -->

        <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
        <script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->


        <!-- #PLUGINS -->
        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local-->
        <script src="<?php echo base_url() ?>asset/js/jquery-1.12.4.min.js"></script>
        <script src="<?php echo base_url() ?>asset/js/jquery-ui-1.12.1.min.js"></script>

        <!-- IMPORTANT: APP CONFIG -->
        <script src="<?php echo base_url() ?>asset/js/app.config.seed.js"></script>
        <script src="<?php echo base_url() ?>asset/js/plugins/smartwidgets/jarvis.widget.min.js"></script>
        <script src="<?php echo base_url() ?>asset/js/plugins/jquery-touch/jquery.ui.touch-punch.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="<?php echo base_url() ?>asset/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>asset/js/plugins/sweetalert.min.js"></script>
        <script src="<?php echo base_url() ?>asset/js/plugins/SmartNotification.min.js"></script>

        <!-- form and validate js -->
        <script src="<?php echo base_url() ?>asset/js/plugins/jquery.form.min.js"></script>
        <script src="<?php echo base_url() ?>asset/js/plugins/jquery.validate.min.js"></script>

        <!-- daterange picker -->
        <script src="<?php echo base_url() ?>asset/js/plugins/moment.js"></script>
        <script src="<?php echo base_url() ?>asset/js/plugins/bootstrap-daterangepicker-master/daterangepicker.js"></script>

        <!-- select 2 -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>asset/js/plugins/bootstrap-daterangepicker-master/daterangepicker.css">

        <!--[if IE 8]>
            <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
        <![endif]-->

        <!-- MAIN APP JS FILE -->
        <script src="<?php echo base_url() ?>asset/js/app.js"></script>
        <script src="<?php echo base_url() ?>asset/js/global.js"></script>
        <!-- end plugin -->
        <!-- for script javascript -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
        <script>
            $(document).ready(function() {
        
                // DO NOT REMOVE : GLOBAL FUNCTIONS!
                pageSetUp();

                /*
                 * PAGE RELATED SCRIPTS
                 */
                
                $(".js-status-update a").click(function() {
                    var selText = $(this).text();
                    var $this = $(this);
                    $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
                    $this.parents('.dropdown-menu').find('li').removeClass('active');
                    $this.parent().addClass('active');
                });
            });
    </script>
    <!-- load a plugin -->
    <?php
        if(isset($script)) {
            foreach($script as $value) {
                echo '<script src="'.base_url($value).'"></script>';
            }
        }
    ?>

     <?php
        if(isset($css)) {
            foreach($css as $value) {
                echo '<link href="'.base_url($value).'" rel="stylesheet">';
            }
        }
    ?>
    </body>
</html>
