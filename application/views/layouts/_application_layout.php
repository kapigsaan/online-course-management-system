<!DOCTYPE html>
<html lang="en" class="no-js" >
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<link rel="shortcut icon" href="img/favicon.png">
    <link rel="icon" href="<?php echo image_url('favicon.png'); ?>" type="image/x-icon">
<title><?php echo $prof?$prof->name:''; ?></title>
<!-- BOOTSTRAP CORE CSS -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- ION ICONS STYLES -->
<link href="assets/css/ionicons.css" rel="stylesheet" />
<!-- FONT AWESOME ICONS STYLES -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- FANCYBOX POPUP STYLES -->
<link href="assets/js/source/jquery.fancybox.css" rel="stylesheet" />
<!-- STYLES FOR VIEWPORT ANIMATION -->
<link href="assets/css/animations.min.css" rel="stylesheet" />
<!-- CUSTOM CSS -->
<link href="assets/css/style-green.css" rel="stylesheet" />
<!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body data-spy="scroll" data-target="#menu-section">
<!--MENU SECTION START-->
<div class="navbar navbar-inverse navbar-fixed-top scroll-me" id="menu-section" >
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="<?=site_url('home')?>">

              <?php if ($prof): ?>
                <?php if ($prof->name):?>
                  <?=$prof->name?>
                <?else:?>
                  Company<span>Logo</span>
                <?php endif ?>
              <?php else:?>
                Company<span>Logo</span>
              <?php endif ?>

              </a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right">
<li><a href="<?=site_url('obcms-login')?>">Login</a></li>
</ul>
</div>

</div>
</div>
<!--MENU SECTION END-->
<!--HOME SECTION START-->
<div id="home" >
<div class="container">
<div class="row">
<div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 ">
<div id="carousel-slider" data-ride="carousel" class="carousel slide  animate-in" data-anim-type="fade-in-up">

<div class="carousel-inner">
<div class="item active">

<h3>
Consectetur adipiscing elit felis dolor felis dolor vitae
</h3>
<p>
Lorem ipsumdolor sitamet, consect adipiscing elit
Lorem ipsumdolor sitamet, consect adipiscing elit.
Lorem ipsumdolor sitamet, consect adipiscing elit
Lorem ipsumdolor sitamet, consect adipiscing elit.
</p>
</div>
<div class="item">
<h3>
Lorem ipsumdolor sitamet, consect adipiscing elit
</h3>
<p>
Lorem ipsumdolor sitamet, consect adipiscing elit
Lorem ipsumdolor sitamet, consect adipiscing elit.
Lorem ipsumdolor sitamet, consect adipiscing elit
Lorem ipsumdolor sitamet, consect adipiscing elit.
</p>
</div>

</div>


</div>


</div>
</div>
<div class="row animate-in" data-anim-type="fade-in-up">
<div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 scroll-me">


<p >
This line is fixed so you can write anything

</p>
<div class="social">
<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-facebook "></i></a>
<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-twitter"></i></a>
<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-google-plus "></i></a>
<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-linkedin "></i></a>
<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-pinterest "></i></a>
<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-github "></i></a>
</div>
<a href="#services" class=" btn button-custom btn-custom-two">See Service List </a>
</div>
</div>
</div>

</div>
<!--HOME SECTION END-->

<!--GRID SECTION END-->
<!--CONTACT SECTION START-->
<section id="contact" >
<div class="container">
<div class="row text-center header animate-in" data-anim-type="fade-in-up">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<h3>Contact Details </h3>
<hr />

</div>
</div>

<div class="row animate-in" data-anim-type="fade-in-up">

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="contact-wrapper">
<h3>We Are Social</h3>
<p>
Aliquam tempus ante placerat,
consectetur tellus nec, porttitor nulla.
</p>
<div class="social-below">
<a href="#" class="btn button-custom btn-custom-two" > Facebook</a>
<a href="#" class="btn button-custom btn-custom-two" > Twitter</a>
<a href="#" class="btn button-custom btn-custom-two" > Google +</a>
</div>
</div>

</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="contact-wrapper">
<h3>Quick Contact</h3>
<h4><strong>Email : </strong> info@yuordomain.com </h4>
<h4><strong>Call : </strong> +09-88-99-77-55 </h4>
<h4><strong>Skype : </strong> Yujhaeu78 </h4>
</div>

</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
<div class="contact-wrapper">
<h3>Address : </h3>
<h4>230/45 , New way Lane , </h4>
<h4>United States</h4>
<div class="footer-div" >
&copy; 2015 YourDomain | <a href="http://www.designbootstrap.com/" target="_blank" >by DesignBootstrp</a>
</div>
</div>

</div>

</div>


</div>
</section>
<!--CONTACT SECTION END-->

<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME -->
<!-- CORE JQUERY -->
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- EASING SCROLL SCRIPTS PLUGIN -->
<script src="assets/js/vegas/jquery.vegas.min.js"></script>
<!-- VEGAS SLIDESHOW SCRIPTS -->
<script src="assets/js/jquery.easing.min.js"></script>
<!-- FANCYBOX PLUGIN -->
<script src="assets/js/source/jquery.fancybox.js"></script>
<!-- ISOTOPE SCRIPTS -->
<script src="assets/js/jquery.isotope.js"></script>
<!-- VIEWPORT ANIMATION SCRIPTS   -->
<script src="assets/js/appear.min.js"></script>
<script src="assets/js/animations.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>

</html>
