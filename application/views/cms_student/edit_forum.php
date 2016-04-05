
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Update Forums</h1>
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
                Forums Update Form
            </div>
            <div class="panel-body">
                
            <form action="" method = "post">
                <?php if ($class): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Topic</label>
                            <input class="form-control" name = "topics" placeholder="Enter text" value = "<?=$class->topics?>" required>
                            <label>Description</label>
                            <textarea class="form-control" name = "forum_desc" style="height:350px;"><?=$class->forum_desc?></textarea>
                        </div>    
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-right">
                            <input type = "submit" class = "btn btn-primary" name = "update-forumssubmit" value = "Update Class" />
                            <a href="<?=site_url('cms_teacher/forums/'.$class->class_id)?>" class = "btn btn-danger" >Cancel</a>
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