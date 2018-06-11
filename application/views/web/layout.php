 <!-- //top-header and slider -->
    <div class="container">
        <div class="banner-btm-agile">
        <!-- //btm-wthree-left -->
            <div class="col-md-9 btm-wthree-left">
                <div class="wthree-top">
                    <div class="w3agile-top">
                        <div class="w3agile_special_deals_grid_left_grid">
                            <a href="singlepage.html"><img src="<?= base_url() ?>asset/web/images/4.jpg" class="img-responsive" alt="" /></a>
                        </div>
                        <div class="w3agile-middle">
                        <ul>
                            <li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</a></li>
                            <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>201 LIKES</a></li>
                            <li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i>15 COMMENTS</a></li>
                            
                        </ul>
                    </div>
                    </div>
                    
                    <div class="w3agile-bottom">
                        <div class="col-md-3 w3agile-left">
                            <h5>Sit amet consectetur</h5>
                        </div>
                        <div class="col-md-9 w3agile-right">
                            <h3><a href="singlepage.html">Amet consectetur adipisicing </a></h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco labor nisi ut aliquip exea commodo consequat duis aute irudre dolor in elit sed uta labore dolore reprehender</p>
                            <a class="agileits w3layouts" href="singlepage.html">Read More <span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
                        </div>
                            <div class="clearfix"></div>
                    </div>
                </div>
                <!-- wthree-top-1 -->
                <div class="wthree-top-1">
                    <div class="w3agile-top">
                        <section class="slider">
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <div class="w3agile_special_deals_grid_left_grid">
                                    <a href="singlepage.html"><img src="<?= base_url() ?>asset/web/images/2.jpg" class="img-responsive" alt="" /></a>
                                </div>
                            </li>
                            <li>
                                <div class="w3agile_special_deals_grid_left_grid">
                                    <a href="singlepage.html"><img src="<?= base_url() ?>asset/web/images/3.jpg" class="img-responsive" alt="" /></a>
                                </div>
                            </li>
                            <li>
                                <div class="w3agile_special_deals_grid_left_grid">
                                    <a href="singlepage.html"><img src="<?= base_url() ?>asset/web/images/3.jpg" class="img-responsive" alt="" /></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                        <div class="w3agile-middle">
                        <ul>
                            <li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</a></li>
                            <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>201 LIKES</a></li>
                            <li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i>15 COMMENTS</a></li>
                            
                        </ul>
                    </div>
                    </div>
                    
                    <div class="w3agile-bottom">
                        <div class="col-md-3 w3agile-left">
                            <h5>Sit amet consectetur</h5>
                        </div>
                        <div class="col-md-9 w3agile-right">
                            <h3><a href="singlepage.html">Amet consectetur adipisicing </a></h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco labor nisi ut aliquip exea commodo consequat duis aute irudre dolor in elit sed uta labore dolore reprehender</p>
                            <a class="agileits w3layouts" href="singlepage.html">Read More <span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
                        </div>
                            <div class="clearfix"></div>
                    </div>
                </div>
                <!-- //wthree-top-1 -->
                <!-- wthree-top-1 -->
                <?php
                    // if(!empty($avm)) :
                        foreach($avm as $key => $value) :
                        $url = $value['url'];
                ?>
                <div class="wthree-top-1">
                    <div class="w3agile-top">
                        <iframe src="<?= $url ;?>" frameborder="0" iframe width="420" height="315"></iframe>

                        <div class="w3agile-middle">
                        <ul>
                            <li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</a></li>
                            <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>201 LIKES</a></li>
                            <li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i>15 COMMENTS</a></li>
                            
                        </ul>
                    </div>
                    </div>
                    
                    <div class="w3agile-bottom">
                        <div class="col-md-3 w3agile-left">
                            <h5>Sit amet consectetur</h5>
                        </div>
                        <div class="col-md-9 w3agile-right">
                            <h3><a href="singlepage.html">Amet consectetur adipisicing </a></h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco labor nisi ut aliquip exea commodo consequat duis aute irudre dolor in elit sed uta labore dolore reprehender</p>
                            <a class="agileits w3layouts" href="singlepage.html">Read More <span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
                        </div>
                            <div class="clearfix"></div>
                    </div>
                </div>
                <?php endforeach;?>
                
                <!-- //wthree-top-1 -->
                <div class="wthree-top-1">
                    <div class="w3agile-top">
                    <div class="col-md-6 w3-lft">
                        <div class="w3agile_special_deals_grid_left_grid">
                            <a href="singlepage.html"><img src="<?= base_url() ?>asset/web/images/5.jpg" class="img-responsive" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-md-6 w3-rgt">
                        <div class="w3-rgt-top">
                            <div class="w3agile_special_deals_grid_left_grid">
                                <a href="singlepage.html"><img src="<?= base_url() ?>asset/web/images/g6.jpg" class="img-responsive" alt="" /></a>
                            </div>
                        </div>
                        <div class="w3-rgt-top1">
                            <div class="w3agile_special_deals_grid_left_grid">
                                <a href="singlepage.html"><img src="<?= base_url() ?>asset/web/images/g8.jpg" class="img-responsive" alt="" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                        <div class="w3agile-middle">
                        <ul>
                            <li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</a></li>
                            <li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>201 LIKES</a></li>
                            <li><a href="#"><i class="fa fa-comment" aria-hidden="true"></i>15 COMMENTS</a></li>
                            
                        </ul>
                    </div>
                    </div>
                    
                    <div class="w3agile-bottom">
                        <div class="col-md-3 w3agile-left">
                            <h5>Sit amet consectetur</h5>
                        </div>
                        <div class="col-md-9 w3agile-right">
                            <h3><a href="singlepage.html">Amet consectetur adipisicing </a></h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sedc dnmo eiusmod tempor incididunt ut labore et dolore magna aliqua uta enim ad minim ven iam quis nostrud exercitation ullamco labor nisi ut aliquip exea commodo consequat duis aute irudre dolor in elit sed uta labore dolore reprehender</p>
                            <a class="agileits w3layouts" href="singlepage.html">Read More <span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
                        </div>
                            <div class="clearfix"></div>
                    </div>
                </div>
                <!-- wthree-top-1 -->
            </div>
            <!-- //btm-wthree-left -->
                <!-- btm-wthree-right -->
                <!-- load sidebar -->
                <?php $this->load->view('web/popular_post'); ?>
                <!-- end load sidebar -->
            <!-- //btm-wthree-right -->
            <div class="clearfix"></div>
        </div>
    </div>