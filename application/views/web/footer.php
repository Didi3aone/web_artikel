    <!-- footer -->
    <div class="footer-agile-info">
        <div class="container">
            <div class="col-md-4 w3layouts-footer">
                <h3>Contact Information</h3>
                    <p><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>Jakarta </p>
                    <p><span><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="#">E: pejuangsubuh170317[at]gmail.com</a> </p>
                    <p><span><i class="fa fa-mobile" aria-hidden="true"></i></span>P: +254 2564584 / +542 8245658 </p>
                    <!-- <p><span><i class="fa fa-globe" aria-hidden="true"></i></span><a href="#">W: www.w3layouts.com</a></p> -->
            </div>
            <div class="col-md-4 wthree-footer">
                <h2>Qoute Today</h2>
                <p> Kalau tidak digunakan untuk agama untuk apa lagi sisa umur yang tersisa.</p>
            </div>
            <div class="col-md-4 w3-agile">
                <h3>Newsletter</h3>
                <p>Mau terus update berita atau kajian islam dari kami silahkan masukan alamat email anda.</p>
                <form action="#" method="post">
                    <input type="email" name="Email" placeholder="Email" required="">
                    <input type="submit" value="Send">
                </form>
            </div>
        </div>
    </div>
    <!-- footer -->
    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="w3agile-list">
                <ul>
                  <!--   <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="lifestyle.html">Life Style</a></li>
                    <li><a href="photography.html">Photography</a></li>
                    <li><a href="fashion.html">Fashion</a></li>
                    <li><a href="icons.html">Codes</a></li>
                    <li><a href="features.html">Features</a></li>
                    <li><a href="contact.html">Contact</a></li> -->
                </ul>
            </div>
            <div class="agileinfo">
                <p>© <?= date('Y'); ?> . All Rights Reserved </p>
            </div>
        </div>
    </div>
<!-- //copyright -->
<!-- here stars scrolling icon -->
    <script defer src="<?php echo base_url() ?>asset/web/js/jquery.flexslider.js"></script>
    <script src="<?php echo base_url() ?>asset/web/js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            /*
                var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
                };
            */
                                
            $().UItoTop({ easingType: 'easeOutQuart' });
                                
            });
            $(window).load(function(){
              $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider){
                  $('body').removeClass('loading');
                }
              });
            });

            $(document).ready(function(){
                $(".dropdown").hover(            
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                        $(this).toggleClass('open');        
                    },
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                        $(this).toggleClass('open');       
                    }
                );
            });

            jQuery(document).ready(function($) {
                $(".scroll").click(function(event){     
                    event.preventDefault();
                    $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                });
            });

            jQuery(document).ready(function(){
                jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
                            
                jQuery('#responsive').change(function(){
                  $('#responsive_wrapper').width(jQuery(this).val());
                });
                
            });

    </script>
</body>
</html>