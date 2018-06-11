<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - Dhy Template Blog -</title>
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>asset/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>asset/css/dhy_style.css">
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>asset/css/animate.css">
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>asset/font-awesome/css/font-awesome.min.css">
    <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->
</head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                      <a class="navbar-brand">Pejuang Subuh</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Berita <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Berita Nasional</a></li>
                                <li><a href="#">Berita Dunia</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Contact Us</a></li>
                        <div class="col-sm-3 col-md-3">
                            <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="q">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div><!-- /.container-collapse -->
        <!-- slider image-->
        <div class="container">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="<?= base_url() ?>asset/img/demo/s1.jpg" alt="First slide" style="height: 600px;">
                            <div class="carousel-caption">
                                <h3>
                                    First slide</h3>
                                <p>
                                    Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="<?= base_url() ?>asset/img/demo/s2.jpg" alt="Second slide" style="height: 600px;">
                            <div class="carousel-caption">
                                <h3>
                                    Second slide</h3>
                                <p>
                                    Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="<?= base_url() ?>asset/img/demo/s3.jpg" alt="Third slide" style="height: 600px;">
                            <div class="carousel-caption">
                                <h3>
                                    Third slide</h3>
                                <p>
                                    Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                        </div>
                    </div>
                    <!-- <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="fa fa-chevron-left"></span></a><a class="right carousel-control"
                            href="#carousel-example-generic" data-slide="next"><span class="fa fa-chevron-right">
                            </span>
                    </a> -->
                </div>
            </div>
        </div>