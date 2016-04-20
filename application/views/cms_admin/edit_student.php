
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Update Student</h1>
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
                Students Update Form
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
                            <input type = "text" class = "form-control" name = "f_name" placeholder = "First Name" value = "<?=$list->f_name?>"/>
                        </div>
                        <div class="col-md-4">
                            <input type = "text" class = "form-control" name = "m_name" placeholder = "Middle Name" value = "<?=$list->m_name?>"/>
                        </div>
                        <div class="col-md-4">
                            <input type = "text" class = "form-control" name = "l_name" placeholder = "Last Name" value = "<?=$list->l_name?>"/>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-right">
                        	<input type ="hidden" name = "account_id" value = "<?=$list->acid?>" />
                            <input type = "submit" class = "btn btn-primary" name = "edit-studentsubmit" value = "Update Student" />
                            <a href="<?=site_url('cms_admin/student/')?>" class = "btn btn-danger" >Cancel</a>
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