	<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <title> Admin || <?php echo isset($title) ? $title : "" ?></title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Basic Styles -->
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/bootstrap/css/bootstrap.min.css">
        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/smartadmin-production.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/smartadmin-skins.min.css">
        <!-- SmartAdmin RTL Support  -->
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/smartadmin-rtl.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/style.css">

        <link rel="shortcut icon" href="<?php echo base_url() ?>asset/images/pejuangsubuh.jpg" type="image/x-icon">
        <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/css/sweetalert2.css">
        <!-- Specifying a Webpage Icon for Web Clip
             Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
        <link rel="apple-touch-icon" href="img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>asset/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url() ?>asset/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url() ?>asset/img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?php echo base_url() ?>asset/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url() ?>asset/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url() ?>asset/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
        <?php
        if(isset($css)) {
            foreach($css as $value) {
                echo '<link href="'.base_url($value).'" rel="stylesheet">';
                }
            }
        ?>

    </head>
    <body class="smart-style-1">
        <!-- HEADER -->
        <header id="header">
            <div id="logo-group">
                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo"> <img src="<?= base_url() ?>asset/images/pejuangsubuh.jpg" alt="pejuangsubuh"> </span>
                <!-- END LOGO PLACEHOLDER -->
            </div>
            <!-- end projects dropdown -->

            <!-- pulled right: nav area -->
            <div class="pull-right">
                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->
                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                    <li class="">
                        <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
                            <img src="img/avatars/sunny.png" alt="John Doe" class="online" />  
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= site_url() ?>admin/auth" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="<?= site_url() ?>admin/auth" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->

                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->
            </div>
        <!-- end pulled right: nav area -->
    </header>
	<!-- row -->
		<div class="row">
		
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		
				<div class="row">
					<div class="col-sm-12">
						<div class="text-center error-box">
							<h1 class="error-text-2 bounceInDown animated"> Error 404 <span class="particle particle--c"></span><span class="particle particle--a"></span><span class="particle particle--b"></span></h1>
							<h2 class="font-xl"><strong><i class="fa fa-fw fa-warning fa-lg text-warning"></i> Page <u>Not</u> Found</strong></h2>
							<br />
							<p class="lead">
								The page you requested could not be found, either contact your webmaster or try again. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from
							</p>
							<p class="font-md">
								<b>... That didn't work on you? Dang. May we suggest a search, then?</b>
							</p>
							<br>
							<div class="error-search well well-lg padding-10">
								<div class="input-group">
								    <a href="<?php echo site_url('admin/dashboard')?>">Back to home</a>
								</div>
							</div>
		
						</div>
		
					</div>
		
				</div>
		
			</div>

		<!-- end row -->

	</div>