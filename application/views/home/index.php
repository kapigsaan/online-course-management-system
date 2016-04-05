<?php if ($backblog): ?>
  <div id="da-slider" class="da-slider" style="background: transparent url(assets/images/<?=$backblog->imagefile?>) repeat 0% 0%;">
<?else:?>
  <div id="da-slider" class="da-slider" style="background: transparent url(assets/images/main-bg.jpg) repeat 0% 0%;">
<?php endif ?>
    <?php if ($banners): ?>
        <?foreach ($banners as $key => $v):?>
            <div class="da-slide">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i><?=$v->caption?></i>
                            </h2>
                            <p>
                                <i><?=html_entity_decode($v->content)?></i>
                            </p>
                            <a href="#" class="btn btn-info btn-lg da-link">
                                Read more
                            </a>
                            <div class="da-img">
                                <img src="<?=image_url($v->file)?>" style = "height:400px;" alt="image01" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?endforeach?>    
    <?php endif ?>

      <nav class="da-arrows">
        <span class="da-arrows-prev">
        </span>
        <span class="da-arrows-next">
        </span>
      </nav>
    </div>


    <div class="container">
      <div class="row mar-b-50">
        <div class="col-md-12">
          <div class="text-center feature-head wow fadeInDown">
            <h1 class="">
              Welcome To Teknon Host IT Solutions
            </h1>

          </div>


          <div class="feature-box text-center">
            <?php if ($features): ?>
                <?foreach ($features as $key => $v):?>
                    <div class="
                        <?php if ($counter): ?>
                            <?php if ($counter == 4): ?>
                              col-md-3 col-sm-3
                            <?elseif($counter == 3):?>
                              col-md-4 col-sm-4
                            <?elseif($counter == 2):?>
                              col-md-6 col-sm-6
                            <?elseif($counter == 1):?>
                              col-md-12 col-sm-12
                            <?php endif ?>
                        <?php endif ?> 
                        text-center wow fadeInUp">
                        <div class="feature-box-heading">
                            <em>
                            <?php if ($v->imagefile): ?>
                              <img src="<?=image_url($v->imagefile)?>" alt="" height="100" style = "border-radius:25px;">
                            <?php else:?>
                              <img src="<?=site_url('teknon_no_image.png')?>" alt="" height="100" style = "opacity: 0.4;">
                            <?php endif ?>
                            </em>
                            <h4>
                                <b><?=$v->caption?></b>
                            </h4>
                        </div>
                        <p class="text-center">
                            <?= html_entity_decode($v->content)?>
                        </p>
                    </div>
                <?endforeach?>
            <?php endif ?>
          </div>

          <!--feature end-->
        </div>
      </div>
    </div>


      <!--recent work start-->
    <div class="bg-lg">
     <!--  <div class="container">
        <div class="row">
          <div class="col-lg-12 recent">
            <h3 class="recent-work">
              Recent Work
            </h3>
            <p>Some of our work we have done earlier</p>
            <div id="owl-demo" class="owl-carousel owl-theme wow fadeIn">
              <?php if ($activities): ?>
                <?foreach ($activities as $key => $v):?>
                  <div class="item view view-tenth">
                    <img src="<?=image_url($v->imagefile)?>" alt="work Image">
                    <div class="mask">
                      <a href="<?=$v->linkto?>" class="info" data-toggle="tooltip" data-placement="top" title="">
                        <?=$v->caption?>
                      </a>
                    </div>
                  </div>
                <?endforeach?>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div> -->
      <!--recent work end-->
    </div>


<!-- 
    <div id="home-services">

      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>
              In case you need any help
            </h2>
          </div>

          <div class="col-md-4">
            <div class="h-service">
              <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                <i class="fa fa-question">
                </i>
              </div>
              <div class="h-service-content wow fadeInUp">
                <h3>
                  PRESALE QUESTION
                </h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim  laborum.
                  <br>
                  <a href="#">
                    Learn more
                  </a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="h-service">
              <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                <i class="fa fa-h-square">
                </i>
              </div>
              <div class="h-service-content wow fadeInUp">
                <h3>
                  NEED SUPPORT?
                </h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim  laborum.
                  <br>
                  <a href="#">
                    Learn more
                  </a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="h-service">
              <div class="icon-wrap ico-bg round-fifty wow fadeInDown">
                <i class="fa fa-users">
                </i>
              </div>
              <div class="h-service-content wow fadeInUp">
                <h3>
                  CHECK FORUM
                </h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim  laborum.
                  <br>
                  <a href="#">
                    Learn more
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
        

      </div> -->
      <!-- /container -->

    </div>
    <!-- service end -->
    <div class="hr">
      <span class="hr-inner"></span>
    </div>
