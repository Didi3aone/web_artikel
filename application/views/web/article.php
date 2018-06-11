<div class="banner-1">

</div>

<!-- technology-left -->
<div class="technology">
    <div class="container">
        <div class="col-md-9 technology-left">
            <div class="agileinfo">
            <div id="share"></div>
                <?php 
                    if(!empty($article)) :
                        // var_dump($article);die();
                        $judul    = $article['title'];
                        $isi      = $article['content'];
                        $gambar   = $article['image'];
                        $penulis  = $article['username'];
                        $tgl_post = $article['create_date'];
                        $tag      = $article['tag_name'];
                        $view     = $article['viewer'];
                ?>
                <h2 class="w3"><?= $judul ?></h2>
                <div class="single">
                    <img src="<?php echo base_url('uploads/article/'.$gambar) ?>" class="img-responsive" alt="">
                    <div class="b-bottom"> 
                        <h5 class="top"><?= $judul ?></h5>
                        <p class="sub"><?= $isi ?></p>
                        <br>
                        <p>Tags : <span class="label label-primary">#<?= $tag ?></span></p>
                        <p>Post Date: &nbsp;<?= $tgl_post ?><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span><?= $view ?></a></p>
                    </div>
                </div>

               <?php endif; ?>
               <h1> Like & share </h1>
               <div class="addthis_inline_share_toolbox"></div>
               <!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59d3cd0e181c260d"></script> 
                <div class="response">
                    <h4>Komentar</h4>
                    <div id="disqus_thread"></div>
                    <div class="clearfix"></div>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- technology-right -->
                        <!-- technology-right -->
                    </div>
                        <?php $this->load->view('web/popular_post'); ?>
                </div>
                <script id="dsq-count-scr" src="//http-localhost-news.disqus.com/count.js" async></script>
                <script>

                /**
                *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                /*
                var disqus_config = function () {
                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://http-localhost-news.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
    })();

</script>