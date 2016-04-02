<div style="background-image:url(assets/wp-content/uploads/2015/04/breadceumb-bg.jpg);"  class="subheader header-style-1">
    <span class="transparent-bgdark"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="page-info">
                    <h2>News</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb">
                    <span><i class="fa fa-home"></i> You are here:</span>
                    <ul id="breadcrumbs" class="breadcrumbs">
                        <li class="item-home">
                            <a class="bread-link bread-home" href="<?php echo site_url('home')?>" title="Homepage">Homepage</a>
                        </li>
                        <li class="item-current item-84"><strong class="bread-current bread-84"> News</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- is search -->  
<div class="content-wrapper">   
    <div class="content">
    <!-- Sidebar With Content Section-->
        <div class="pagebuilder-wrapper">
            <div id="content-section-1" >
                <div class="section-container container">
                    <div class="row">
                        <div class="col-md-12 news-item-wrapper"   style="margin-bottom: 30;" >
                            <div class="news-item-holder row">
                                <div class="clear"></div>
                                <?php if ($news): ?>
                                    <?foreach ($news as $key => $v):?>
                                        <div class="col-md-4 columns">
                                            <div class="news-listing">
                                                <div class="kode-ux kode-item">
                                                    <article id="news-36" class="kode-ux kdnews-vtwo post-36 post type-post status-publish format-standard has-post-thumbnail hentry category-clean-and-clear category-cool-weather category-safe-cloud category-waste-managment tag-animal tag-best-in-world tag-new-moon">
                                                        <figure>
                                                            <!-- <span class="k_posted_by">by: admin</span> -->
                                                            <div class="kode-blog-thumbnail text-center" style="text-align:center;background:#fff">
                                                                <a href="<?=site_url($v->linkto)?>">
                                                                    <?php if ($v->imagefile): ?>
                                                                        <img src="<?php echo image_url($v->imagefile)?>" alt="" style = "height:250px;text-align:center" />
                                                                    <?php else:?>
                                                                        <img src="<?=site_url('lucene_no_image.jpg')?>" alt="" style = "height:250px;text-align:center" />
                                                                    <?php endif ?>
                                                                </a>
                                                            </div>
                                                        </figure>
                                                        <div class="newsinfo">
                                                            <div style = "height:70px;">
                                                                <h2><a href="<?=site_url($v->linkto)?>"><?=$v->caption?></a></h2>
                                                            </div>
                                                            <ul class="kdpost-option" style = "margin-top:5px;">
                                                                <li><i class="fa fa-clock-o"></i>
                                                                    <div class="datetime">Posted on <?php echo date('d F Y',strtotime($v->created_at)); ?></div>
                                                                </li>
                                                               <!--  <li>
                                                                    <div class="kode-blog-info kode-info">
                                                                        <div class="blog-info blog-category">
                                                                            <i class="fa fa-list"></i><a href="<?php echo assets_url('category/clean-and-clear/')?>" rel="tag">Clean And Clear</a>
                                                                            <span class="sep">,</span> <a href="<?php echo assets_url('category/cool-weather/')?>" rel="tag">Cool Weather</a>
                                                                            <span class="sep">,</span> <a href="<?php echo assets_url('category/safe-cloud/')?>" rel="tag">Safe Cloud</a>
                                                                            <span class="sep">,</span> <a href="<?php echo assets_url('category/waste-managment/')?>" rel="tag">Waste Managment</a>
                                                                        </div>
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </li> -->
                                                            </ul>
                                                            <div class="kode-blog-content"><p><?=substr(strip_tags(html_entity_decode($v->content)), 0, 184)?>&hellip;</p>
                                                                <a href="<?=site_url($v->linkto)?>" class="kd-readmore th-bordercolor thbg-colorhover">Read More</a>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                    <?endforeach?>
                                <?php endif ?>
                                <div class="clear"></div>
                            </div>
                            <?=$links?>
                           <!--  <div class="kode-pagination">
                                <span class='page-numbers current'>1</span>
                                <a class='page-numbers' href="<?php echo assets_url('news/page/2/')?>">2</a>
                                <a class="next page-numbers" href="<?php echo assets_url('news/page/2/')?>">Next &rsaquo;</a>
                                <a class="prev page-numbers" href="<?php echo assets_url('news/page/2/')?>">&lsaquo;Prev </a>
                            </div> -->
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>  
    </div><!-- content -->
    <div class="clear" ></div>
</div><!-- content wrapper -->