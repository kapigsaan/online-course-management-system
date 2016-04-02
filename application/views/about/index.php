 <!--breadcrumbs start-->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <h1>
              About us
            </h1>
          </div>
          <div class="col-lg-8 col-sm-8">
            <ol class="breadcrumb pull-right">
              <li>
                <a href="<?=site_url('home')?>">
                  Home
                </a>
              </li>
              <!-- <li>
                <a href="#">
                  Pages
                </a>
              </li> -->
              <li class="active">
                About
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!--breadcrumbs end-->

    <!--container start-->
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="blog-img">
              <img src="<?=site_url('assets/img/blog/img8.jpg')?>" alt=""/>
            </div>
        </div>
        <div class="col-lg-7 about wow fadeInRight">
        <?php if ($about): ?>
            <?foreach ($about as $key => $v):?>
                <h2><?=$v->caption?></h2>
                <?=html_entity_decode($v->content)?>
            <?endforeach?>
        <?php endif ?>
         <!--  <blockquote>
            <p>
              Award winning digital agency. We bring a personal and effective approach to every project we work on, which is why.
            </p>
            <small>
              CEO Jack Bour
            </small>
          </blockquote> -->
        </div>
      </div>
<!--       <div class="row">
        <div class="hiring">
          <h2 class="wow flipInX">
            we are hiring
          </h2>
          <div class="col-lg-6 col-sm-6 about-hiring">
            <div class="icon-wrap ico-bg round-five wow zoomIn" data-wow-duration="1s" data-wow-delay=".1s">
              <i class="fa fa-user">
              </i>
            </div>
            <div class="content">
              <h3 class="title wow flipInX">
                iOS / Mac OS Developer
              </h3>
              <p>
                Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.
              </p>
            </div>
          </div>
          <div class="col-lg-6 col-sm-6 about-hiring">
            <div class="icon-wrap ico-bg round-five wow zoomIn" data-wow-duration="1s" data-wow-delay=".3s">
              <i class="fa fa-user">
              </i>
            </div>
            <div class="content">
              <h3 class="title wow flipInX">
                Frontend Developer
              </h3>
              <p>
                Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.
              </p>
            </div>
          </div>

          <div class="col-lg-6 col-sm-6 about-hiring">
            <div class="icon-wrap ico-bg round-five wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
              <i class="fa fa-user">
              </i>
            </div>
            <div class="content">
              <h3 class="title wow flipInX">
                Rails Developer
              </h3>
              <p>
                Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.
              </p>
            </div>
          </div>
          <div class="col-lg-6 col-sm-6 about-hiring">
            <div class="icon-wrap ico-bg round-five wow zoomIn" data-wow-duration="1s" data-wow-delay=".7s">
              <i class="fa fa-user">
              </i>
            </div>
            <div class="content">
              <h3 class="title wow flipInX">
                PHP Developer
              </h3>
              <p>
                Suspendisse dignissim in sem eget pulvinar. Mauris aliquam nulla at libero pretium, eu tincidunt nulla molestie pulvinar posuere.
              </p>
            </div>
          </div>

        </div>
      </div>
    </div> -->

 <!--    <div class="gray-box">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="about-testimonial boxed-style about-flexslider ">
              <section class="slider wow fadeInRight">
                <div class="flexslider">
                  <ul class="slides about-flex-slides">
                    <li>
                      <div class="about-testimonial-image ">
                        <img alt="" src="img/person_1.png">
                      </div>
                      <a class="about-testimonial-author" href="#">
                        Russel Reagan
                      </a>
                      <span class="about-testimonial-company">
                        CCD Realestate
                      </span>
                      <div class="about-testimonial-content">
                        <p class="about-testimonial-quote">
                          Donec ut purus sed tortor malesuada venenatis eget eget lorem. Nullam tempor lectus a ligula lobortis pretium. Donec ut purus sed tortor malesuada venenatis eget eget lorem.
                        </p>
                      </div>
                    </li>
                    <li>
                      <div class="about-testimonial-image ">
                        <img alt="" src="img/person_2.png">
                      </div>
                      <a class="about-testimonial-author" href="#">
                        Steven gerrard
                      </a>
                      <span class="about-testimonial-company">
                        Molt BVG
                      </span>
                      <div class="about-testimonial-content">
                        <p class="about-testimonial-quote">
                          Pellentesque et pulvinar enim. Quisque at tempor ligula. Maecenas augue ante, euismod vitae egestas sit amet, accumsan eu nulla. Nullam tempor lectus a ligula lobortis pretium. Donec ut purus sed tortor malesuada venenatis eget eget lorem.
                        </p>
                      </div>
                    </li>
                  </ul>
                </div>
              </section>
            </div>
          </div>
          <div class="col-lg-7" id="skillz">
            <h3 class="skills">
              Our Crazy Skills
            </h3>

            <div class="skill_bar">
              <div class="skill_bar_progress skill_one">
                <p>
                  Web Design : 60% Complete
                </p>
              </div>
            </div>

            <div class="skill_bar">
              <div class="skill_bar_progress skill_two">
                <p>
                  Html/CSS : 90% Complete
                </p>
              </div>
            </div>

            <div class="skill_bar">
              <div class="skill_bar_progress skill_three">
                <p>
                  Wordpress : 70% Complete
                </p>
              </div>
            </div>

            <div class="skill_bar">
              <div class="skill_bar_progress skill_four">
                <p>
                  Graphic Design : 55% Complete
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->


    <div class="container" id="tourpackages-carousel">

      <div class="row">
        <div class="profile">
          <h2>
            OUR TEAM
          </h2>
          <?php if ($staff): ?>
            <?foreach ($staff as $key => $v):?>
              <div class="col-xs-12 col-sm-6 col-md-3 text-center">
                <div class="thumbnail wow fadeInUp" data-wow-delay=".1s">
                  <?php if ($v->imagefile): ?>
                    <img src="<?=image_url($v->imagefile)?>" alt="" style="height:150px;width:auto;border-radius:25px;">
                  <?php else:?>
                    <img src="<?=site_url('teknon_no_image.png')?>" alt="" style = "opacity: 0.4;height:150px;max-width:170px;border-radius:25px;">
                  <?php endif ?>
                  <div class="caption" style="height:150px;">
                    <h4 class="text-center">
                      <?=$v->caption?>
                    </h4>
                    <p style="margin-top:-10px;" class="text-center"><?=$v->foreword?></p>
                    <p>
                      <?=html_entity_decode($v->content)?>
                    </p>
                  </div>
                </div>
              </div>
            <?endforeach?>
          <?php endif ?>

        </div>
        <!-- End row -->

      </div>
      <!-- End container -->

    </div><div class="container" id="tourpackages-carousel">

      <div class="row">
        <div class="profile">
          <h2>
            OUR PARTNERS
          </h2>
          <?php if ($partners): ?>
            <?foreach ($partners as $key => $v):?>
              <div class="col-xs-12 col-sm-6 col-md-3 text-center">
                <div class="thumbnail wow fadeInUp" data-wow-delay=".1s">
                  <?php if ($v->imagefile): ?>
                    <img src="<?=image_url($v->imagefile)?>" alt="" style="height:150px; max-width:170px;border-radius:25px;">
                  <?php else:?>
                    <img src="<?=site_url('teknon_no_image.png')?>" alt="" style = "opacity: 0.4;height:150px;max-width:170px;border-radius:25px;">
                  <?php endif ?>
                  <div class="caption" style="height:150px;">
                    <h4 class="text-center">
                      <?=$v->caption?>
                    </h4>
                    <p>
                      <?=html_entity_decode($v->content)?>
                    </p>
                  </div>
                </div>
              </div>
            <?endforeach?>
          <?php endif ?>

        </div>
        <!-- End row -->

      </div>
      <!-- End container -->
    </div>


  </div>
  <!--container end-->

  <div id="content-section-1" style="padding-left:10px;padding-right:10px;">
        <div class="container-fluid">
          <div class="kode-full-size-wrapper row "  id="kode_contact_us"  style="padding-top: -30px;  background-color: #ffffff; "  >
            <div  class="simple-column"  style="margin-bottom: 30px;" >
              <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
              <div style="overflow:hidden;height:400px;width:100%;">
                <div id="gmap_canvas" style="height:400px;width:100%;"></div>
                <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                <a class="google-map-code" href="http://www.mapsembed.com/mytoys-gutschein/" id="get-map-data">mytoys gutschein - mapsembed.com</a>
              </div>
              <script type="text/javascript"> function init_map(){var myOptions = {zoom:17,center:new google.maps.LatLng(16.4263245,120.5808384),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(16.4263245,120.5808384)});infowindow = new google.maps.InfoWindow({content:"<br/>60 Purok 5<br/>Pinsao Pilot Project<br/>Baguio City" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
