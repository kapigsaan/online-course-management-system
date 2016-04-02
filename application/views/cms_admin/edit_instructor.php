
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Update Instructor</h1>
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
        <div class="panel panel-primary">
            <div class="panel-heading">
                Instructor's Update Form
            </div>
            <div class="panel-body">
                
            <form action="" method = "post">
                <?php if ($list): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <input type = "text" class = "form-control" name = "username" placeholder = "Username" value = "<?=$list->username?>" required/>
                        </div>    
                    </div>
                    <p></p>
                    <div class = "row">
                        <div class="col-md-4">
                            <input type = "text" class = "form-control" name = "fname" placeholder = "First Name" value = "<?=$list->f_name?>"/>
                        </div>
                        <div class="col-md-4">
                            <input type = "text" class = "form-control" name = "mname" placeholder = "Middle Name" value = "<?=$list->m_name?>"/>
                        </div>
                        <div class="col-md-4">
                            <input type = "text" class = "form-control" name = "lname" placeholder = "Last Name" value = "<?=$list->l_name?>"/>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-right">
                            <input type = "submit" class = "btn btn-primary" name = "edit-instructorsubmit" value = "Update Instructor" />
                            <a href="<?=site_url('cms_admin/instructor')?>" class = "btn btn-danger" >Cancel</a>
                        </div>
                    </div>
                <?php endif ?>
            </form>

            </div>
            <div class="panel-footer">
                
            </div>
        </div>
    </div>
</div>