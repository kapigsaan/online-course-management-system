<?
	$config =& get_config();
	$base_url = isset($config['base_url']) ? $config['base_url'] == '' ? NULL : $config['base_url'] : NULL;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>404 Page not found</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="<?=$base_url;?>assets/admin_css/bootstrap.min.css"/>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=$base_url;?>assets/admin_css/font-awesome.min.css"/>

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=$base_url;?>assets/admin_css/ionicons.min.css"/>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?=$base_url;?>assets/admin_css/AdminLTE.min.css"/>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?=$base_url;?>assets/admin_js/html5shiv.min.js"></script>
        <script src="<?=$base_url;?>assets/admin_js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="margin-left:0px;">


        <!-- Main content -->
        <section class="content">

          <div class="error-page">
            <h2 class="headline text-red">500</h2>
            <div class="error-content">
              <p>&nbsp;</p>
              <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
              <p>
                We will work on fixing that right away.
              </p>
              <p>
                Meanwhile, you may <a href='<?=$base_url;?>'>return to homepage</a>.
              </p>
              <?if(!empty($message)):?>
              <p>
              <?=$message;?>
              </p>
              <?endif;?>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer"  style="margin-left:0px; text-align:center;">
        <strong>Copyright &copy; <?=date('Y');?> <?php echo $config['footer_title']?></strong> All rights reserved.
      </footer>
      

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=$base_url;?>assets/admin_js/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=$base_url;?>assets/admin_js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?=$base_url;?>assets/admin_js/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?=$base_url;?>assets/admin_js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?=$base_url;?>assets/admin_js/demo.js" type="text/javascript"></script>
  </body>
</html>
