<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fashion Blog a Blogging Category Bootstrap Responsive Website Template | Home :: w3layouts</title>    
    <link href="<?php echo base_url() ?>asset/web/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" /><!-- fontawesome -->     
    <link href="<?php echo base_url() ?>asset/web/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" /><!-- Bootstrap stylesheet -->
    <link href="<?php echo base_url() ?>asset/web/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/web/css/flexslider.css" type="text/css" media="screen" property="" />
    <!-- stylesheet -->
    <!-- meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Blog Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //meta tags -->
    <!--fonts-->
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!--//fonts-->
    <script type="text/javascript" src="<?php echo base_url() ?>asset/web/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url() ?>asset/web/js/main.js"></script>
    <!-- Required-js -->
    <!-- main slider-banner -->
    <script src="<?php echo base_url() ?>asset/web/js/skdslider.min.js"></script>
    <link href="<?php echo base_url() ?>asset/web/css/skdslider.css" rel="stylesheet">
    <!-- //main slider-banner --> 
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="<?php echo base_url() ?>asset/web/js/move-top.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>asset/web/js/easing.js"></script>
    <!-- start-smoth-scrolling -->
</head>
<body>
    <!-- header -->
    <header>
        <div class="w3layouts-top-strip">
            <div class="container">
                <div class="logo">
                    <h1><a href="index.html">Fashion Blog</a></h1>
                    <p>lets make a Life style</p>
                </div>
                <div class="w3ls-social-icons">
                    <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                    <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                    <a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a>
                    <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                    <a class="linkedin" href="#"><i class="fa fa-google-plus"></i></a>
                    <a class="linkedin" href="#"><i class="fa fa-rss"></i></a>
                    <a class="linkedin" href="#"><i class="fa fa-behance"></i></a>
                </div>
            </div>
        </div>
        <!-- navigation -->
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a class="active" href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Berita <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="icons.html">Nasional</a></li>
                                <li><a href="typo.html">Internasional</a></li>

                            </ul>
                        </li>
                        <li><a href="">Kajian</a></li>
                        <li><a href="">Pejuan Subuh Store</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
                <div class="w3_agile_login">
                    <div class="cd-main-header">
                        <a class="cd-search-trigger" href="#cd-search"> <span></span></a>
                        <!-- cd-header-buttons -->
                    </div>
                    <div id="cd-search" class="cd-search">
                        <form action="#" method="post">
                            <input name="Search" type="search" placeholder="Search...">
                        </form>
                    </div>
                </div>
                <div class="clearfix"> </div>

            </div><!-- /.container-fluid -->
        </nav>

        <!-- //navigation -->
    </header>
    <!-- //header -->
    <!-- top-header and slider -->
    <div class="w3-slider"> 
        <!-- main-slider -->
        <ul id="demo1">
            <?php 
                $i = 1;
                // if(!empty($slider)):
                    foreach($slider as $key => $value) :
                        $title = $value['title'];
                        $image = $value['image_url'];
                        $desc  = $value['description'];
                    $i++;
            ?>
            <li>
                <img src="<?= base_url($image); ?>" alt="" />
                <!--Slider Description example-->
                <div class="slide-desc">
                    <h3><?= $title ?></h3>
                    <p><?= $desc ?> </p>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- //main-slider -->

