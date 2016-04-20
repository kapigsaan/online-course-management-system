<?Php
    $CI =& get_instance();
    $CI->load->library('totals');
    $title = $CI->totals->title();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?=site_url('favicon.png')?>">
    <link rel="icon" href="<?=site_url('favicon.png')?>" type="image/x-icon">

    <title>
        <?php if ($title): ?>
            <?php if ($title->name == ""): ?>
                Admin Login | CMS
            <?php else:?>
                <?=$title->name?>
            <?php endif ?>
        <?php else:?>
            Admin Login | CMS
        <?php endif ?>
    </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=site_url('assets/admin_css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=site_url('assets/admin_css/plugins/metisMenu/metisMenu.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=site_url('assets/admin_css/sb-admin-2.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=site_url('assets/fonts/css/font-awesome.min.css')?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading text-center" >
                    <?php if ($prof): ?>
                        <?php if (!$prof->website == ""):?>
                          <img src="<?php echo site_url($prof->website); ?>" alt="Jnz@yui.rin"/>
                        <?else:?>
                           <img src="<?=site_url('logo.jpg')?>">
                        <?php endif ?>
                    <?php else:?>
                         <img src="<?=site_url('logo.jpg')?>">
                    <?php endif ?>
                       
                    </div>
                    <div class="panel-body">
                        <?php echo $yield;?>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?=site_url('assets/jquery-1.11.0.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=site_url('assets/bootstrap.min.js')?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=site_url('assets/plugins/metisMenu/metisMenu.min.js')?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=site_url('assets/sb-admin-2.js')?>"></script>
    <script type="text/javascript">
        $("a.refresh").click(function() {
    var url = $(this).attr('url');
                    jQuery.ajax({
                        type: "POST",
                        url: url,
                        success: function(res) {
                            if (res)
                            { 
        $("div.c_image .the_im").empty();
        $("div.c_image .the_im").append(res);
                                  
                            }  
                        }
                    });
                });
            });
    </script>
</body>

</html>
