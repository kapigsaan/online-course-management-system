<?Php
    $CI =& get_instance();
    $CI->load->library('totals');
    $inquiry = $CI->totals->inquiry();
    $title = $CI->totals->title();
    $accounts = $CI->totals->accounts();
    $students = $CI->totals->students();
    $instructors = $CI->totals->instructors();
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
                <?=ucwords($this->session->userdata('userType'))?> | CMS
            <?php else:?>
                <?=$title->name?>
            <?php endif ?>
        <?php else:?>
            <?=ucwords($this->session->userdata('userType'))?> | CMS
        <?php endif ?>
    </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=site_url('assets/admin_css/bootstrap.min.css')?>" rel="stylesheet">

    <link href="<?=site_url('assets/admin_css/cupertino/jquery-ui.min.css')?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=site_url('assets/admin_css/plugins/metisMenu/metisMenu.min.css')?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?=site_url('assets/admin_css/plugins/timeline.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=site_url('assets/admin_css/sb-admin-2.css')?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?=site_url('assets/admin_css/plugins/dataTables.bootstrap.css')?>" rel="stylesheet">

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

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=site_url('cms_admin')?>">
                    <img src="<?=site_url('logo.jpg')?>" style = "height:50px;">
                    <?php if ($title): ?>
                        <?php if ($title->name == ""): ?>
                            <?=ucwords($this->session->userdata('userType'))?> | CMS
                        <?php else:?>
                            <?=$title->name?>
                        <?php endif ?>
                    <?php else:?>
                        <?=ucwords($this->session->userdata('userType'))?> | CMS
                    <?php endif ?>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <?=$this->session->userdata('lname').', '.$this->session->userdata('fname').' '.$this->session->userdata('mname')?>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Test 1</strong>
                                    <span class="pull-right text-muted">
                                        <em>Tadtay</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Test 2</strong>
                                    <span class="pull-right text-muted">
                                        <em>Di kalman</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=site_url('auth/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <!-- <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span> -->
                            </div>
                            <!-- /input-group -->
                        </li>
                        <?php if ($this->session->userdata('userType') == 'admin'): ?>
                            <li>
                                <a href="<?=site_url('cms_admin')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_admin/accounts')?>"><i class="fa fa-list fa-fw"></i> All Accounts &nbsp;&nbsp;<span class = "badge"><?=$accounts?></span> </a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_admin/instructor')?>"><i class="fa fa-male fa-fw"></i> Instructors &nbsp;&nbsp;<span class = "badge"><?=$instructors?></span></a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_admin/student')?>"><i class="fa fa-group fa-fw"></i> Students &nbsp;&nbsp;<span class = "badge"><?=$students?></span></a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_admin/classes')?>"><i class="fa fa-archive fa-fw"></i> View Class</a>
                            </li>
                        <?php elseif ($this->session->userdata('userType') == 'instructor'):?>
                            <li>
                                <a href="<?=site_url('cms_teacher')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_teacher/classes')?>"><i class="fa fa-group fa-fw"></i> Class</a>
                            </li>
                            <!-- <li>
                                <a href="<?=site_url('cms_teacher/forum')?>"><i class="fa fa-file-text fa-fw"></i> Forum</a>
                            </li> -->
                        <?php elseif ($this->session->userdata('userType') == 'student'): ?>
                            <li>
                                <a href="<?=site_url('cms_student')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_student/course_syllabus')?>"><i class="fa fa-align-left fa-fw"></i> Course Syllabus</a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_student/course_content')?>"><i class="fa fa-align-right fa-fw"></i> Course Content</a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_student/course_images')?>"><i class="fa fa-picture-o fa-fw"></i> Images</a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_student/course_videos')?>"><i class="fa fa-video-camera fa-fw"></i> Videos</a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_student/forums')?>"><i class="fa fa-file-text fa-fw"></i> Forums</a>
                            </li>
                            <li>
                                <a href="<?=site_url('cms_student/news')?>"><i class="fa fa-newspaper-o fa-fw"></i> News</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?=$yield;?>
        </div>

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script type='text/javascript' src="<?=site_url('assets/admin_js/jquery.min.js')?>"></script>
    <script type='text/javascript' src="<?=site_url('assets/admin_js/jquery-ui.min.js')?>"></script> 

    <!-- Bootstrap Core JavaScript -->
    <script type='text/javascript' src="<?=site_url('assets/admin_js/bootstrap.min.js')?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script type='text/javascript' src="<?=site_url('assets/admin_js/plugins/metisMenu/metisMenu.min.js')?>"></script>


    <!-- Custom Theme JavaScript -->
    <script type='text/javascript' src="<?=site_url('assets/admin_js/sb-admin-2.js')?>"></script>

        <!-- DataTables JavaScript -->
    <script type='text/javascript' src="<?=site_url('assets/admin_js/plugins/dataTables/jquery.dataTables.js')?>"></script>
    <script type='text/javascript' src="<?=site_url('assets/admin_js/plugins/dataTables/dataTables.bootstrap.js')?>"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    
    <script>
    $(document).ready(function() {
        $('.dataTables-accounts').dataTable();

        $('#show-instructor-form').click(function(){
            $('#ins').toggle('slow');
            $('#show-instructor-form').toggle('slow');
        });

        $('#canc').click(function(){
            $('#ins').toggle('slow');
            $('#show-instructor-form').toggle('slow');
        });

        $('#show-calendar-form').click(function(){
            $('#show-calendar-form').toggle('slow');
            $('#calendar-form').toggle('slow');
        });

        $('#cancel').click(function(){
            $('#show-calendar-form').toggle('slow');
            $('#calendar-form').toggle('slow');
        });

        $('.show-event').click(function(){
            $('.show-event').popover('destroy');
            var id = $(this).attr('url');
            $('#show_'+id).popover('toggle');
        });

        $('#date_start').datepicker({ dateFormat: 'mm/dd/yy' });
        $('#date_end').datepicker({ dateFormat: 'mm/dd/yy' });

    });
    </script>

</body>

</html>
