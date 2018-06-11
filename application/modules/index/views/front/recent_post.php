<!-- <div class="w3l_categories">
    <h3>Categories</h3>
    <?php 
        foreach($kategori as $key => $value) :
            $name = $value['name'];
            $id   = $value['kategori_id'];
    ?>
    <ul>
        <li><a href="<?= site_url("index/artikel_by_kategori/$id") ?>"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span><?= $name ?></a></li>
    </ul>
    <?php endforeach;?>
</div> -->
<!-- <div class="w3ls_recent_posts"> -->
   <!--  <h3>Recent Posts</h3>
    <div class="agileits_recent_posts_grid">
        <div class="agileits_recent_posts_gridl">
            <div class="w3agile_special_deals_grid_left_grid">
                <a href="singlepage.html"><img src="images/r1.jpg" class="img-responsive" alt="" /></a>
            </div>
        </div>
        <div class="agileits_recent_posts_gridr">
            <h4><a href="singlepage.html">velit esse quam nihil</a></h4>
            <h5><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</h5>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="agileits_recent_posts_grid">
        <div class="agileits_recent_posts_gridl">
            <div class="w3agile_special_deals_grid_left_grid">
                <a href="singlepage.html"><img src="images/r2.jpg" class="img-responsive" alt="" /></a>
            </div>
        </div>
        <div class="agileits_recent_posts_gridr">
            <h4><a href="singlepage.html">Class aptent taciti </a></h4>
            <h5><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</h5>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="agileits_recent_posts_grid">
        <div class="agileits_recent_posts_gridl">
            <div class="w3agile_special_deals_grid_left_grid">
                <a href="singlepage.html"><img src="images/r3.jpg" class="img-responsive" alt="" /></a>
            </div>
        </div>
        <div class="agileits_recent_posts_gridr">
            <h4><a href="singlepage.html">Maecenas eget erat </a></h4>
            <h5><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</h5>
        </div>
        <div class="clearfix"> </div>
    </div>
</div> -->
    <div class="w3l_tags">
        <h3>Tags</h3>
        <?php 
            foreach($tag as $key => $value):
        ?>
        <ul class="tag">
            <li><a href="singlepage.html"><?= $value['tag'] ?></a></li>
        </ul>
    <?php endforeach;?>
    </div>
</div>