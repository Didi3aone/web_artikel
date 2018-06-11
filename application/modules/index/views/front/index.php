  <!-- end slider image -->
        <?= $this->load->view(VIEW_INFO_KAJIAN) ?>
        <!-- menu article -->
         <h1 style="padding: 10px;margin-left: 45px;"> <i class="fa fa-fire"></i> Article Realese</h1>
        <section id="blog-section" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <?php 
                                foreach($artikel as  $value) :
                                    $judul   = $value['artikel_judul'];
                                    $seo_url = $value['artikel_pretty_url'];
                                    $isi     = $value['artikel_isi'];
                                    $foto    = $value['artikel_photo'];
                                    $date    = $value['artikel_created_date'];
                                    $created = $value['create_by'];
                                ?>
                            <div class="col-lg-4 col-md-6">
                                <aside>
                                    <img src="<?= base_url($foto) ?>" class="img-responsive">
                                    <div class="content-title">
                                        <div class="text-center">
                                            <h3><a href="<?= $seo_url ?>"><?= limit_words($isi, 20) ?></a></h3>
                                        </div>
                                    </div>
                                    <div class="content-footer">
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Comments"><i class="fa fa-comments" ></i> 30</a>
                                        <a href="#" data-toggle="tooltip" data-placement="right" title="Loved"><i class="fa fa-heart"></i> 20</a>     </span>
                                    </div>
                                </aside>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <!-- quote -->
                        <hr class="hr-danger" />
                         <blockquote>
                              <h1 class="gradient-text">If you want to go quickly, go alone. If you want to go far, go together.</h1>
                              <p><cite>– Probably Not Really An African Proverb</cite></p>
                        </blockquote>
                        <hr class="hr-danger" />
                        <!-- end quote -->
                        <div class="col-lg-4 col-md-6">
                            <aside>
                                <img src="<?= base_url() ?>asset/img/avatars/male.png" class="img-responsive">
                                <div class="content-title">
                                    <div class="text-center">
                                        <h3><a href="#">Singkat Cerita</a></h3>
                                    </div>
                                </div>
                                <div class="content-footer">
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Comments"><i class="fa fa-comments" ></i> 30</a>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="Loved"><i class="fa fa-heart"></i> 20</a>     </span>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <aside>
                                <img src="<?= base_url() ?>asset/img/avatars/male.png" class="img-responsive">
                                <div class="content-title">
                                    <div class="text-center">
                                        <h3><a href="#">Singkat Cerita</a></h3>
                                    </div>
                                </div>
                                <div class="content-footer">
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Comments"><i class="fa fa-comments" ></i> 30</a>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="Loved"><i class="fa fa-heart"></i> 20</a>     </span>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <aside>
                                <img src="<?= base_url() ?>asset/img/avatars/male.png" class="img-responsive">
                                <div class="content-title">
                                    <div class="text-center">
                                        <h3><a href="#">Singkat Cerita</a></h3>
                                    </div>
                                </div>
                                <div class="content-footer">
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Comments"><i class="fa fa-comments" ></i> 30</a>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="Loved"><i class="fa fa-heart"></i> 20</a>     </span>
                                </div>
                            </aside>
                        </div>
                        <!-- artikel bawah -->
                        <!-- <div style="height: 100%;"></div> -->
                        <div class="row">
                            <div class="section section_open transition">
                                <div class="section-header">
                                <!-- <div class="section-icon"><img src="img/foodndrink.jpeg"></div> -->
                                    <div class="section-title">
                                        <a href="/article/category/eat-and-drink">
                                            <div class="post-permalink pull-right section-lihat-semua">
                                                <!-- <span>Lihat semua</span> -->
                                                <!-- <i class="fa fa-play" aria-hidden="true"></i> -->
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="article_list row">
                                        <a href="/article/asdadsadak" class="article_item col-sm-4 col-xs-6 col-xxs-12">
                                            <div class="article_thumb">
                                                <img src="<?= base_url() ?>asset/img/avatars/male.png" />
                                            </div>
                                            <div class="article_infobutton transition">Baca Artikel &#9658;</div>
                                            <div class="article_info">
                                                <div class="article_sub">FOODIES</div><br />
                                                <div class="article_title"><h4>asdadsada</h4></div>
                                            </div>
                                        </a>
                                        <a href="/article/asdadsadak" class="article_item col-sm-4 col-xs-6 col-xxs-12">
                                            <div class="article_thumb">
                                                <img src="<?= base_url() ?>asset/img/avatars/male.png" />
                                            </div>
                                            <div class="article_infobutton transition">Baca Artikel &#9658;</div>
                                            <div class="article_info">
                                                <div class="article_sub">FOODIES</div><br />
                                                <div class="article_title"><h4>asdadsada</h4></div>
                                            </div>
                                        </a>
                                        <a href="/article/asdadsadak" class="article_item col-sm-4 col-xs-6 col-xxs-12">
                                            <div class="article_thumb">
                                                <img src="<?= base_url() ?>asset/img/avatars/male.png" />
                                            </div>
                                            <div class="article_infobutton transition">Baca Artikel &#9658;</div>
                                            <div class="article_info">
                                                <div class="article_sub">FOODIES</div><br />
                                                <div class="article_title"><h4>asdadsada</h4></div>
                                            </div>
                                        </a>
                                        <a href="/article/asdadsadak" class="article_item col-sm-4 col-xs-6 col-xxs-12">
                                            <div class="article_thumb">
                                                <img src="<?= base_url() ?>asset/img/avatars/male.png" />
                                            </div>
                                            <div class="article_infobutton transition">Baca Artikel &#9658;</div>
                                            <div class="article_info">
                                                <div class="article_sub">FOODIES</div><br />
                                                <div class="article_title"><h4>asdadsada</h4></div>
                                            </div>
                                        </a>
                                        <a href="/article/asdadsadak" class="article_item col-sm-4 col-xs-6 col-xxs-12">
                                            <div class="article_thumb">
                                                <img src="<?= base_url() ?>asset/img/avatars/male.png" />
                                            </div>
                                            <div class="article_infobutton transition">Baca Artikel &#9658;</div>
                                            <div class="article_info">
                                                <div class="article_sub">FOODIES</div><br />
                                                <div class="article_title"><h4>asdadsada</h4></div>
                                            </div>
                                        </a>
                                        <a href="/article/asdadsadak" class="article_item col-sm-4 col-xs-6 col-xxs-12">
                                            <div class="article_thumb">
                                                <img src="<?= base_url() ?>asset/img/avatars/male.png" />
                                            </div>
                                            <div class="article_infobutton transition">Baca Artikel &#9658;</div>
                                            <div class="article_info">
                                                <div class="article_sub">FOODIES</div><br />
                                                <div class="article_title"><h4>asdadsada</h4></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  // RECENT POST===========-->
                    <div class="col-lg-4">           
                        <div class="widget-sidebar">
                            <h2 class="title-widget-sidebar">// RECENT POST</h2>
                            <div class="content-widget-sidebar">
                                <ul>
                                    <li class="recent-post">
                                        <div class="post-img">
                                            <img src="<?= base_url() ?>asset/img/avatars/male.png" class="img-responsive">
                                        </div>
                                        <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                        <p><small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014</small></p>
                                    </li>
                                    <hr>
                                    <li class="recent-post">
                                        <div class="post-img">
                                            <img src="<?= base_url() ?>asset/img/avatars/male.png" class="img-responsive">
                                        </div>
                                        <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                        <p><small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014</small></p>
                                    </li>
                                    <hr>
                                    <li class="recent-post">
                                        <div class="post-img">
                                            <img src="<?= base_url() ?>asset/img/avatars/male.png" class="img-responsive">
                                        </div>
                                        <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                        <p><small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014</small></p>
                                    </li>
                                    <hr>
                                    <li class="recent-post">
                                        <div class="post-img">
                                            <img src="<?= base_url() ?>asset/img/avatars/male.png" class="img-responsive">
                                        </div>
                                        <a href="#"><h5>Excepteur sint occaecat cupi non proident laborum.</h5></a>
                                        <p><small><i class="fa fa-calendar" data-original-title="" title=""></i> 30 Juni 2014</small></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!--===================== CATEGORIES ======================-->
                       <div class="widget-sidebar">
                            <h2 class="title-widget-sidebar">// CATEGORIES</h2>
                            <button class="categories-btn">Audio</button>
                            <button class="categories-btn">Blog</button>
                            <button class="categories-btn">Gallery</button>
                            <button class="categories-btn">Images</button>
                       </div>  

                        <!--=====================NEWSLATTER======================-->
                        <div class="widget-sidebar-sub">
                            <h2 class="title-widget-sidebar">Subscribe</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut .</p>  
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                            </div>
                            <button type="button" class="btn btn-email">Subscribe</button>
                        </div>  
                    </div>
                </div>
            </div>
        </section>

        <!-- end menu atas -->
        <!-- Gallery Video -->
       <!--  <h1 style="padding: 10px;margin-left: 45px;"> <i class="fa fa-fire"></i> Gallery And  Video</h1>
        <section class="gallery">
            
        </section> -->