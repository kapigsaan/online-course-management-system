<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="author" content="cosmic">
    <meta name="keywords" content="Bootstrap 3, Template, Theme, Responsive, Corporate, Business">
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="icon" href="<?php echo image_url('favicon.png'); ?>" type="image/x-icon">
    <title><?php echo $prof?$prof->name:''; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=site_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=site_url('assets/css/theme.css')?>" rel="stylesheet">
    <link href="<?=site_url('assets/css/bootstrap-reset.css')?>" rel="stylesheet">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->

    <!--external css-->
    <link href="<?=site_url('assets/assets/font-awesome/css/font-awesome.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?=site_url('assets/css/flexslider.css')?>"/>
    <link href="<?=site_url('assets/assets/bxslider/jquery.bxslider.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?=site_url('assets/css/animate.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/assets/owlcarousel/owl.carousel.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/assets/owlcarousel/owl.theme.css')?>">

    <link href="<?=site_url('assets/css/superfish.css')?>" rel="stylesheet" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> -->


    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/component.css')?>">
    <link href="<?=site_url('assets/css/style.css')?>" rel="stylesheet">
    <link href="<?=site_url('assets/css/style-responsive.css')?>" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/parallax-slider/parallax-slider.css')?>" />
    <script type="text/javascript" src="<?=site_url('assets/js/parallax-slider/modernizr.custom.28468.js')?>">
    </script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js">
    </script>
    <script src="js/respond.min.js">
    </script>
    <![endif]-->
  </head>

  <body>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <!--header start-->
    <header class="head-section">
      <div class="navbar navbar-default navbar-static-top container">
          <div class="navbar-header">
              <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?=site_url('home')?>">

              <?php if ($prof): ?>
                <?php if (!$prof->website == ""):?>
                  <img style="height:80px;margin-top:-15px;" src="<?php echo site_url($prof->website); ?>" alt="Jnz@yui.rin"/>
                <?elseif ($prof->name):?>
                  <?=$prof->name?>
                <?else:?>
                  Company<span>Logo</span>
                <?php endif ?>
              <?php else:?>
                Company<span>Logo</span>
              <?php endif ?>

              </a>
          </div>
          <?=form_open('search')?>
          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <?php if($topnavs): ?>
                    <?php $ctr = 0; foreach($topnavs as $topnav): ?>
                        <li class = "<?php echo $current==$topnav->linkto ? 'current-menu-item' : 'first' ;?>">
                          <a href="<?=site_url($topnav->linkto)?>">
                            <?=ucwords($topnav->caption);?>
                          </a>
                      </li>
                    <?php $ctr++; endforeach;?>
                <?php endif;?>
                <li><input class="form-control search" placeholder=" Search" type="text" name="s"></li>
              </ul>
          </div>
          <?=form_close('')?>
      </div>
    </header>
    <!--header end-->

    <!-- Sequence Modern Slider -->
    

    <?=$yield;?>


    <!--container end-->

    <!--footer start-->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-sm-3 address wow fadeInUp" data-wow-duration="2s" data-wow-delay=".1s">
            <h1>
              Contact info
            </h1>
            <address>
                <?php if ($prof): ?>
                    <p><i class="fa fa-home pr-10"></i>Address: <?=$prof->address;?></p>
                    <p><i class="fa fa-phone pr-10"></i>Tel # : <?=$prof->tel;?> </p>
                    <?php if ($settings): ?>
                        <p><i class="fa fa-envelope pr-10"></i>Email :   <a href="javascript:;"><?=$settings->official_email;?></a></p>
                    <?php else:?>
                        <p><i class="fa fa-envelope pr-10"></i>Email :   <a href="javascript:;"></a></p>
                    <?php endif;?>
                    <p><i class="fa fa-phone pr-10"></i>Globe : <?=$prof->globe;?></p>
                    <p><i class="fa fa-phone pr-10"></i>Smart : <?=$prof->smart;?></p>
                <?php else:?>
                    <p><i class="fa fa-home pr-10"></i>Address: </p>
                    <p><i class="fa fa-phone pr-10"></i>Tel # : </p>
                    <p><i class="fa fa-envelope pr-10"></i>Email :   <a href="javascript:;"></a></p>
                    <p><i class="fa fa-phone pr-10"></i>Globe : </p>
                    <p><i class="fa fa-phone pr-10"></i>Smart : </p>
                <?php endif;?>
            </address>
          </div>
          <!-- <div class="col-lg-3 col-sm-3 wow fadeInUp" data-wow-duration="2s" data-wow-delay=".3s"> -->
           <!--  <h1>latest tweet</h1>
              <div class="tweet-box">
                <i class="fa fa-twitter"></i>
                <em>
                  Please follow
                  <a href="javascript:;">@example</a>
                  for all future updates of us!
                  <a href="javascript:;">twitter.com/acme</a>
                </em>
              </div>
              <div class="tweet-box">
                <i class="fa fa-twitter"></i>
                <em>
                  Please follow
                  <a href="javascript:;">@example</a>
                  for all future updates of us!
                  <a href="javascript:;">twitter.com/acme</a>
                </em>
              </div>
              <div class="tweet-box">
                <i class="fa fa-twitter"></i>
                <em>
                  Please follow
                  <a href="javascript:;">@example</a>
                  for all future updates of us!
                  <a href="javascript:;">twitter.com/acme</a>
                </em> 
              </div>-->
          <!-- </div> -->
          <div class="col-lg-5 col-sm-5">
            <div class="text-footer wow fadeInUp" data-wow-duration="2s" data-wow-delay=".7s">
            <?php if ($footer): ?>
              <?foreach ($footer as $key => $v):?>
                <h1>
                  <?=$v->caption?>
                </h1>
                <p>
                  <?=html_entity_decode($v->content)?>
                </p>
              <?endforeach?>
            <?php endif ?>
            </div>
          </div>
          <div class="col-lg-4 col-sm-4">
            <div class="page-footer wow fadeInUp" data-wow-duration="2s" data-wow-delay=".5s">
              <h1>
                Site maps
              </h1>

              <ul class="page-footer-list">
                <?php if($topnavs): ?>
                    <?php $ctr = 0; foreach($topnavs as $topnav): ?>
                        <li>
                          <i class="fa fa-angle-right">
                            <a href="<?=site_url($topnav->linkto)?>">
                              <?=ucwords($topnav->caption);?>
                            </a>
                          </i>
                        </li>
                    <?php $ctr++; endforeach;?>
                <?php endif;?>
              </ul>
            </div>
          </div>
          
        </div>
      </div>
    </footer>
    <!-- footer end -->
    <!--small footer start -->
    <footer class="footer-small">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 pull-right">
                    <ul class="social-link-footer list-unstyled">
                        <?php if ($settings): ?>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".1s"><a href="<?=site_url($settings->fb_url)?>"><i class="fa fa-facebook"></i></a></li>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".2s"><a href="<?=site_url($settings->gplus_url)?>"><i class="fa fa-google-plus"></i></a></li>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".5s"><a href="<?=site_url($settings->tw_url)?>"><i class="fa fa-twitter"></i></a></li>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".6s"><a href="<?=site_url($settings->enroll_url)?>"><i class="fa fa-skype"></i></a></li>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".8s"><a href="<?=site_url($settings->student_url)?>"><i class="fa fa-youtube"></i></a></li>
                        <?php else:?>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".1s"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".2s"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".5s"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".6s"><a href="#"><i class="fa fa-skype"></i></a></li>
                            <li class="wow flipInX" data-wow-duration="2s" data-wow-delay=".8s"><a href="#"><i class="fa fa-youtube"></i></a></li>
                        <?php endif ?>
                    </ul>
                </div>
                <div class="col-md-4">
                  <div class="copyright">
                    <p>&copy; Copyright - 2015 Jnz - Yui@rin.</p>
                  </div>
                </div>
            </div>
        </div>
    </footer>
    <!--small footer end-->

    <!-- js placed at the end of the document so the pages load faster
