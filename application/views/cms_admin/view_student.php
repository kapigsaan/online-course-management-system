
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Student Profile</h1>
    </div>
    <?php if ($system_message): ?>
        <p><?=$system_message?></p>
    <?php endif ?>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <!-- /.panel -->
        <div class="panel panel-info">
            <div class="panel-heading">
                Students profile
            </div>
            <div class="panel-body">
                
            <?php if ($list): ?>
                <div class="row">
                    <div class="col-md-6">
                    	<h4>User Name: <span style = "font-weight:bold"> <?=$list->username?></span></h4>
                    </div>    
                </div>
                <p></p>
                <div class = "row">
                    <div class="col-md-4 text-center">
                    	<h4><?=$list->f_name?></h4>
                        <p>First Name</p>
                    </div>
                    <div class="col-md-4 text-center">
                    	<h4><?=$list->m_name?></h4>
                        <p>Middle Name</p>
                    </div>
                    <div class="col-md-4 text-center">
                    	<h4><?=$list->l_name?></h4>
                        <p>Last Name</p>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 text-right">
                        <a href="<?=site_url('cms_admin/student')?>" class = "btn btn-danger" >Back to List</a>
                    </div>
                </div>
            <?php endif ?>

            </div>
            <div class="panel-footer">
                
            </div>
        </div>
    </div>
</div>