<script src="js/jquery.js">
</script>
-->
    <script src="<?=site_url('assets/js/jquery-1.8.3.min.js')?>">
    </script>
    <script src="<?=site_url('assets/js/bootstrap.min.js')?>">
    </script>
    <script type="text/javascript" src="<?=site_url('assets/js/hover-dropdown.js')?>">
    </script>
    <script defer src="<?=site_url('assets/js/jquery.flexslider.js')?>">
    </script>
    <script type="text/javascript" src="<?=site_url('assets/assets/bxslider/jquery.bxslider.js')?>">
    </script>

    <script type="text/javascript" src="<?=site_url('assets/js/jquery.parallax-1.1.3.js')?>">
    </script>
    <script src="<?=site_url('assets/js/wow.min.js')?>">
    </script>
    <script src="<?=site_url('assets/assets/owlcarousel/owl.carousel.js')?>">
    </script>

    <script src="<?=site_url('assets/js/jquery.easing.min.js')?>">
    </script>
    <script src="<?=site_url('assets/js/link-hover.js')?>">
    </script>
    <script src="<?=site_url('assets/js/superfish.js')?>">
    </script>
    <script type="text/javascript" src="<?=site_url('assets/js/parallax-slider/jquery.cslider.js')?>">
    </script>
    <script type="text/javascript">
      $(function() {

        $('#da-slider').cslider({
          autoplay    : true,
          bgincrement : 100
        });

      });
    </script>



    <!--common script for all pages-->
    <script src="<?=site_url('assets/js/common-scripts.js')?>">
    </script>

    <script type="text/javascript">
      jQuery(document).ready(function() {


        $('.bxslider1').bxSlider({
          minSlides: 5,
          maxSlides: 6,
          slideWidth: 360,
          slideMargin: 2,
          moveSlides: 1,
          responsive: true,
          nextSelector: '#slider-next',
          prevSelector: '#slider-prev',
          nextText: 'Onward →',
          prevText: '← Go back'
        });

      });


    </script>


    <script>
      $('a.info').tooltip();

      $(window).load(function() {
        $('.flexslider').flexslider({
          animation: "slide",
          start: function(slider) {
            $('body').removeClass('loading');
          }
        });
      });

      $(document).ready(function() {

        $("#owl-demo").owlCarousel({

          items : 4

        });

      });

      jQuery(document).ready(function(){
        jQuery('ul.superfish').superfish();
      });

      new WOW().init();


    </script>
  </body>
</html>